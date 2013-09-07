<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>深度原创修改网站后台管理</title>
<link rel="stylesheet" href="/adminStatic/css/common_new.css" type="text/css" />
<script type="text/javascript" src="/adminStatic/js/jquery.js" ></script>
</head>
<body>
<div id="man_zone">
	<h5>&nbsp;&nbsp;◆ 深度原创修改&nbsp;&raquo;&nbsp;<span style='color:red'><b>*</b></span> 代表必填项；</h5>
    <?php echo form_open(site_url('admin/'.$this->_class.'/saveEdit/'.$id), array('class'=>"jnice","onsubmit"=>"return check_form()"));?>
  	<table id="table" width="96%" border="0" align="center" cellpadding="3" cellspacing="1" class="table_style">
    	<tr>
      		<td width="100px" class="left_title_1"><span style='color:red'>*</span>&nbsp;栏目</td>
      		<td>
      			<select name="one" id="one" onchange="changeOn('one',this.value,1)">
                	<option value="0">-- 请选择 --</option>
                    <?php if(chk($one_section)) {foreach($one_section as $k=>$v) {?>
                    <option value="<?php echo $v['id']?>" <?php if($one != '' && $one['id'] == $v['id']){ echo 'selected';}?> style="background-color:#FFC;"><?php echo $v['name']?></option>
                    <?php }} ?>
                </select>
                <select style="display:inline;" name="two" id="two" onchange="changeOn('two',this.value,1)">
                    <option value='0'>-- 请选择 --</option>
                    <?php if($two_section != ''){ foreach($two_section as $k=>$v){ ?>
                    <option value="<?php echo $v['id']; ?>" <?php if($v['id'] == $two['id']) echo 'selected'; ?>><?php echo $v['name'];?></option>
                    <?php }} ?>
                </select>
                <select style="display:inline;" name="three" id="three" onchange="changeOn('three',this.value),1">
                    <option value='0'>-- 请选择 --</option>
                    <?php if($three_section != ''){ foreach($three_section as $k=>$v){ ?>
                    <option value="<?php echo $v['id']; ?>" <?php if($v['id'] == $section) echo 'selected'; ?>><?php echo $v['name'];?></option>
                    <?php }} ?>
                </select>
                <span style="color:red;" id="errorSection"></span>
            </td>
    	</tr>
    	<tr>
      		<td class="left_title_2"><span style='color:red'>*</span>&nbsp;关键词</td>
      		<td>
      			<select name="keyword" id="keyword">
                	<option value="0">-- 选择关键词 --</option>
                    <?php if(chk($keywords)) {foreach($keywords as $v) {?>
                    <option value="<?php echo $v['id']?>" <?php if($v['id'] == $keyword) echo 'selected' ;?>><?php echo $v['name'];?></option>
                    <?php }} ?>
                </select>
                <span style="color:red;" id="errorKeyword"></span>
                <span style="color:green;" id="statistics_substr"></span>
                <a href="javascript:engine_search('keyword');" target="_blank" class="search">点击搜索</a>
      		</td>
    	</tr>
    	<tr>
      		<td class="left_title_1"><span style='color:red'>*</span>&nbsp;标题</td>
            <td>
            <input class="text_style" type="text" name="title" id="title" value="<?php echo $title;?>" /> <span style="color:red;" id="errorTitle"></span>
            <a href="javascript:engine_search('title');" target="_blank" class="search">点击搜索</a>
            </td>
    	</tr>
    	<tr>
      		<td class="left_title_2">副标题</td>
            <td><input class="text_style" type="text" name="subtitle" id="subtitle" value="<?php echo $subtitle;?>" />
            <a href="javascript:engine_search('subtitle');" target="_blank" class="search">点击搜索</a>
            </td>
    	</tr>
    	<tr>
    		<td class="left_title_1">来源</td>
            <td><input class="text_style" type="text" name="source" value="<?php echo $source;?>" />
            </td>
    	</tr>
        <tr>
    		<td class="left_title_2">相关标签</td>
    		<td>
                <div id="my_tag" class="my_tag clearfloat">
                    <button onclick="show_div()" type="button">添加标签</button>
                </div>
            </td>
    	</tr>
    	<tr>
      		<td class="left_title_2">内容</td>
      		<td> <?php echo $kindeditor;?></td>
    	</tr>
        <tr>
      		<td class="left_title_2">&nbsp;<input type="hidden" name='section' id='section' value='' /></td>
      		<td><input type="submit" name="submit" value=" 提交 " />&nbsp;&nbsp;
            <input type="button" name="back" value=" 返回 " onclick="window.location.href='<?php echo site_url('admin/'.$this->_class.'/showList/');?>'"/>
            </td>
    	</tr>
  	</table>
    </form>
    <div class="img_lib">
        <span class="title">图片库</span>
        <dl>
        <?php if(chk($img_libArr)) {foreach($img_libArr as $k=>$v) {?>
        <dt><img src="<?php echo $v['path']?>" title="<?php echo $v['title']?>" onclick="insert(this)"/></dt>
        <?php }} ?>
        </dl>
    </div>
