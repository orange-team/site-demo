﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/adminStatic/css/common_new.css" type="text/css" />
<title>通用后台管理系统</title>
</head>
<frameset rows="78,*,30" cols="*" frameborder="no" border="0" framespacing="0">
    <frame src="<?php echo site_url('admin/main/top');?>" name="topFrame" frameborder="no" scrolling="No" noresize="noresize" id="topFrame" title="topFrame" />
    <frameset name="myFrame" id="myFrame" cols="199,7,*" frameborder="no" border="0" framespacing="0">
    	<frame src="<?php echo site_url('admin/main/left');?>" name="leftFrame" frameborder="no" scrolling="No" noresize="noresize" id="leftFrame" title="leftFrame" />
        <frame src="<?php echo site_url('admin/main/hideLeft');?>" name="midFrame" frameborder="no" scrolling="No" noresize="noresize" id="midFrame" title="midFrame" />
	<frame src="<?php echo site_url('admin/main/right');?>" name="mainFrame" frameborder="no" id="mainFrame" title="mainFrame" />
    </frameset>
    <frame src="<?php echo site_url('admin/main/bottom');?>" name="bottomframe" frameborder="no" scrolling="No" noresize="noresize" id="bottomframe" title="bottomframe" />
</frameset>
<noframes>
<body>
</body>
</noframes>
</html>
