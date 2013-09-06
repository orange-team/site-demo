<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/adminStatic/css/common_new.css" type="text/css" />
<script type="text/javascript" src="/adminStatic/js/jquery.js" ></script>
<script type="text/javascript" src="/adminStatic/js/common.js" ></script>
<title>网站后台管理-新增百科</title>
<script type="text/javascript">
function check_form()
{
    var tag_id = $("#tag_id").val();
    var wiki_keyword = $("#wiki_keyword").val();
    if(tag_id != '' && wiki_keyword != 0 &&  wiki_content != 0)
    {
        return true;
    }else
    {
        if(0==tag_id)
        {
            $("#errorTag").html('所属标签不能为空!');
        }else if(0==wiki_keyword)
        {
            $("#errorKeyword").html('关键词不能为空！');
        }
        return false;
    }

}
</script>
</head>

<body>
<div id="man_zone">
	<h5>&nbsp;&nbsp;◆ 新增百科&nbsp;&raquo;&nbsp;<span style='color:red'><b>*</b></span> 代表必填项；</h5>
	<?php echo form_open(site_url('admin/wiki/saveAdd'), array('class'=>"jnice","onsubmit"=>"return check_form()","enctype"=>"multipart/form-data"));?>
  	<table width="96%" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style">
    	<tr>
      		<td class="left_title_1"><span style='color:red'>*</span>&nbsp;所属标签</td>
      		<td>
      			<select name="tag_id" id="tag_id" >
                	<option value="0">-- 请选择 --</option>
                    <?php if(!empty($tags)) {foreach($tags as $k=>$v) {?>
                    <option value="<?php echo $v['id']?>" style="background-color:#FFC;"><?php echo $v['name']?></option>
                    <?php }} ?>
                </select>
                <span style="color:red;" id="errorTag"></span>
            </td>
    	</tr>
    	<tr>
      		<td width="18%" class="left_title_2">百科关键词</td>
      		<td width="82%"><input class="text_style" type="text" name="wiki_keyword" id="wiki_keyword" /> <span style="color:red;" id="errorKeyword"></span></td>
    	</tr>
    	<tr>
      		<td width="18%" class="left_title_1">百科图片</td>
      		<td width="82%"><input  type="file" name="wiki_image" id="wiki_image" /> </td>
    	</tr>
    	<tr>
      		<td class="left_title_2">百科内容</td>
      		<td> <?php echo $kindeditor;?> <span style="color:red;" id="errorContent"></span></td>

    	</tr>
        <tr>
      		<td class="left_title_1">&nbsp;</td>
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
</html>
