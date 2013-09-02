<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>文章修改网站后台管理</title>
<link rel="stylesheet" href="/adminStatic/css/common_new.css" type="text/css" />
</head>

<body>
<div id="man_zone">
	<h5>&nbsp;&nbsp;◆ 百科修改&nbsp;&raquo;&nbsp;<span style='color:red'><b>*</b></span> 代表必填项；</h5>
    <?php echo form_open(site_url('admin/wiki/saveEdit/'.$id), array('class'=>"jnice","onsubmit"=>"return check_form()","enctype"=>"multipart/form-data"));?>
  	<table width="96%" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style">
    	<tr>
      		<td class="left_title_1"><span style='color:red'>*</span>&nbsp;所属栏目</td>
      		<td>
      			<select name="tag_id" id="tag_id" >
                	<option value="0">-- 请选择 --</option>
                    <?php if(!empty($tags)) {foreach($tags as $k=>$v) {?>
                    <option value="<?php echo $v['id']?>" <?php if($v['id'] == $tag_id) echo 'selected';?> style="background-color:#FFC;"><?php echo $v['name']?></option>
                    <?php }} ?>
                </select>
                <span style="color:red;" id="errorTag"></span>
            </td>
    	</tr>
    	<tr>
      		<td width="18%" class="left_title_2">百科关键词</td>
            <td width="82%"><input class="text_style" type="text" name="wiki_key" id="wiki_key" value="<?php echo $wiki_key ?>" /> <span style="color:red;" id="errorKeyword"></span></td>
    	</tr>
    	<tr>
      		<td width="18%" class="left_title_1">百科图片</td>
            <td width="82%">
                <?php if(empty($wiki_img)){ echo '还没有上传百科图片...';}else{ ?>
                <img src="/uploads/wiki/<?php echo $wiki_img;?>" border="0" />
                <?php } ?>
                <input  type="file" name="wiki_image" id="wiki_image" /> </td>
    	</tr>
    	<tr>
      		<td class="left_title_2">百科内容</td>
      		<td> <?php echo $kindeditor;?> <span style="color:red;" id="errorContent"></span></td>

    	</tr>
        <tr>
      		<td class="left_title_2">&nbsp;</td>
      		<td><input type="submit" name="submit" value=" 提交 " />&nbsp;&nbsp;
            <input type="reset" name="reset" value=" 重置 " />
            </td>
    	</tr>
  	</table>
    </form>
    <br />
    <br /><br />
</div>
</body>
<script type="text/javascript" src="/adminStatic/js/jquery.js" ></script>
<script type="text/javascript" src="/adminStatic/js/common.js" ></script>
<script type="text/javascript">
function check_form()
{
    var tag_id = $("#tag_id").val();
    var wiki_key = $("#wiki_key").val();
    if(tag_id != '' && wiki_key != 0 &&  wiki_wiki_content != 0)
    {
        return true;
    }else
    {
        if(0==tag_id)
        {
            $("#errorTag").html('所属标签不能为空!');
        }else if(0==wiki_key)
        {
            $("#errorKeyword").html('关键词不能为空！');
        }
        return false;
    }
}
</script>
</html>
