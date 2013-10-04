<?php $this->load->view('admin/header',$this->_info)?>
<body>
<div id="man_zone">
    <?php $this->load->view('admin/editNav',$this->_info)?>
    <?php echo form_open(site_url('admin/wiki/saveEdit/'.$id), array('class'=>"jnice","onsubmit"=>"return check_form()","enctype"=>"multipart/form-data"));?>
    <?php $this->load->view('admin/editTable')?>
    	<tr>
      		<td width="18%">关键词</td>
            <td width="82%"><input class="text_style" type="text" name="<?php echo $this->_info['cls']?>_key" id="<?php echo $this->_info['cls']?>_key" value="<?php echo $wiki_key ?>" /> <span style="color:red;" id="errorKeyword"></span></td>
    	</tr>
    	<tr>
      		<td width="18%">图片</td>
            <td width="82%">
                <?php if(empty($wiki_img)){ echo '还没有上传图片...';}else{ ?>
                <img src="<?php echo $this->wiki_img_path,$id,'/',$wiki_img;?>" border="0" />
                <?php } ?>
                <input  type="file" name="upImg" id="<?php echo $this->_info['cls']?>_image" />
            </td>
    	</tr>
    	<tr>
      		<td>内容</td>
      		<td> <?php echo $kindeditor;?> <span style="color:red;" id="errorContent"></span></td>
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
    var tag_id = $("#tag_id").val();
    var wiki_key = $("#wiki_key").val();
    if(tag_id != '' && wiki_key != 0 &&  wiki_wiki_content != 0)
    {
        return true;
    }else
    {
        if(0==tag_id)
        {
            $("#errorTag").html('所属标签不能为空!');
        }else if(0==wiki_key)
        {
            $("#errorKeyword").html('关键词不能为空！');
        }
        return false;
    }
}
</script>
</body>
</html>
