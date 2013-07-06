<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>网站后台管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/adminStatic/css/common_new.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="/adminStatic/js/jquery.js"></script>
<script type="text/javascript" src="/adminStatic/js/common.js"></script>
<script type=text/javascript>
function toSearch(type)
{
    if(type=='one')
    {
        $("#keyword").get(0).selectedIndex = 0;
        $("#two").get(0).selectedIndex = 0;
        $("#three").get(0).selectedIndex = 0;
    }
    if(type=='two')
    {
        $("#three").get(0).selectedIndex = 0;
        $("#keyword").get(0).selectedIndex = 0;
    }
    if(type=='three')
    {
        $("#keyword").get(0).selectedIndex = 0;
    }
    var one = $("#one").val();
    var two = $("#two").val();
    var three = $("#three").val();
    var keyword = $("#keyword").val();
    section = one+"-"+two+"-"+three+"-"+keyword;
    
    var title = $("#title").val();
    if(''==section) section=0;
    if(''==title) title=0;
    window.location.href="/admin/article/showlist/"+section+"/"+title+"/";
}
</script>
</head>

<body>
<div id="man_zone">
	<h2>文章列表</h2>
    <table width="96%" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style">
    	<tr>
            <td>
            名称：<input type="text" id="title" name="title" style="width:260px;" value="<?php echo $title?$title:'';?>"/> &nbsp;&nbsp;&nbsp;&nbsp;
            所属栏目：
      			<select name="one" id="one" onchange="toSearch('one')">
                	<option value="0">请选择</option>
                    <?php if(!empty($one_section)) {foreach($one_section as $k=>$v) {?>
                    <option value="<?php echo $v['id']?>" <?php if($v['id'] == $one) echo 'selected';?> style="background-color:#FFC;"><?php echo $v['name']?></option>
                    <?php }} ?>
                </select>
                <select style="display:inline;" name="two" id="two" onchange="toSearch('two')">
                    <option value='0'>请选择</option>
                    <?php if($two_value != ''){foreach($two_value as $k=>$v){ ?>
                    <option value="<?php echo $v['id']?>" <?php if($v['id'] == $two) echo 'selected'; ?>><?php echo $v['name'];?></option>
                    <?php }} ?>
                </select>
                <select style="display:inline;" name="three" id="three" onchange="toSearch('three')">
                    <option value='0'>请选择</option>
                    <?php if($three_value != ''){foreach($three_value as $k=>$v){ ?>
                    <option value="<?php echo $v['id']?>" <?php if($v['id'] == $three) echo 'selected'; ?>><?php echo $v['name'];?></option>
                    <?php }} ?>
                </select>&nbsp;&nbsp;&nbsp;&nbsp;
            所属关键词：
                <select name="keyword" id="keyword" onchange="toSearch()">
                    <option value='0'>请选择</option>
                    <?php if($keywords != ''){foreach($keywords as $k=>$v){ ?>
                    <option value="<?php echo $v['id']?>" <?php if($v['id'] == $keyword_id) echo 'selected'; ?>><?php echo $v['name'];?></option>
                    <?php }} ?>
                </select>
                  <input type="submit" name="submit" id='submit' onclick='toSearch()' value=" 搜索 " />

            </td>
        </tr>
    </table>
  	<table width="96%" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style" style="margin-top:10px; margin-bottom:10px;">
    	<tr>
    		<th width="5%"></th>	
      		<th width="5%">编号</th>
            <th width="40%">标题</th>
            <th width="12%">发布时间</th>
            <th width="10%">  操作       </th>
    	</tr>
        <?php if( !empty($articleArr) ) {foreach($articleArr as $k=>$row) { ?>
        <tr <?php echo (0==$k%2) ? 'class="odd"':'';?>>
    		<td align="center" ><input type="checkbox" name="news_check" value="{$nl.id}"/></input></td>
            <td align="center" ><?php echo $k+$number;?></td>
            <td><?php echo anchor(site_url('admin/article/editArt/'.$row['id']), $row['title']);?></td>
            <!--
            <td><?php 
                    echo mb_substr(strip_tags($row['content']),0,16);
                    if( mb_strlen($row['content'])>16 )echo '...';
                ?>
            </td>
            -->
            <td align="center" ><?php echo $row['add_time'];?></td>
            <td class="action" align="center">
            <?php echo anchor(site_url('article/showarticle/'.$cate_id.'/'.$row['id']),'查看&nbsp;&nbsp;','class="view" target="_blank"'), 
            anchor(site_url('admin/article/editArt/'.$row['id']),'编辑&nbsp;','class="edit"')?>
            <a class="delete" href="javascript:if( confirm('确认要删除吗？') ) location.href='<?php echo site_url('admin/article/del/'.$row['id'])?>';">删除</a>
            </td>
        </tr>                        
        <?php }} ?>
  	</table>
  	<table width="96%" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style">
    	<tr>
        	<td>
            	<div style="float:left;">
                <input id="button1" type="button" value="全选" onclick="selectBox('1','news_check')" />
				<input id="button2" type="button" value="反选" onclick="selectBox('0','news_check')" />
				<span style="margin-left:200px;">
                    <input id="button3" type="button" value="推 荐" onclick="toServer('','news_check','__ROOT__/Adminsite/index.php/News/newsAttribute?act=recommend&val=1&aryid','recommend')" />
                    <input id="button4" type="button" value="取消推荐" onclick="toServer('','news_check','__ROOT__/Adminsite/index.php/News/newsAttribute?act=recommend&val=2&aryid','recommend')" />
                    
                    <input id="button3" type="button" value="置 顶" onclick="toServer('','news_check','__ROOT__/Adminsite/index.php/News/newsAttribute?act=top&val=1&aryid','top')" />
                    <input id="button4" type="button" value="取消置顶" onclick="toServer('','news_check','__ROOT__/Adminsite/index.php/News/newsAttribute?act=top&val=2&aryid','top')" />
                </span>

                </div>
				<div style="float:right;"><?php echo (!empty($page)) ? $page : '';?></div>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
