<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>网站后台管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/adminStatic/css/common_new.css" rel="stylesheet" type="text/css" media="screen" />
</head>

<body>
<div id="man_zone">
	<h2>专栏列表</h2>
    <table width="96%" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style">
    	<tr>
            <td>
            名称：<input type="text" id="name" name="title" style="width:260px;" value="<?php echo $title?$title:'';?>"/> &nbsp;&nbsp;
                  <input type="submit" name="submit" id='submit' onclick='toSearch()' value=" 搜索 " />
                  <input type="button" name="button" onclick='showAll()' value="显示全部" />
            </td>
        </tr>
    </table>
  	<table width="96%" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style" style="margin-top:10px; margin-bottom:10px;">
    	<tr>
    		<th width="5%"></th>	
      		<th width="5%">编号</th>
            <th width="25%">名称</th>
            <th width="10%">添加时间</th>
            <th width="5%">作者</th>
            <th width="10%">操作</th>
    	</tr>
        <?php if( !empty($specArr) ) {foreach($specArr as $k=>$row) { ?>
        <tr <?php echo (0==$k%2) ? 'class="odd"':'';?>>
    		<td align="center" ><input type="checkbox" name="news_check" value="{$nl.id}"/></input></td>
            <td align="center" ><?php echo $k+$number;?></td>
            <td id="name_<?php echo $row['id']?>"><?php echo anchor(site_url('admin/specpage/edit/'.$row['id']), $row['title']);?></td>
            <td align="center"><?php echo $row['add_time']?></td>
            <td align="center"><?php echo $row['author']?></td>
            <td class="action" align="center">
            <?php echo anchor(site_url('admin/specpage/edit/'.$row['id']),'编辑&nbsp;','class="edit"')?>
            <a class="delete" href="javascript:delOne(<?php echo $row['id']?>);">删除</a>
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
                </div>
				<div style="float:right;"><?php echo (!empty($page)) ? $page : '';?></div>
            </td>
        </tr>
    </table>
</div>
<script type="text/javascript" src="/adminStatic/js/jquery.js"></script>
<script type="text/javascript" src="/adminStatic/js/common.js"></script>
<script type=text/javascript>
<!--
function toSearch(type)
{
    var name = $("#name").val();
    window.location.href="/admin/specpage/showlist/"+name+"/";
}
function showAll()
{
    window.location.href="/admin/specpage/showlist/";
}
function delOne(id)
{
    var name = $("#name_"+id).text()
    if( confirm('确认要删除专栏 "'+name+'" 吗？') )
    {
        location.href='<?php echo site_url('admin/specpage/del/')?>/'+id;
    }
}
//-->
</script>
</body>
</html>