<?php $this->load->view('admin/header',$this->_info)?>
<body>
<div id="man_zone">
    <?php $this->load->view('admin/editNav',$this->_info)?>
    <?php echo form_open(site_url('admin/'.$this->_info['cls'].'/saveEdit/'.$id), array('class'=>"jnice","onsubmit"=>"return check_form()"));?>
    <?php $this->load->view('admin/editTable')?>
    	<tr>
      		<td width="100px"><span style='color:red'>*</span>&nbsp;栏目</td>
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
      		<td><span style='color:red'>*</span>&nbsp;关键词</td>
      		<td>
      			<select name="keyword" id="keyword">
                	<option value="0">-- 选择关键词 --</option>
                    <?php if(chk($keywords)) {foreach($keywords as $v) {?>
                    <option value="<?php echo $v['id']?>" <?php if($v['id'] == $keyword) echo 'selected' ;?>><?php echo $v['name'];?></option>
                    <?php }} ?>
                </select>
                <span style="color:red;" id="errorKeyword"></span>
                <span style="color:green;" id="statistics_substr"></span>
                <a href="javascript:engine_tool('keyword','select','search');" target="_blank" class="search">点击搜索</a>&nbsp;&nbsp;
                <a href="javascript:engine_tool('keyword','select','index');" target="_blank" class="search">百度指数</a>
      		</td>
    	</tr>
    	<tr>
      		<td><span style='color:red'>*</span>&nbsp;标题</td>
            <td>
            <input class="text_style" type="text" name="title" id="title" value="<?php echo $title;?>" /> <span style="color:red;" id="errorTitle"></span>
            <a href="javascript:engine_tool('title','input','search');" target="_blank" class="search">点击搜索</a>&nbsp;&nbsp;
            <a href="javascript:engine_tool('title','input','index');" target="_blank" class="search">百度指数</a>
            </td>
    	</tr>
    	<tr>
      		<td>副标题</td>
            <td><input class="text_style" type="text" name="subtitle" id="subtitle" value="<?php echo $subtitle;?>" />
            <a href="javascript:engine_tool('subtitle','input','search');" target="_blank" class="search">点击搜索</a>&nbsp;&nbsp;
            <a href="javascript:engine_tool('subtitle','input','index');" target="_blank" class="search">百度指数</a>
            </td>
    	</tr>
        <tr>
      		<td>页面描述</td>
            <td><input class="text_style" type="type" name="description" value="<?php echo $description;?>"/></td>
    	</tr>
    	<tr>
    		<td>SEO关键字</td>
    		<td><input type="text" class="text_style" name="page_keywords" value="<?php echo $page_keywords;?>"/></td>
    	</tr>
    	<tr>
    		<td>关注度</td>
    		<td><input type="text" class="text_style w_50" name="attention" value="<?php echo $attention;?>"/></td>
    	</tr>
    	<tr>
    		<td>来源</td>
            <td><input class="text_style" type="text" name="source" value="<?php echo $source;?>" />
            </td>
    	</tr>
        <tr>
    		<td>相关标签</td>
    		<td>
                <div id="my_tag" class="my_tag clearfloat">
                    <button onclick="show_div()" type="button">添加标签</button>
                </div>
            </td>
    	</tr>
        <tr>
    		<td>抽取标签</td>
    		<td>
                <div id="extract_tag" class="extract_tag clearfloat">
                    <span><a href="#">2岁宝宝</a>[<em>23</em>]</span>
                    <span><a href="#">4岁宝宝</a>[<em>3</em>]</span>
                    <button onclick="javascript:high.light(this)" type="button">高亮</button>
                </div>
            </td>
    	</tr>
    	<tr>
      		<td>内容</td>
      		<td> <?php echo $kindeditor;?></td>
    	</tr>
        <tr>
      		<td>是否推荐</td>
      		<td>
      			<input type="radio" name="recommend"<?php if(1==(int)$recommend) echo ' checked';?> value="1" id="rec_1"/><label for="rec_1">是</label>  &nbsp;&nbsp;
      			<input type="radio" name="recommend"<?php if(0==(int)$recommend) echo ' checked';?> value="0" id="rec_2"/><label for="rec_2">否</label>  &nbsp;&nbsp;
      		</td>
    	</tr>
        <tr>
      		<td>&nbsp;<input type="hidden" name='section' id='section' value='' /></td>
      		<td><?php $this->laod->view('admin/editSubmit',$this->_info)?></td>
    	</tr>
  	</table>
    </form>
    <div class="img_lib">
        <span class="title">图片库</span>
        <dl>
        <?php if(isset($img_libArr)) {foreach($img_libArr as $k=>$v) {?>
        <dt><img src="<?php echo $v['path']?>" title="<?php echo $v['title']?>" onclick="insert(this)"/></dt>
        <?php }}else{ echo '暂无相关标签对应的图片';} ?>
        </dl>
    </div>
