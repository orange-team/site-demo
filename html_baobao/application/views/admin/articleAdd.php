<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/adminStatic/css/common_new.css" type="text/css" />
<script type="text/javascript" src="/adminStatic/js/jquery.js" ></script>
<script type="text/javascript" src="/adminStatic/js/common.js" ></script>
<title>文章添加网站后台管理</title>
<script type="text/javascript">
function check_form()
{
    var section = $("#section_id").val();
    var tag = $("#tag").val();
    var title = $("#title").val();
    if(title != '' && section != 0 &&  tag != 0)
    {
        return true;
    }else
    {
        if(0==section)
        {
            $("#errorSection").html('文章所属栏目不能为空！');
        }else if(0==tag)
        {
            $("#errorKeyword").html('标签不能为空！');
        }else
        { 
            $("#errorTitle").html('文章栏目不能为空！');
        }
        return false;
    }

}
</script>
</head>

<body>
<div id="man_zone">
	<h5>&nbsp;&nbsp;◆ 文章发布&nbsp;&raquo;&nbsp;<span style='color:red'><b>*</b></span> 代表必填项；</h5>
	<?php echo form_open(site_url('admin/article/saveAdd'), array('class'=>"jnice","onsubmit"=>"return check_form()"));?>
  	<table width="96%" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style">
    	<tr>
      		<td class="left_title_1"><span style='color:red'>*</span>&nbsp;所属栏目</td>
      		<td>
      			<select name="section" id="section_id" onchange="changeOn(this.value)">
                	<option value="0">-- 请选择 --</option>
                    <?php if(!empty($section)) {foreach($section as $k=>$v) {?>
                    <option value="<?php echo $v['id']?>" style="background-color:#FFC;"><?php echo $v['name']?></option>
                    <?php }} ?>
                </select>
                <span style="color:red;" id="errorSection"></span>
            </td>
    	</tr>
    	<tr>
      		<td class="left_title_2"><span style='color:red'>*</span>&nbsp;所属标签</td>
      		<td>
      			<select name="tag" id="tag">
                	<option value="0">-- 选择标签 --</option>
                </select>
                <span style="color:red;" id="errorKeyword"></span>
      		</td>
    	</tr>
    	<tr>
      		<td width="18%" class="left_title_1"><span style='color:red'>*</span>&nbsp;标题</td>
      		<td width="82%"><input class="text_style" type="text" name="title" id="title" /> <span style="color:red;" id="errorTitle"></span></td>
    	</tr>
    	<tr>
      		<td class="left_title_2">副标题</td>
      		<td><input class="text_style" type="text" name="subtitle" /></td>
    	</tr>
    	<tr>
      		<td class="left_title_1">页面描述</td>
            <td><input class="text_style" type="type" name="description"/></td>
    	</tr>
    	<tr>
    		<td class="left_title_2">SEO关键字</td>
    		<td><input type="text" class="text_style" name="page_keywords"  /></td>
    	</tr>
    	<tr>
    		<td class="left_title_1">关注度</td>
    		<td><input type="text" class="text_style w_50" name="attention"  /></td>
    	</tr>
    	<tr>
    		<td class="left_title_2">文章来源</td>
    		<td><input type="text" class="text_style" name="source"  /></td>
    	</tr>
    	<tr>
      		<td class="left_title_1">文章内容</td>
      		<td> <?php echo $kindeditor;?></td>

    	</tr>
    	<tr>
      		<td class="left_title_2">是否推荐</td>
      		<td>
      			<input type="radio" name="recommend" value="1" />是  &nbsp;&nbsp;
      			<input type="radio" name="recommend" checked value="0" />否  &nbsp;&nbsp;
      		</td>
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
</html>
