<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>左侧导航</title>
<link href="<?=base_url()?>adminStatic/css/transdmin.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="<?=base_url()?>adminStatic/js/jquery.js"></script>
</head>
<body>
	<div id="sidebar">
		<ul class="sideNav">
	<?php 
	$stack = array(); $num=count($menuArr);static $f=0;
	for ($i=0; $i<$num; $i++) 
	{
		$row = $menuArr[$i];
		unset($menuArr[$i]);
		if (count($stack)>0) //仅当堆栈非空的时候检测
		{
			while ( count($stack)>1 && $row['rgt']>$stack[count($stack)-1] ) array_pop($stack);
			//while 循环结束之后，堆栈里边只剩下当前节点的父节点了
		}
		//if($i!=0)
		//{
			if( count($stack)==1 && $f==1 ) { $f=0;echo '</dl>';}
			if( count($stack)==1 ) 
			{
			$idNum = $i+1;
			echo '<li><a href="javascript:menu_toggle('.$idNum.');" class="active">'.$row['menu_name'].'</a></li>';
			}
			if( count($stack)==2 && $f==0 ) {$f=1;echo '<dl id="dl_'.$i.'" style="display:none;">';}
			if( count($stack)==2 ) 
			{
			echo '<dd>
					<a href="'.site_url('/admin'.$row['menu_admin_href']).'" target="mainFrame">'.$row['menu_name'].'</a>
				</dd>';
			}
			array_push($stack, $row['rgt']);
		//}
	}
	unset($menuArr,$stack,$row);
	?>
		</ul>
		<!-- // .sideNav -->
	</div>
<script type="text/javascript">
<!--
//二级菜单的收放
function menu_toggle(idNum)
{
	$('#dl_'+idNum).toggle();
}
-->
</script>
</body>
</html>