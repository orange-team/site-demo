
//显示弹出层
function show_div()
{
    var html = '<input type="text" id="relation_tag" onkeydown="enterIn(event);"/>'
        +'<input type="button" value="查询" onclick="do_ajax_search()"/>'
        +'<i id="notice_search_tag" class="notice"></i><br/>'
        +'<div id="easydialog_tag" class="easydialog_tag clearfloat"></div>'
        +'<br/>'
        ;
    easyDialog.open({
        container : {
            header : '标签选择器',
            yesFn : tag_yesFn,
            noFn : tag_noFn,
            yesText : true,
            noText : true,
            content : html
        },
        lock : true, //不开启Esc关闭
        overlay : true,
        //callback : show_checked_tag,
    });
    $("#relation_tag").focus();
    showNotice('notice_search_tag','请输入要查询的标签');
}

//点击“确定”按钮的回调函数
function tag_yesFn(type)
{
    var items = [];
    for ( var i in tag_container.tmp_list )
    {
        if( tag_container.tmp_list[i] != null )
        {
            items.push('<input type="checkbox" checked name="tag_list" value="" id="box_tag_'
                    + i + '" onclick="do_checkbox(\''+i+'\')" my_type="1">'
                    + '<label for="box_tag_' + i + '">'
                    + tag_container.tmp_list[i] + '</label></input>');
            tag_container.list[i] = tag_container.tmp_list[i];
            //ajax增加标签和文章的关联
            if(type!='init') do_ajax_relation_tag(i,'add');
        }
    }
    $("#my_tag button").before(items.join(''));
    //$("#my_tag").append(items.join(''));
    //清空临时容器
    tag_container.tmp_list = {};
    tag_container.key = null;
    return true;
}

//点击checkbox判断
function do_checkbox(tag_id)
{
    var chk_type = $('#box_tag_'+tag_id).is(':checked')
    if( true==chk_type )
    {
        do_ajax_relation_tag(tag_id,'add');
    }else
    {
        do_ajax_relation_tag(tag_id,'del');
    }
}

//ajax增加标签和文章的关联
function do_ajax_relation_tag(tag_id,type)
{
    if(null==tag_container.target_id || ''==tag_container.target_id)
    {
        alert('func do_ajax_relation_tag 未获得target_id');
        return ;
    }
    $.get('/admin/relation_tag/oprate', {'oprate_type':type,'tag_id':tag_id,'target_id':tag_container.target_id,'target_type':tag_container.target_type}, function(data) {
        if(-1==data) alert('参数传递失败');
        if(-2==data) alert('数据插入失败');
    });
}

//点击“取消”按钮的回调函数
function tag_noFn()
{
    //清空临时容器
    tag_container.tmp_list = {};
    tag_container.key = null;
    return true;
}

//ajax获取标签
function do_ajax_search()
{
    var txt = $("#relation_tag").val();
    if(''==txt)
    {
        showNotice('notice_search_tag','请输入要查询的标签');
        return $("#relation_tag").focus();
    }else if(tag_container.key==txt){
        //不再重复查询，减少不必要的http请求
        return ;
    }
    tag_container.key = txt;
    var not_in_str = '';
    for (var i in tag_container.list) {
        not_in_str += '-'+i;
    }
    $.getJSON('/admin/tag/ajax_get/'+txt+'/'+not_in_str.substr(1), function(data) {
        var items = [], sum=0;
        $.each(data, function(key, val) {
            //if( key=='len' ) return;//在each中用return代替continue
            if( key=='len' ) {
                return sum = parseInt(val);
            }
            items.push('<a id="tag_' + key + '" onclick="do_chk(\''+key+'\')" type="0">' + val + '</a>');
        });
        $("#easydialog_tag").html(items.join(''));
        showNotice('notice_search_tag','总计：'+sum);
    });
}

//选择一个标签
function do_chk(id)
{
    var tag = $("#tag_"+id);
    if( tag.attr('type')==0 )
    {
        tag.css({'background':'#3079ed','color':'#fff'}).attr('type',1);
        //增加已选中的标签
        tag_container.tmp_list[id] = tag.text();
    }else{
        tag.css({'background':'#fff','color':'#555'}).attr('type',0);
        //减少已选中的标签
        tag_container.tmp_list[id] = null;
    }
}

//显示提示信息
function showNotice(id,notice)
{
    $("#"+id).text(notice);
}

//回车提交查询
function enterIn(evt)
{
    var evt=evt?evt:(window.event?window.event:null);//兼容IE和FF
    if (evt.keyCode==13)
    {
        return do_ajax_search();
    }
}


