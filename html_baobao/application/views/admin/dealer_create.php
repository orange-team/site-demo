<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>网站后台管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/adminStatic/css/transdmin.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="/adminStatic/js/jquery.js"></script>
<!--<script type="text/javascript" src="/adminStatic/js/jNice.js"></script>-->
<script type="text/javascript" src="/js/city.js"></script>
</head>

<body>
<div id="wrapper">
	<div id="main">
    	<h2><a href="#">经销商合作</a> &raquo; <a href="#" class="active">经销商设置</a></h2>
    
        <form action="/admin/dealer/create_form" method="post" class="jNice" onsubmit="return check_form();">	
            <h3>新增经销商</h3>
            <fieldset>
            	<p><label>企业名称:</label><input type="text" class="text-long" name="dea_name" id="dea_name" /><font color="red">*</font></p>
                <p><label>企业地址:</label><input type="text" class="text-long" name="dea_address" id="dea_address" /><font color="red">*</font></p>
				<p><label>城市:</label>
				
				<select id="re_one" name="dea_province">
				<option value="">省</option>
				<?php
				foreach($info as $val)
				{
				?>
					<option value="<?=$val['region_id']?>"><?=$val['region_name']?></option>
				<?php
				}
				?>
				</select>
				<select id="re_two" name="dea_city">
				<option value="">城市</option>
				</select>
				<select id="re_three" name="dea_area">
				<option value="">区县</option>
				</select>


				</p>
                <p><label>联系人:</label><input type="text" class="text-long" name="dea_man" /></p>
				<p><label>手机:</label><input type="text" class="text-long" name="dea_phone" id="dea_phone" /></p>
				<p><label>座机:</label><input type="text" class="text-long" name="dea_tel" id="dea_tel" /></p>
				<p><label>传真:</label><input type="text" class="text-long" name="dea_max" id="dea_max" /></p>
				<p><label>登录帐号:</label><input type="text" class="text-long" name="dea_username" id="dea_username" /><font color="red">*</font></p>
				<p><label>登录密码:</label><input type="text" class="text-long" name="dea_passwd" id="dea_passwd" /><font color="red">*</font></p>
				<hr />
				<p><label>注：*号为必填选项</label></p>
                <input type="submit" value="提交" name="submit" />
			</fieldset>
		</form>
	</div>
</div>
<script type="text/javascript">
function check_form()
{
	if(''==$("#dea_name").val())
	{
		alert("请填写企业名称");
		return false;
	}
	if(''==$("#dea_address").val())
	{
		alert("请填写企业地址");
		return false;
	}
	/*	
	if(''==$("#dea_phone").val() && ''==$("#dea_tel").val())
	{
		alert("手机和座机最少填写一项");
		return false;
	}
	*/
	if(''==$("#dea_username").val() || ''==$("#dea_passwd").val())
	{
		alert("帐号和密码均不能为空");
		return false;
	}
}
</script>
</body>
</html>