</div>
<script type="text/javascript" src="/adminStatic/js/common.js" ></script>
<style>
.search {display:none;}
.img_lib { float:right; z-index:999; position:fixed; bottom:50px; right:100px;/*position:absolute; top:0; right:10px;*/ border:1px solid grey; width:150px;height:400px; overflow-y:scroll;}
.img_lib .title {display:block;background:#F3F8F7;color:#73938E;width:100%;line-height:30px;height:30px;font-weight:bold;text-align:center;}
.img_lib dl img {width:130px;height:auto;margin:5px 0;opacity:0.5;}
.img_lib dl img:hover {opacity:1;}
.img_lib dl:hover {background:#f3f8f7;}
.jnice { position:relative; }

.ke-icon-replace { background-image: url(/adminStatic/editor/themes/common/hello.gif); width: 16px; height: 16px; }
</style>
<script type="text/javascript">
function insert(handle)
{
    var html = '<img src="'+handle.src+'" title="'+handle.title+'" />';
    editor.insertHtml(html);
}

$(function(){
    $('#table tr').mouseover(function(){
        $(this).find('a.search').show();
    }).mouseout(function(){
        $(this).find('a.search').hide();
    });
    $('#keyword').change(statistics_substr);
    statistics_substr();
});

//统计关键词在内容出现次数
function statistics_substr(){
    var keyword = $("#keyword").find("option:selected").text();
    if( keyword ) {
        var bigstr = $('#content').val();
        var result = bigstr.match(new RegExp(keyword), 'g');
        var match_count = (null==result) ? 0 : bigstr.match(new RegExp(keyword,'g')).length;
        $('#statistics_substr').html(' 文中共有关键词 <span style="color:red;">'+keyword+'</span>：'+match_count+'次 ');
   }
}
//搜索
function engine_search(id)
{
    var wd = $('#'+id).val();
    window.open('<?php echo $this->baiduSearch?>'+wd);
}
</script>
<?php
$this->load->helper('admin');
relation_tag($id, 1, $tagNameArr);
?>
<script type="text/javascript">
function check_form()
{
    var one = $("#one").val();
    var two = $("#two").val();
    var three = $("#three").val();
    var keyword = $("#keyword").val();
    if(0!=three)
    {
        section = three;
    }else if(0!=two)
    {
        section = two;
    }else if(0!=one)
    {
        section = one;
    }
    $("#section").val(section);
    var section = $("#section").val();
    var title = $("#title").val();
    if(title != '' && section != 0 &&  keyword != 0)
    {
        return true;
    }else
    {
        if(0==section)
        {
            $("#errorSection").html('深度原创所属栏目不能为空！');
        }else if(0==keyword)
        {
            $("#errorKeyword").html('关键词不能为空！');
        }else
        { 
            $("#errorTitle").html('深度原创栏目不能为空！');
        }
        return false;
    }

}
</script>
</body>
</html>
