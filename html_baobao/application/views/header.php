<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $seo['title']?></title>
<meta name="description" content="<?php echo $seo['description']?>" />
<meta name="keywords" content="<?php echo $seo['keywords']?>" />
<link rel="shortcut icon" href="/img/favicon.ico" />
<link href="/css/common.css" rel="stylesheet" type="text/css" />
<link href="/css/<?php echo $file['css']?>.css?v=0.11" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="header">
    <div class="top_nav"> </div>
    <div class="nav"></div>
    <div class="hd_box">
        <div class="top_nav_rg">
            <a class="login">登录</a> 
            <a>免费注册</a> 
            <a><img src="/img/xina.png" width="25" height="25" /> 微薄登录</a> 
            <a><img src="/img/qq.png" width="25" height="25" /> QQ登录</a> 
        </div>
        <div class="search">
            <form action="" method="">
                <select name="type" class="input_select">
                    <option value="全部">全部</option>
                <select>
                <input type="text" name="search_name"  class="input_type"/>
                <input type="submit" name="search_submit" value class="input_submit" />
            </form>
        </div>
        <img class="logo" src="/img/logo.jpg" height="70" width="70" />
        <img class="logo_font" src="/img/logo_font.jpg" height="25" width="80">
        <div class="nav_section">
            <ul>
                <li><a href="/mmxue/" class="default">妈妈学</a></li>
                <li><a href="#">妈妈说</a></li>
                <li><a href="#">妈妈看</a></li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
</div><!--header-->

