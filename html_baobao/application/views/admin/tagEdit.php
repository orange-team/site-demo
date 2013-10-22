<?php $this->load->view('admin/header',$this->_info)?>
<body>
<div id="man_zone">
    <?php $this->load->view('admin/editNav',$this->_info)?>
    <?=form_open(site_url('admin/tag/saveEdit/'.$id), array('class'=>"jnice","onsubmit"=>"return check_form()"));?>
    <?php $this->load->view('admin/editTable')?>
    	<tr>
      		<td width="18%">名称</td>
            <td width="82%"><input class="text_style" type="text" name="name" id="name" value="<?=$name?>" /> <span style="color:red;" id="errorKeyword"></span></td>
    	</tr>
        <tr>
      		<td>权重</td>
      		<td><input type="text" class="text_style" name="weight" value="<?=$weight?>" /></td>
        </tr>
        <tr>
      		<td>关联时期(section)</td>
            <td>
            <select name="section">
                <option value="1"<?=(1==$section) ? 'selected' : ''?>>备孕期</option>
                <option value="2"<?=(2==$section) ? 'selected' : ''?>>孕前期</option>
                <option value="3"<?=(3==$section) ? 'selected' : ''?>>孕中期</option>
                <option value="4"<?=(4==$section) ? 'selected' : ''?>>孕后期</option>
                <option value="5"<?=(5==$section) ? 'selected' : ''?>>0至1岁</option>
                <option value="6"<?=(6==$section) ? 'selected' : ''?>>1至3岁</option>
            </select>
            </td>
    	</tr>
        <tr>
      		<td>&nbsp;</td>
      		<td><?php $this->load->view('admin/editSubmit',$this->_info)?></td>
    	</tr>
  	</table>
    </form>
</div>
<?php $this->load->view('admin/common',$this->_info);?>
<script type="text/javascript">
function check_form()
{
    var name = $("#name").val();
    if(name != 0)
    {
        return true;
    }else
    {
        if(0==name)
        {
            $("#errorKeyword").html('名称不能为空！');
        }
        return false;
    }
}
</script>
</body>
</html>
