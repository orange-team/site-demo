<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理栏目</title>
<link href="/adminStatic/css/common_new.css" type="text/css" rel="stylesheet" /> 
<script type="text/javascript" src="/adminStatic/js/jquery.js"></script>
</head>

<body>
<div class="ztyh_page">
        <div class="yhmd_sl" id="yhmd_sl" ><!--循环开始-->
            <p class="add_height tab_t1 add_titleg">
                <span class="add_che" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;栏目名称<a href='javascript:add()'>新添加</a></span><span class="add_cz">操作</span>
            </p>
			<!--添加的 -->
            <p  class="add_height gy" id='add'  style="display:none;">
                <span class="add_che" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" id="name" />
				<span class="ts_color" id='test'></span>
				<span>
					<select id='level_1' onchange='ajax_category()'>
						<option selected="selected" value='0'>所属一级栏目</option>
					</select>
				</span>
                <span>
					<select id='level_2'>
						<option selected="selected" value='0'>所属二级栏目</option>
					</select>
				</span>
                </span><span class="add_cz"><a href="javascript:ajax_pro_type('add',0)">保存</a><a href='javascript:cancel()'>取消</a></span>
             </p>
             <!--循环部分 start-->
			 <!--cate_gory_id为行标识，a_id中type属性为是否打开栏目标识，0为未打开，1为已打开，隐藏域a_flag_id记录的+-符号，即名称前的+-标识符-->
			 <?php foreach($rows as $k=>$v){?>
            <p  id="category_<?php echo $v['id']?>" class="add_height" >
                <span id="fl_<?php echo $v['id']?>" class="add_che add_fl">&nbsp;&nbsp;&nbsp;<a type='0' id="a_<?php echo $v['id']?>" href="<?php  if($v['leaf']=='+'){echo 'javascript:ajax_extend('.$v['id'].')';}else{echo '#';}?>"><span id="sp_<?php echo $v['id']?>"><?php echo $v['leaf']?></span><?php echo $v['name'];?></a></span><span class="add_cz"><a id="edit_<?php echo $v['id']?>" href="javascript:edit(<?php echo $v['id']?>)">修改</a><a id="del_<?php echo $v['id']?>" href="javascript:ajax_pro_type('del',<?php echo $v['id']?>)">删除</a></span>
				<input type='hidden' id="a_flag_<?php echo $v['id']?>" value="<?php echo $v['leaf']?>">
			</p>
			 <?php }?>
             <!--循环部分 end-->
			 <!--修改的 -->
			 <input type='hidden' value='' id='flag_a'><!--记录修改时的ID-->
			  <input type='hidden' value='' id='flag_name'><!--记录修改时的名称-->
           <p id='flag' class="add_height gy"  style="display:none;"></p>
        </div>
   </div>
