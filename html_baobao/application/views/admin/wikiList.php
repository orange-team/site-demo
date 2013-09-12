<?php $this->load->view('admin/header',$this->_info)?>
<body>
<div id="man_zone">
	<h2><?php echo $this->_info['name']?>列表</h2>
    <table width="96%" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style">
    	<tr>
            <td>
            <?php echo $this->_info['name']?>关键词：<input type="text" id="keyword" name="keyword" style="width:160px;" value="<?php echo $wiki_key?$wiki_key:'';?>"/> &nbsp;&nbsp;&nbsp;&nbsp;
            所属标签：<input type="text" id="tag_name" name="tag_name" style="width:160px;" value="<?php echo $tag_name?$tag_name:'';?>"/> &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="submit" id='submit' onclick='toSearch()' value=" 搜索 " />
            <input type="button" name="button" onclick='showAll()' value="显示全部" />
            </td>
        </tr>
    </table>
  	<table width="96%" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style" style="margin-top:10px; margin-bottom:10px;">
    	<tr>
    		<th width="5%"></th>	
      		<th width="5%">编号</th>
            <th width="30%"><?php echo $this->_info['name']?>关键词</th>
            <th width="10%">标签</th>
            <th width="10%"> 操作 </th>
    	</tr>
        <?php if( !empty($wikiArr) ) {foreach($wikiArr as $k=>$row) { ?>
        <tr <?php echo (0==$k%2) ? 'class="odd"':'';?>>
    		<td align="center" ><input type="checkbox" name="news_check" value="{$nl.id}"/></input></td>
            <td align="center" ><?php echo $k+$number;?></td>
            <td><?php echo anchor(site_url('admin/'.$this->_info['cls'].'/edit/'.$row['id']), $row['wiki_key']);?></td>
            <td><?php echo $row['tag_name'], '&nbsp;', anchor(site_url('admin/relation_tag/showList/?type='.$this->_info['cls'].'&id='.$row['id']),'添加','class="view"')?></td>
            <td class="action" align="center">
            <?php echo anchor(site_url(''),'查看&nbsp;&nbsp;','class="view" target="_blank"'), 
            anchor(site_url('admin/'.$this->_info['cls'].'/edit/'.$row['id']),'编辑&nbsp;','class="edit"')?>
            <a class="delete" href="javascript:if( confirm('确认要删除吗？') ) location.href='<?php echo site_url('admin/'.$this->_info['cls'].'/del/'.$row['id'])?>';">删除</a>
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
//定义控制器信息
var _info = {'cls':'<?php echo $this->_info['cls']?>', 'name':'<?php echo $this->_info['name']?>'};
function toSearch(type)
{
    var tag_id = $("#tag_id").val();
    var wiki_key = $("#keyword").val();
    
    if('' == wiki_key) wiki_key = 0;
    if('' == tag_id) tag_id = 0;
    window.location.href="/admin/"+_info.cls+"/showlist/"+wiki_key+"/"+tag_id+"/";
}
function showAll()
{
    window.location.href="/admin/"+_info.cls+"/showlist/";
}
</script>
</html>
