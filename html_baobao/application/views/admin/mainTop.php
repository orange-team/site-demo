<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>头部</title>
<link href="/adminStatic/css/transdmin.css" rel="stylesheet" type="text/css" media="screen" />
<style type="text/css">
body { padding:0; background-color:#FFF;}
#header { text-align:left; border-bottom:1px #ddd solid; position:relative; padding-top:28px;}
#header .loginInfo { position:absolute; top:10px; left:280px;}
#header .loginInfo b { color:#c66653;}
</style>
</head>

<body>
<div id="header">
	<h1><a href="#"><span>bjprochina</span></a></h1>
    <div class="loginInfo">欢迎，管理员【<b>admin</b>】！</div>
    
    <ul id="mainNav">
   	  <li><a href="<?php echo site_url('login/doLogout');?>" target="_parent">退出</a></li>
    	<li><a href="/admin/main/right" target="mainFrame">账号管理</a></li>
    	<li><a href="/admin/overall/index" target="mainFrame">全局配置</a></li>
  </ul>
</div>
</body>
</html>