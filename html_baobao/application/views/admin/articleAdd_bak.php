<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>博华汇川网站管理后台--发布文章</title>

<!-- CSS -->
<link href="/adminStatic/css/comment_new.css" rel="stylesheet" type="text/css" media="screen" />
<!--[if IE 6]><link rel="stylesheet" type="text/css" media="screen" href="/adminStatic/css/ie6.css" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" media="screen" href="/adminStatic/css/ie7.css" /><![endif]-->

<!-- JavaScripts-->
<script type="text/javascript" src="/adminStatic/js/jquery.js"></script>
<script type="text/javascript" src="/adminStatic/js/jNice.js"></script>
</head>
<body>
<div id="main">
	<?php echo form_open(site_url('admin/article/saveAdd'), array('class'=>"jnice"));?>
	<input type="hidden" name="cate_id" value="<?php echo $cate_id;?>"/>
	<h3>发布 -- <?php echo $type;?></h3>
	<h6><?php if(isset($data)) echo $data;?></h6>
		<fieldset>
			<p><label>文章标题:</label><input type="text" name="title" class="text-long" value=""/></p>
			<p><label>文章内容:</label>
			<?php echo $kindeditor;?>
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

</body>
</html>
