<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>网站提示信息</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/adminStatic/css/transdmin.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="/adminStatic/js/jquery.js"></script>
<script type="text/javascript" src="/adminStatic/js/jNice.js"></script>
<!-- 倒计时 跳转-->
<script type="text/javascript">
<!--
var secs =3; 
function Load(url){
	URL =url; 
	for(var i=secs;i>=0;i--) { 
		window.setTimeout('doUpdate(' + i + ')', (secs-i) * 1000);
	 }
} 
function doUpdate(num) { 
	document.getElementById('ShowDiv').innerHTML = '<a href='+URL+'>将在'+num+'秒后自动跳转</a>' ;
	 if(num == 0) {
		 window.location=URL; 
	} 
} 
-->
</script>
</head>
<body onload="Load('<?php echo $url;?>')">
<div id="wrapper">
	<div id="main">
    	<h2><a href="#">提示信息</a> &raquo; <a href="#" class="active"><?php echo $msg;?></a></h2>
		<h3>&nbsp;&nbsp;<span id="ShowDiv">&nbsp;</span></h3>
		
	</div>
</div>
<script type="text/javascript">
<!--
<?php if( !empty($url) ) { ?>
function autoGo()
{
	window.location.href="<?php echo site_url($url);?>";
}
setTimeout(autoGo, 3000);
<?php } if( !empty($history) ) { ?>
setTimeout(function(){history.back();}, 3000);
<?php } ?>
-->
</script>
</body>
</html>
