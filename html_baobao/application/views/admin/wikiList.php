<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>网站后台管理-百科列表</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/adminStatic/css/common_new.css" rel="stylesheet" type="text/css" media="screen" />
</head>

<body>
<div id="man_zone">
	<h2>百科列表</h2>
    <table width="96%" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style">
    	<tr>
            <td>
            百科关键词：<input type="text" id="keyword" name="keyword" style="width:260px;" value="<?php echo $wiki_key?$wiki_key:'';?>"/> &nbsp;&nbsp;&nbsp;&nbsp;
            所属标签：
      			<select name="tag_id" id="tag_id" onchange="toSearch()">
                	<option value="0">请选择</option>
                    <?php if(!empty($tags)) {foreach($tags as $k=>$v) {?>
                    <option value="<?php echo $v['id']?>" <?php if($v['id'] == $tag_id) echo 'selected';?> style="background-color:#FFC;"><?php echo $v['name']?></option>
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
            <th width="40%">百科关键词</th>
            <th width="10%">  操作       </th>
    	</tr>
        <?php if( !empty($wikiArr) ) {foreach($wikiArr as $k=>$row) { ?>
        <tr <?php echo (0==$k%2) ? 'class="odd"':'';?>>
    		<td align="center" ><input type="checkbox" name="news_check" value="{$nl.id}"/></input></td>
            <td align="center" ><?php echo $k+$number;?></td>
            <td><?php echo anchor(site_url('admin/article/edit/'.$row['id']), $row['wiki_key']);?></td>
            <td class="action" align="center">
            <?php echo anchor(site_url(''),'查看&nbsp;&nbsp;','class="view" target="_blank"'), 
            anchor(site_url('admin/wiki/edit/'.$row['id']),'编辑&nbsp;','class="edit"')?>
            <a class="delete" href="javascript:if( confirm('确认要删除吗？') ) location.href='<?php echo site_url('admin/wiki/del/'.$row['id'])?>';">删除</a>
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
function toSearch(type)
{
    var tag_id = $("#tag_id").val();
    var wiki_key = $("#keyword").val();
    
    if('' == wiki_key) wiki_key = 0;
    if('' == tag_id) tag_id = 0;
    window.location.href="/admin/wiki/showlist/"+wiki_key+"/"+tag_id+"/";
}
</script>
</html>