</div>
</body>
</html>
<script type="text/javascript">
$(document).ready(function(){
	$("p:even").addClass("gy");
})
//点击添加按钮
function add()
{
	var flag_id = $('#flag_a').val();//获取记录值
	if(flag_id!='')//若记录纸不为空，则调用取消修改方法
	{
		r_edit(flag_id);
	}
	$("#add").css("display","");//显示默认隐藏的添加输入信息
	$('#test').html('');
	$('#name').val('');//清空输入框
	$("#level_1 option[value!=0]").remove();//清空一级栏目浏览框
	$("#level_2 option[value!=0]").remove();//清空二级栏目浏览框
	ajax_category();//调用ajax读取三级栏目
	//若不先移除隔行换色再添加，会出现临近行同色
	chan_col();//添加隔行换色
}
//动态获取三级栏目，添加时的下拉框
function ajax_category()
{
	var id = $('#level_1').val();//取顶级栏目的值
    $.ajax({
            url:"<?php echo base_url("admin/section/ajax_extend")?>",
            type:'post',
            data:{'id':id},
            async: false,
            cache: false,
            success:function(str)
            {
                var obj = eval(str);//转为对象
                var leng = obj.length;//获取长度
                if(id==0)//添加为顶级栏目
                {
                    $("#level_1 option[value!=0]").remove();//移除已有的栏目，避免多次点击无限制添加栏目
                    
                        for(var i=0;i<leng;i++)//重新添加栏目
                        {
                            $("#level_1").append("<option value='"+obj[i].id+"'>"+obj[i].name+"</option>");
                        }
                    
                }else//添加二级栏目
                {
                        $("#level_2 option[value!=0]").remove();//移除已有的栏目，避免多次点击无限制添加栏目
                        for(var i=0;i<leng;i++)//重新添加栏目
                        {
                            $("#level_2").append("<option value='"+obj[i].id+"'>"+obj[i].name+"</option>");
                        }
                    
                }
                chan_col();//隔行换色
            }
    });
}
//取消添加
function cancel()
{
	$("#add").css("display","none");//隐藏输入信息
	chan_col();
}
//删除
function ajax_del(id)
{
	var name = $('#a_'+id).text();//获取名称文本
	
		$.ajax({
                url:"<?php echo base_url("admin/section/ajax_del")?>",
				type:'post',
				data:{'id':id},
				async: false,
				cache: false,
				success:function(str)
				{
					if(str == -1)
					{
						chan_col();//隔行换色
						alert('删除失败!');
					}else
					{
						$('#category_'+id).remove();//删除行
					}
						chan_col();//隔行换色
				}
		});
	
}
//点击修改按钮
function edit(id)
{
	cancel();//调用方法，取消新添加输入框
	var flag_id = $('#flag_a').val();//获取记录值
	var name = $('#a_'+id).text();//获取名称文本
	if(flag_id != '')//若记录值不为空，则取消当前修改，即当前修改时点击另一条记录的修改
	{
		r_edit(flag_id);//调用取消修改方法
	}
	$('#flag_name').val(name.substring(1));
	$('#a_'+id).text('');//清空文本

	var input = '<input type="text" id="tex_'+id+'" value="'+name.substring(1)+'"/><span id='+id+' style="color:red;"></span>';//添加输入框
	$('#flag_a').val(id);//记录ID值
	$('#edit_'+id).html('保存');
	$("#edit_"+id).removeAttr("href"); 
	$("#edit_"+id).attr("href","javascript:ajax_edit("+id+")");
	$('#del_'+id).html('取消');
	$("#del_"+id).removeAttr("href"); 
	$("#del_"+id).attr("href","javascript:r_edit("+id+")");
	$('#a_'+id).before(input);
	chan_col();
}
//点击取消修改时调用
function r_edit(id)
{
	var name = $('#flag_name').val();
	$('#flag_name').val('');
	var leaf = $('#a_flag_'+id).val();
	var span = '<span id=sp_'+id+'>'+leaf+'</span>'+name;
	$('#'+id).remove;
	$('#tex_'+id).remove();
	$('#a_'+id).html(span);
	$('#edit_'+id).html('修改');
	$("#edit_"+id).removeAttr("href"); 
	$("#edit_"+id).attr("href","javascript:edit("+id+")");
	$('#del_'+id).html('删除');
	$("#del_"+id).removeAttr("href"); 
	$("#del_"+id).attr("href","javascript:ajax_del("+id+")");
	$('#flag_a').val('');
	$('#'+id).remove();
	chan_col();
}
//修改ajax
function ajax_edit(id)
{
	var name = $('#tex_'+id).val();
	$.ajax({
            url:"<?php echo base_url("admin/section/ajax_edit")?>",
            type:'post',
            data:{'name':name,'id':id},
            async: false,
			cache: false,
            success:function(str)
			{
				if(str<0)
				{
					if(str==-1)
					{
						$('#'+id).text('已存在');
					}
					if(str==-2)
					{
						$('#'+id).text('请输入栏目名称');
					}
					if(str==-3)
					{
						$('#'+id).text('栏目修改失败');
					}
				}else
				{
					$('#flag_name').val(name);
					r_edit(id);//修改完成后取消修改状态
				}
				chan_col();
            }
    });
}
function ajax_pro_type(flag,id)
{
	var level_1 = $('#level_1').val();//一级栏目值
	var level_2 = $('#level_2').val();//二级栏目值
	var pro_typeid = '';
	if(level_2 != 0 && level_1 !=0 && flag =='add')
	{
		pro_typeid = level_2;
	}
	if(level_2 == 0 && level_1 !=0 && flag =='add')
	{
		pro_typeid = level_1;
	}
	if(flag == 'del')
	{
		pro_typeid = id;
	}
	if(pro_typeid != '' && 'del' == flag)
	{
        var pt_name = $('#a_'+id).text();
        if(confirm('是否确认删除'+pt_name.substring(1)+'？'))
        {
            ajax_del(id);
        }
    }else
    {
        ajax_add(); 
    }
}
//添加ajax
function ajax_add()
{
	var level_1 = $('#level_1').val();//一级栏目值
	var level_2 = $('#level_2').val();//二级栏目值
	var name = $('#name').val();//名称
	var level1_flag = $('#a_'+level_1).attr('type');
	var level2_flag = $('#a_'+level_2).attr('type');
	$.ajax({
            url:"<?php echo base_url("admin/section/ajax_add")?>",
            type:'post',
            data:{'name':name,'level_1':level_1,'level_2':level_2},
            async: false,
			cache: false,
            success:function(str)
            {
                if(str==-1)
				{
					$('#test').html('名称已存在');
				}else if(str == -2)
				{
					$('#test').html('请输入栏目名称');
				}else
				{
					var obj = eval('('+str+')');
					if(level_1 != 0 && level_2 == 0)
					{
						if(level1_flag == 0)
						{
							//$('#a_'+level_1).attr('type',0);
							ajax_extend(level_1);
						}else
						{
							/*拼接添加行信息*/
							var p = '<p class="add_height second_fl" id="category_'+obj.id+'"><span id="fl_'+obj.id+'" class="add_che add_fl fl2_mar">&nbsp;&nbsp;&nbsp;<a id="a_'+obj.id+'" type="0" href="#"><span id="sp_'+obj.id+'">-</span>'+obj.name+'</a></span><span class="add_cz"><a id="edit_'+obj.id+'" href="javascript:edit('+obj.id+')">修改</a><a id="del_'+obj.id+'" href="javascript:ajax_pro_type(\'del\','+obj.id+')">删除</a></span><input type="hidden" id="a_flag_'+obj.id+'" value="-"></p>';
							$('#category_'+level_1).after(p);
							$('#category_'+obj.id).addClass('add_height');
							chan_col();
						}
					}
					if(level_2 != 0 && level_1 != 0)
					{
						if(level1_flag == 0)
						{
							ajax_extend(level_1);
						}
						if(level2_flag == 0)
						{
							ajax_extend(level_2);
						}else
						{
							/*拼接添加行信息*/
							var p = '<p class="add_height thirdly_fl" id="category_'+obj.id+'"><span id="fl_'+obj.id+'" class="add_che add_fl fl3_mar">&nbsp;&nbsp;&nbsp;<a id="a_'+obj.id+'" type="0" href="#"><span id="sp_'+obj.id+'">-</span>'+obj.name+'</a></span><span class="add_cz"><a id="edit_'+obj.id+'" href="javascript:edit('+obj.id+')">修改</a><a id="del_'+obj.id+'" href="javascript:ajax_pro_type(\'del\','+obj.id+')">删除</a></span><input type="hidden" id="a_flag_'+obj.id+'" value="-"></p>';
							$('#category_'+level_2).after(p);
							$('#category_'+obj.id).addClass('add_height');
							chan_col();
							if($('a_'+level_2).attr('href') == '#')
							{
								$('a_'+level_2).attr('href','javascript:ajax_extend('+level_2+')')
							}
						}
					}
					if(level_1 == 0 && level_2 == 0)
					{
						/*拼接添加行信息*/
						var p = '<p id="category_'+obj.id+'"><span id="fl_'+obj.id+'" class="add_che add_fl ">&nbsp;&nbsp;&nbsp;<a id="a_'+obj.id+'" type="0" href="#"><span id="sp_'+obj.id+'">-</span>'+obj.name+'</a></span><span class="add_cz"><a id="edit_'+obj.id+'" href="javascript:edit('+obj.id+')">修改</a><a id="del_'+obj.id+'" href="javascript:ajax_pro_type(\'del\','+obj.id+')">删除</a></span><input type="hidden" id="a_flag_'+obj.id+'" value="-"></p>';
						$('#flag_a').before(p);
						$('#category_'+obj.id).addClass('add_height');
						chan_col();
					}
					$("#add").css("display","none");
				}
            }
    });
}
//点击栏目时扩展子栏目
function ajax_extend(id)
{
	var obj = '';
	var leng = '';
	var cla = '';
	var i=0;
	var flag = '';
		$.ajax({
                url:"<?php echo base_url("admin/section/ajax_extend")?>",
				type:'post',
				data:{'id':id},
				async: false,
				cache: false,
				success:function(str)
				{
					if(str !='[]')
					{
						obj = eval(str);
						leng = obj.length;
						if($('#a_'+id).attr('type') == 0)
						{
						//判断深度 加载样式名称
							var cla = '';
							if(obj[0].pt_depth==1)
							{
								cla = 'add_height';
								cla_span = 'fl1_mar';
							}else if(obj[0].pt_depth==2)
							{
								cla = 'add_height second_fl';
								cla_span = 'fl2_mar';
							}else if(obj[0].pt_depth==3)
							{
								cla = 'add_height thirdly_fl';
								cla_span = 'fl3_mar';
							}
							
							for(i=0;i<leng;i++)
							{
								$('#category_'+obj[i].id).remove();
								if(obj[i].leaf=='+')
								{
									flag = 'javascript:ajax_extend('+obj[i].id+')';
								}else
								{
									flag = '#';
								}
								var p = '<p id="category_'+obj[i].id+'"><span id="fl_'+obj[i].id+'" class="add_che add_fl">&nbsp;&nbsp;&nbsp;<a id="a_'+obj[i].id+'" type="0" href="'+flag+'" ><span id="sp_'+obj[i].id+'">'+obj[i].leaf+'</span>'+obj[i].name+'</a></span><span class="add_cz"><a id="edit_'+obj[i].id+'" href="javascript:edit('+obj[i].id+')">修改</a><a id="del_'+obj[i].id+'" href="javascript:ajax_pro_type(\'del\','+obj[i].id+')">删除</a></span><input type="hidden" id="a_flag_'+obj[i].id+'" value="'+obj[i].leaf+'"></p>';
								$('#category_'+obj[i].parent).after(p);
								$('#category_'+obj[i].id).addClass(cla);
								$('#fl_'+obj[i].id).addClass(cla_span);
							}
							$('#a_'+id).attr('type',1);
							$('#sp_'+obj[0].parent).html('-');
							$('#a_flag_'+obj[0].parent).val('-');
						}else
						{
							for(i=0;i<leng;i++)
							{
								var a_id = $('#a_'+obj[i].id).attr('type');
								if(a_id==1)
								{
									ajax_extend(obj[i].id);//若有多个已打开子栏目，递归调用合并栏目
								}
								$('#category_'+obj[i].id).remove();
							}
							$('#a_'+id).attr('type',0);
							$('#sp_'+obj[0].parent).html('+');
							$('#a_flag_'+obj[0].parent).val('+');
						}
						if(obj[0].parent!=0)
						{
							$('#a_'+obj[0].parent).attr('href',"javascript:ajax_extend("+obj[0].parent+")");
						}
					}
				}
		});
		chan_col();
}
function chan_col()
{
	
	$("p:even").addClass('gy');
	$("p:odd").removeClass('gy');
}
</script>

