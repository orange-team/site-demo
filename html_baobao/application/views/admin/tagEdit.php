<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>标签修改网站后台管理</title>
<link rel="stylesheet" href="/adminStatic/css/common_new.css" type="text/css" />
</head>

<body>
<div id="man_zone">
	<h5>&nbsp;&nbsp;◆ 标签修改&nbsp;&raquo;&nbsp;<span style='color:red'><b>*</b></span> 代表必填项；</h5>
    <?php echo form_open(site_url('admin/tag/saveEdit/'.$id), array('class'=>"jnice","onsubmit"=>"return check_form()"));?>
  	<table width="96%" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style">
    	<tr>
      		<td width="18%" class="left_title_1">标签名称</td>
            <td width="82%"><input class="text_style" type="text" name="name" id="name" value="<?php echo $name?>" /> <span style="color:red;" id="errorKeyword"></span></td>
    	</tr>
        <tr>
      		<td class="left_title_2">标签权重</td>
      		<td><input type="text" class="text_style" name="weight" value="<?php echo $weight?>" /></td>
    	</tr>
        <tr>
      		<td class="left_title_2">&nbsp;</td>
      		<td><input type="submit" name="submit" value=" 提交 " />&nbsp;&nbsp;
            <input type="reset" name="reset" value=" 重置 " />
            </td>
    	</tr>
  	</table>
    </form>
    <br />
    <br />
</div>
</body>
<script type="text/javascript" src="/adminStatic/js/jquery.js" ></script>
<script type="text/javascript" src="/adminStatic/js/common.js" ></script>
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
            $("#errorKeyword").html('标签名称不能为空！');
        }
        return false;
    }
}
</script>
</html>
