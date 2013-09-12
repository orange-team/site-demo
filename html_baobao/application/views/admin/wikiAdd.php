<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站后台管理-新增<?php echo $this->_info['name']?></title>
<link rel="stylesheet" href="/adminStatic/css/common_new.css" type="text/css" />
<script type="text/javascript" src="/adminStatic/js/jquery.js" ></script>
</head>
<body>
<div id="man_zone">
	<h5>&nbsp;&nbsp;◆ 新增<?php echo $this->_info['name']?>&nbsp;&raquo;&nbsp;<span style='color:red'><b>*</b></span> 代表必填项；</h5>
	<?php echo form_open(site_url('admin/'.$this->_info['cls'].'/saveAdd'), array('class'=>"jnice","onsubmit"=>"return check_form()","enctype"=>"multipart/form-data"));?>
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
      		<td width="18%" class="left_title_2">关键词</td>
      		<td width="82%"><input class="text_style" type="text" name="<?php echo $this->_info['cls']?>_keyword" id="<?php echo $this->_info['cls']?>_keyword" /> <span style="color:red;" id="errorKeyword"></span></td>
    	</tr>
    	<tr>
      		<td width="18%" class="left_title_1">图片</td>
      		<td width="82%"><input  type="file" name="<?php echo $this->_info['cls']?>_image" id="<?php echo $this->_info['cls']?>_image" /> </td>
    	</tr>
    	<tr>
      		<td class="left_title_2">内容</td>
      		<td> <?php echo $kindeditor;?> <span style="color:red;" id="errorContent"></span></td>
    	</tr>
        <tr>
      		<td class="left_title_1">&nbsp;</td>
      		<td><input type="submit" name="submit" value=" 提交 " />&nbsp;&nbsp;
            <input type="button" name="back" value=" 返回 " onclick="window.location.href='<?php echo site_url('admin/'.$this->_info['cls'].'/showList/');?>'"/>
            </td>
    	</tr>
  	</table>
    </form>
</div>
<script type="text/javascript" src="/adminStatic/js/common.js" ></script>
<script type="text/javascript">
//定义控制器信息
var _info = {'cls':'<?php echo $this->_info['cls']?>', 'name':'<?php echo $this->_info['name']?>'};

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
</body>
</html>
