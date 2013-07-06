<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>网站后台管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?=base_url()?>adminStatic/css/transdmin.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="<?=base_url()?>adminStatic/js/jquery.js"></script>
<script type="text/javascript" src="<?=base_url()?>adminStatic/js/jNice.js"></script>
</head>

<body>
<div id="wrapper">
	<div id="main">
    	<h2><a href="javascript:void(0);">管理员列表</a> &raquo; <a href="javascript:void(0);" class="active"></a></h2>
    
        <form action="" class="jNice">
			<h3><a href="/admin/user/add/">新增用户</a></h3>
			<table cellpadding="0" cellspacing="0">
            	<tr>
                	<th>用户名</th>
                    <th>用户真实姓名</th>
                    <th>新增时间</th>
                	<th class="action">操作功能</th>
                </tr>
				<?php foreach($userArr as $k=>$v) { ?>
				<tr<?php if(0==$k%2) echo ' class="odd"';?>>
                	<td><a href="javascript:void(0);"><?php echo $v['user_name'];?></a></td>
                    <td><?php echo $v['user_realname'];?></td>
                    <td><?php echo $v['user_add_time'];?></td>
                	<td class="action">

					<a href="<?php echo site_url('admin/user/edit').'/'.$v['user_id'];?>" class="edit">修改</a>&nbsp; 
					<a href="javascript:if(confirm('确定删除吗？')) location.href='<?php echo site_url('admin/user/del').'/'.$v['user_id'];?>'; " class="edit">删除</a></td>
                </tr>   
				<?php } ?>
			</table>
					
		</form>
	</div>
</div>
</body>
</html>
