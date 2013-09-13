<?php $this->load->view('admin/header',$this->_info);?>
<body>
<div id="man_zone">
	<h5>&nbsp;&nbsp;◆ <?php echo $this->_info['name']?>发布&nbsp;&raquo;&nbsp;<span style='color:red'><b>*</b></span> 代表必填项；</h5>
	<?php echo form_open(site_url('admin/'.$this->_info['cls'].'/saveAdd'), array('class'=>"jnice","onsubmit"=>"return check_form()","enctype"=>"multipart/form-data"));?>
    <input  type="file" name="upImg" id="upImg" /><span style="color:red;" id="errorUpImg"></span>
    <div>最大上传文件大小：2MB.</div>
    <input type="submit" name="submit" value=" 提交 " />&nbsp;&nbsp;
    <input type="button" name="back" value=" 返回 " onclick="window.location.href='<?php echo site_url('admin/'.$this->_info['cls'].'/showList/');?>'"/>
    </form>
</div>
<?php $this->load->view('admin/common',$this->_info);?>
<script type="text/javascript">
function check_form()
{
    var upImg = $("#upImg").val();
    if( '' != upImg )
    {
        return true;
    }else
    {
        $("#errorUpImg").html('图片不能为空！');
        return false;
    }

}
</script>
</body>
</html>
