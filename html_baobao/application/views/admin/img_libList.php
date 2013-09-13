<?php $this->load->view('admin/header',$this->_info)?>
<body>
<div id="man_zone">
	<h2><?php echo $this->_info['name']?>列表</h2>
    <div class="search_area">
        <span class="title">名称：</span>
        <input type="text" id="title" name="title" style="width:260px;" value="<?php echo $title?$title:'';?>"/>
        <input type="submit" name="submit" id='submit' onclick='toSearch()' value=" 搜索 " />
        <input type="button" name="button" onclick='showAll()' value="显示全部" />
    </div>
    <div class="bacth-operate">
        <div class="page"><?php echo (!empty($page)) ? $page : '';?></div>
    </div>
  	<table class="list-table table_style">
        <thead><tr>
    		<th class="th-1"><input type="checkbox" name="news_check" value="{$nl.id}"/></input></th>	
      		<th class="th-2">编号</th>
            <th class="th-3">文件</th>
            <th class="th-4">标签</th>
            <th class="th-5">日期</th>
    	</tr></thead>
        <tfoot><tr>
    		<th class="th-1"><input type="checkbox" name="news_check" value="{$nl.id}"/></input></th>	
      		<th class="th-2">编号</th>
            <th class="th-3">文件</th>
            <th class="th-4">标签</th>
            <th class="th-5">日期</th>
    	</tr></tfoot>
        <tbody>
        <?php if( !empty($img_libArr) ) {foreach($img_libArr as $k=>$row) { ?>
        <tr<?php if (0==$k%2) echo ' class="odd"';?>>
    		<td align="center" ><input type="checkbox" name="news_check" value="{$nl.id}"/></input></td>
            <td align="center" ><?php echo $k+$number;?></td>
            <td>
            <div class="img_area">
                <div class="thumbnail"><img src="<?php echo $row['path'];?>"/></div>
                <dl>
                <dt><a href="#"><?php echo anchor(site_url('admin/img_lib/edit/'.$row['id']), $row['title']);?></a></dt>
                <dt>来源：<?php echo chk($row['source'])?anchor($row['source_link'],$row['source'],'target="_blank"'):'';?></dt>
                <dt class="action"><?php echo anchor(site_url('admin/img_lib/edit/'.$row['id']),'编辑&nbsp;','class="edit"')?>|<a class="delete" href="javascript:if( confirm('确认要删除吗？') ) location.href='<?php echo site_url('admin/img_lib/del/'.$row['id'])?>';">永久删除</a>|<a href="#">查看</a></dt>
                </dl>
            </div>
            </td>
            <td><?php echo $row['tag_name'], '&nbsp;', anchor(site_url('admin/relation_tag/showList/?type='.$this->_info['cls'].'&id='.$row['id']),empty($row['tag_name'])?'添加':'修改','class="view"')?></td>
            <td align="center" class="action"><?php echo $row['add_time'];?></td>
        </tr>                        
        <?php }} ?>
        </tbody>
  	</table>
    <div class="bacth-operate">
        <input id="button1" type="button" value="全选" onclick="selectBox('1','news_check')" />
        <input id="button2" type="button" value="反选" onclick="selectBox('0','news_check')" />
        <div class="page"><?php echo (!empty($page)) ? $page : '';?></div>
    </div>
</div>
<style type="text/css">
.list-table {display:table;border-collapse:separate;border-spacing:1px;vertical-align:top;border-color:gray;width:96%;margin:0 0 0 25px;}
.search_area { margin:0 0 0 25px; }
.th-1 { width:5px; }
.th-2 { width:5px; }
.th-3 { width:10px; }
.th-4 { width:10px; }
.th-5 { width:10px; }
.img_area .thumbnail { float:left; height:70px;}
.img_area img { width:60px;height:60px;border:none;margin:10px 5px 0 5px; }
.img_area dl { float:left; margin:8px;}
.img_area dt.action a { margin:0 4px;}
.img_area .delete { color:red; }
.bacth-operate { display:inline-block;margin:5px 0 0 25px;padding:4px 0;width:96%; }
.bacth-operate input { display:inline-block;margin:0 4px; }
.bacth-operate .page { display:inline-block;float:right; }
</style>
<?php $this->load->view('admin/common',$this->_info);?>
<script type=text/javascript>
function toSearch(type)
{
    var title = $("#title").val();
    if(''==title) title=0;
    window.location.href="/admin/img_lib/showlist/"+title+"/";
}
</script>
</body>
</html>
