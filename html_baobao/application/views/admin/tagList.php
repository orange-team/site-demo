<?php $this->load->view('admin/header',$this->_info)?>
<body>
<div id="man_zone">
	<h2>标签列表</h2>
    <table width="96%" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style">
    	<tr>
            <td>
            标签名称：<input type="text" id="name" name="name" style="width:260px;" value="<?php echo $name?$name:'';?>"/> &nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="submit" name="submit" id='submit' onclick='toSearch()' value=" 搜索 " />
                  <input type="button" name="button" onclick='showAll()' value="显示全部" />
            </td>
        </tr>
    </table>
  	<table width="96%" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style" style="margin-top:10px; margin-bottom:10px;">
    	<tr>
    		<th width="5%"></th>	
      		<th width="5%">编号</th>
            <th width="35%">标签名称</th>
            <th width="5%">标签权重</th>
            <th width="10%"> 操作 </th>
    	</tr>
        <?php if( !empty($tagArr) ) {foreach($tagArr as $k=>$row) { ?>
        <tr <?php echo (0==$k%2) ? 'class="odd"':'';?>>
    		<td align="center" ><input type="checkbox" name="news_check" value="{$nl.id}"/></input></td>
            <td align="center" ><?php echo $k+$number;?></td>
            <td><?php echo anchor(site_url('admin/tag/edit/'.$row['id']), $row['name']);?></td>
            <td align="center"><?php echo $row['weight'];?></td>
            <td class="action" align="center">
            <?php echo anchor(site_url(''),'查看&nbsp;&nbsp;','class="view" target="_blank"'), 
            anchor(site_url('admin/tag/edit/'.$row['id']),'编辑&nbsp;','class="edit"')?>
            <a class="delete" href="javascript:if( confirm('确认要删除吗？') ) location.href='<?php echo site_url('admin/tag/del/'.$row['id'])?>';">删除</a>
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
    var name = $("#name").val();
    if('' == name) name = 0;
    window.location.href="/admin/tag/showlist/"+name+"/";
}
function showAll()
{
    window.location.href="/admin/tag/showlist/";
}
</script>
</html>
