<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>博华汇川网站管理后台--编辑用户</title>

<!-- CSS -->
<link href="/adminStatic/css/transdmin.css" rel="stylesheet" type="text/css" media="screen" />
<!--[if IE 6]><link rel="stylesheet" type="text/css" media="screen" href="/adminStatic/css/ie6.css" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" media="screen" href="/adminStatic/css/ie7.css" /><![endif]-->

<!-- JavaScripts-->
<script type="text/javascript" src="/adminStatic/js/jquery.js"></script>
<script type="text/javascript" src="/adminStatic/js/jNice.js"></script>
<style type="text/css">
fieldset span{color: #CC6653}
</style>
</head>
<body>
<div id="main">
	<?php echo form_open(site_url('admin/user/saveEdit').'/'.$user_id, array('class'=>"jnice",'onsubmit'=>'return chkForm();'));?>
	<h3>编辑 -- 用户信息</h3>
		<fieldset>
			<p><label>用户名:</label><input type="text" class="text-long" name="user_name" value="<?php echo $user['user_name'];?>"/></p>
			<p><label>真实姓名名:</label><input type="text" class="text-long" name="user_realname" value="<?php echo $user['user_realname'];?>"/></p>
			<p><label>新密码:</label>
			<input type="password" class="text-long" name="pwd1" id="pwd1" value=""/><span id="tipNull">&nbsp;</span>
			</p>
			<p><label>确认密码:</label>
			<input type="password" class="text-long" name="pwd2" id="pwd2" value=""/><span id="tip">&nbsp;</span>
			</p>
			<p>
            超级管理员<input type="radio" class="" name="user_right" id="user_right" value="0" <?php if(0 == $user['user_right']) echo 'checked'; ?> />&nbsp; &nbsp; 
			系统管理员<input type="radio" class="" name="user_right" id="user_right" value="1" <?php if(1 == $user['user_right']) echo 'checked'; ?> />&nbsp; &nbsp;
			内容管理员<input type="radio" class="" name="user_right" id="user_right" value="2" <?php if(2 == $user['user_right']) echo 'checked'; ?> />&nbsp; &nbsp;
			</p>
			<button type="submit"><span><span>确认提交</span></span></button>&nbsp;&nbsp;
			<button type="button" onclick="javascript:history.back();"><span><span>返回</span></span></button>
		</fieldset>
	</form>
</div>
<!-- // #main -->

<div class="clear"></div>
</div>
<!-- // #container -->
</div>	
<!-- // #containerHolder -->
<script type="text/javascript">
function chkForm()
{
	$('#tip,#tipNull').empty();
	if( ''==$.trim( $("#pwd1").val() ) ) 
	{
		$("#tipNull").html('密码不能为空！');
		$("#pwd1").focus();
		return false;
	}
	if( $("#pwd1").val()!==$("#pwd2").val() ) 
	{
		$("#tip").html('您两次输入的密码不一致！');
		$("#pwd2").focus();
		return false;
	}
}
</script>
</body>
</html>
