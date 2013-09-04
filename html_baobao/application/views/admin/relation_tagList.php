<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>网站后台管理-关联标签列表</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/adminStatic/css/common_new.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<div id="man_">
	<h2>关联标签列表</h2>
    <table width="96%" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style">
    	<tr>
            <td>
            关联标签名称：<input type="text" id="name" name="name" style="width:260px;" value="<?php echo $name?$name:'';?>"/> &nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="submit" name="submit" id='submit' onclick='toSearch()' value=" 搜索 " />
                  <input type="button" name="button" onclick='showAll()' value="显示全部" />
                  &nbsp;&nbsp;<?php echo anchor(site_url('admin/wiki/showList/'), '返回');?></td>
            </td>
        </tr>
    </table>
  	<table width="96%" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style" style="margin-top:10px; margin-bottom:10px;">
    	<tr>
    		<th width="5%"></th>	
      		<th width="5%">编号</th>
            <th width="35%">关联标签名称</th>
            <th width="5%">关联标签权重</th>
            <th width="10%"> 操作 </th>
    	</tr>
        <?php if( !empty($tagArr) ) {foreach($tagArr as $k=>$row) { ?>
        <tr <?php echo (0==$k%2) ? 'class="odd"':'';?>>
    		<td align="center" ><input type="checkbox" name="news_check" value="{$nl.id}"/></input></td>
            <td align="center" ><?php echo $k+$number;?></td>
            <td><?php echo anchor(site_url('admin/'.$_class.'/edit/'.$row['id']), $row['name']);?></td>
            <td align="center"><?php echo $row['weight'];?></td>
            <td class="action" align="center">
            <?php echo anchor(site_url('admin/'.$_class.'/add/'.$row['id'].'/?type='.$type.'&id='.$id),'关联&nbsp;','class="edit"')?>
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
</body>
<script type="text/javascript" src="/adminStatic/js/jquery.js"></script>
<script type="text/javascript" src="/adminStatic/js/common.js"></script>
<script type=text/javascript>
//当前控制器名，用于view中复用
var _class = '<?php $_class?>';
function toSearch(type)
{
    var name = $("#name").val();
    if('' == name) name = 0;
    window.location.href="/admin/"+_class+"/showlist/"+name+"/";
}
function showAll()
{
    window.location.href="/admin/"+_class+"/showlist/";
}
</script>
</html>
