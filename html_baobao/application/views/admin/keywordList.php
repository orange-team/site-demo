<?php $this->load->view('admin/header',$this->_info)?>
<body>
<div id="man_zone">
	<h2>关键词列表</h2>
    <table width="96%" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style">
    	<tr>
            <td>
            名称：<input type="text" id="name" name="name" style="width:260px;" value="<?php echo $name?$name:'';?>"/> &nbsp;&nbsp;
            栏目：
      			<select name="one" id="one" onchange="toSearch('one')">
                	<option value="0">-- 请选择 --</option>
                    <?php if(!empty($one_section)) {foreach($one_section as $k=>$v) {?>
                    <option value="<?php echo $v['id']?>" <?php if($v['id'] == $one) echo 'selected';?> style="background-color:#FFC;"><?php echo $v['name']?></option>
                    <?php }} ?>
                </select>
                <select style="display:inline;" name="two" id="two" onchange="toSearch('two')">
                    <option value='0'>-- 请选择 --</option>
                    <?php if($two_value != ''){foreach($two_value as $k=>$v){ ?>
                    <option value="<?php echo $v['id']?>" <?php if($v['id'] == $two) echo 'selected'; ?>><?php echo $v['name'];?></option>
                    <?php }} ?>
                </select>
                <select style="display:inline;" name="three" id="three" onchange="toSearch()">
                    <option value='0'>-- 请选择 --</option>
                    <?php if($three_value != ''){foreach($three_value as $k=>$v){ ?>
                    <option value="<?php echo $v['id']?>" <?php if($v['id'] == $three) echo 'selected'; ?>><?php echo $v['name'];?></option>
                    <?php }} ?>
                </select>
                  <input type="submit" name="submit" id='submit' onclick='toSearch()' value=" 搜索 " />
                  <input type="button" name="button" onclick='showAll()' value="显示全部" />
            </td>
        </tr>
    </table>
  	<table width="96%" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style" style="margin-top:10px; margin-bottom:10px;">
    	<tr>
    		<th width="5%"></th>	
      		<th width="5%">编号</th>
            <th width="40%">名称</th>
            <th width="10%">  操作       </th>
    	</tr>
        <?php if( !empty($keywordArr) ) {foreach($keywordArr as $k=>$row) { ?>
        <tr <?php echo (0==$k%2) ? 'class="odd"':'';?>>
    		<td align="center" ><input type="checkbox" name="news_check" value="{$nl.id}"/></input></td>
            <td align="center" ><?php echo $k+$number;?></td>
            <td><?php echo anchor(site_url('admin/keyword/editKey/'.$row['id']), $row['name']);?></td>
            <td class="action" align="center">
            <?php echo anchor(site_url('admin/keyword/editKey/'.$row['id']),'编辑&nbsp;','class="edit"')?>
            <a class="delete" href="javascript:if( confirm('确认要删除吗？') ) location.href='<?php echo site_url('admin/keyword/del/'.$row['id'])?>';">删除</a>
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
<?php $this->load->view('admin/common',$this->_info);?>
<script type=text/javascript>
function toSearch(type)
{
    if(type=='one')
    {
        $("#two").get(0).selectedIndex = 0;
        $("#three").get(0).selectedIndex = 0;
    }
    if(type=='two')
    {
        $("#three").get(0).selectedIndex = 0;
    }
    var one = $("#one").val();
    var two = $("#two").val();
    var three = $("#three").val();
    section = one+"-"+two+"-"+three
    
    var name = $("#name").val();
    if(''==section) section=0;
    if(''==name) name=0;
    window.location.href="/admin/keyword/showlist/"+section+"/"+name+"/";
}
</script>

</body>
</html>
