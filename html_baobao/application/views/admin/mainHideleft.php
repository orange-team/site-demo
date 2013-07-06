<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>显示/隐藏左侧导航栏</title>
<style type="text/css">
body { padding:0; margin:0;}
#switchpic {
	width: 6px;
	cursor:pointer;
	clear: both;
	vertical-align: bottom;
	margin-top: 220px;
}
#switchpic img { border:0;}
</style>

<script language="JavaScript" type="text/javascript">
	function Submit_onclick(){
		if(parent.myFrame.cols == "199,7,*"){
			parent.myFrame.cols="0,7,*";
			document.getElementById("ImgArrow").src="/adminStatic/img/switch_right.gif";
			document.getElementById("ImgArrow").alt="打开左侧导航栏";
		}else{
			parent.myFrame.cols="199,7,*";
			document.getElementById("ImgArrow").src="/adminStatic/img/switch_left.gif";
			document.getElementById("ImgArrow").alt="隐藏左侧导航栏";
		}
	}

	function MyLoad() {
		if(window.parent.location.href.indexOf("MainUrl")>0) {
			window.top.midFrame.document.getElementById("ImgArrow").src="/adminStatic/img/switch_right.gif";
		}
	}
</script>
</head>
<body onload="MyLoad()">
<div id="switchpic"><a href="javascript:Submit_onclick()"><img src="/adminStatic/img/switch_left.gif" alt="隐藏左侧导航栏" id="ImgArrow" /></a></div>
</body>
</html>
