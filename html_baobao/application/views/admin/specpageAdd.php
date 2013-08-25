<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/adminStatic/css/common_new.css" type="text/css" />
<title>专栏添加网站后台管理</title>
</head>
<body>
<div id="man_zone">
	<h5>&nbsp;&nbsp;◆ 专栏发布&nbsp;&raquo;&nbsp;<span style='color:red'><b>*</b></span> 代表必填项；</h5>
	<?php echo form_open_multipart(site_url('admin/specpage/saveAdd'), array('class'=>"jnice",'onsubmit'=>'return check_form();'));?>
  	<table width="96%" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style">
        <tr>
      		<td width="18%" class="left_title_1"><span style='color:red'>*</span>&nbsp;标题</td>
      		<td width="82%"><input class="text_style" type="text" name="title" id="title" /> <span style="color:red;" id="errorTitle"></span></td>
    	</tr>
    	<tr>
      		<td class="left_title_2">封面图片</td>
      		<td><input type="file" name="upImg" id="cover" value="上传图片"/>
            </td>
    	</tr>
        <tr>
      		<td class="left_title_1">专栏内容</td>
      		<td> <?php echo $kindeditor;?></td>
    	</tr>
        <tr>
      		<td class="left_title_2">作者</td>
      		<td><input class="text_style" type="text" name="author" /></td>
    	</tr>
        <tr>
      		<td class="left_title_1">&nbsp;<input type="hidden" name='section' id='section' value='' /></td>
      		<td><input type="submit" name="submit" value=" 提交 " />&nbsp;&nbsp;
            <input type="reset" name="reset" value=" 重置 " />
            </td>
    	</tr>
  	</table>
    </form>
    <br />
    <br /><br />
</div>
<script type="text/javascript" src="/adminStatic/js/jquery.js" ></script>
<script type="text/javascript" src="/adminStatic/js/common.js" ></script>
<script type="text/javascript">
function check_form()
{
    var title = $("#title").val();
    if(title != '')
    {
        return true;
    }else
    {
        if(''==title)
        {
            $("#errorTitle").html('专栏标题不能为空！');
        }
        return false;
    }

}
</script>
</body>
</html>