</div>
<style type="text/css">
.search {display:none;}
.img_lib { float:right; z-index:999; position:fixed; bottom:50px; right:100px;/*position:absolute; top:0; right:10px;*/ border:1px solid grey; width:150px;height:400px; overflow-y:scroll;}
.img_lib .title {display:block;background:#F3F8F7;color:#73938E;width:100%;line-height:30px;height:30px;font-weight:bold;text-align:center;}
.img_lib dl img {width:130px;height:auto;margin:5px 0;opacity:0.5;}
.img_lib dl img:hover {opacity:1;}
.img_lib dl:hover {background:#f3f8f7;}
.jnice { position:relative; }
/* kindeditor替换按钮 */
.ke-icon-replace { background-image: url(/adminStatic/editor/themes/common/hello.gif); width: 16px; height: 16px; }
/* 高亮本行 */
//#table tr:hover{ background-color:red; //使用CSS伪类达到鼠标移入行变色的效果，比Jquery 的mouseover,hover 好用 }
</style>
<?php
$this->load->helper('admin');
relation_tag($id, 3, $tagNameArr);
?>
<?php $this->load->view('admin/common',$this->_info);?>
<script type="text/javascript">

//插入图片库图片
function insert(handle){
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
//高亮
var high = {
    clicked : 0,
    light : function (t){
        this.turn(t);
        //alert(this.clicked);
        //editor的内容
        var str = editor.html();
        var tagList = $('#extract_tag').find('span a');
        /* test for upperCase
        var newstr=str.replace(/\b\w+\b/g, function(word){
                return word.substring(0,1).toUpperCase()+word.substring(1);}
                );
        */
        //editor.html(newstr);
        //var exp = new RegExp('a');
        var tag=exp='' ;
        if(1==this.clicked){
            tagList.each(function(i,item){
                tag = $(this).text();
                num = $(this).siblings(1).text();
                exp = new RegExp(tag,'g');
                style = 'style="color:green;font-size:'+num+'px;"';
                str = str.replace(exp, function(word){ return '<a href="#" '+style+'>'+word+'</a>'; });
            });
        }else{
            tagList.each(function(i,item){
                tag = $(this).text();
                exp = new RegExp('<a[^>]*?>'+tag+'<\/a>','g');
                str = str.replace(exp, tag);
            });
        }
        editor.html(str);
    },
    turn : function (t){
        $(t).text((0==this.clicked)?'取消':'高亮');
        this.clicked = this.clicked^1;
    }

}
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
function engine_tool(id,type,tool_type)
{
    var wd = (type=='select') ? $('#'+id).find('option:selected').text() : $('#'+id).val();
    var url = ('search'==tool_type) ? '<?php echo $this->baidu['search']?>'+wd : '<?php echo $this->baidu['index']?>'+wd;
    window.open(('search'==tool_type) ? url : '<?php echo site_url('admin/original/go_baidu_index');?>/'+wd);
}
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
            $("#errorSection").html('所属栏目不能为空！');
        }else if(0==keyword)
        {
            $("#errorKeyword").html('关键词不能为空！');
        }else
        { 
            $("#errorTitle").html('栏目不能为空！');
        }
        return false;
    }

}
</script>
<style type="text/css">
.extract_tag a { margin:0 0 0 5px; }
/* editor中高亮 */
.highlight {border:1px solid #73938E;background:#333;font-size:20px;}
</style>
</body>
</html>
