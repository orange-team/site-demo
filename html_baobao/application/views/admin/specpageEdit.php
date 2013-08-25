<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/adminStatic/css/common_new.css" type="text/css" />
<title>专栏修改网站后台管理</title>
</head>

<body>
<div id="man_zone">
	<h5>&nbsp;&nbsp;◆ 专栏修改&nbsp;&raquo;&nbsp;<span style='color:red'><b>*</b></span> 代表必填项；</h5>
	<?php echo form_open_multipart(site_url('admin/specpage/saveEdit/'.$id), array('class'=>"jnice",'onsubmit'=>'return check_form();'));?>
  	<table width="96%" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style">
    	<tr>
      		<td width="18%" class="left_title_1"><span style='color:red'>*</span>&nbsp;名称</td>
            <td width="82%"><input class="text_style" type="text" name="title" id="name" value="<?php echo $title;?>" /> <span style="color:red;" id="errorTitle"></span></td>
    	</tr>
        <tr>
      		<td class="left_title_2">封面图片</td>
      		<td><input type="file" name="upImg" id="cover" value="上传图片"/>
			<?php if( empty($cover) ) { echo '还未上传封面图片'; }else{?>
            <img src="<?php echo $this->spec_path,$cover;?>" width="120" height="120"/>
            <?php } ?>
            </td>
    	</tr>
        <tr>
      		<td class="left_title_1">专栏内容</td>
      		<td> <?php echo $kindeditor;?></td>
    	</tr>
        <tr>
      		<td class="left_title_2">作者</td>
      		<td><input class="text_style" type="text" name="author" value="<?php echo $author?>"/></td>
    	</tr>
        <tr>
      		<td class="left_title_1"> <input type="hidden" name='section' id='section' value='' /></td>
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
    var name = $("#name").val();
    if(name != '')
    {
        return true;
    }else
    {
        if(0==name)
        {
            $("#errorTitle").html('专栏名称不能为空！');
        }
        return false;
    }

}
</script>
</body>
</html>
