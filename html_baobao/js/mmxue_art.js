function showHide(id)
{
    var showBox = $("#show_"+id);
    var imgSrc  = $("img#img_"+id);
    showBox.toggle();

    if(true == showBox.is(":visible"))//判断元素显示或隐藏状态                                                                                     
    {
        imgSrc.attr('src','/img/top.jpg');
    }else
    {
       imgSrc.attr('src','/img/bottom.jpg');
    }
}

//文章内容页，显示和隐藏标题
function showTitle()
{
    $("#info").css('display','block');
}
function hideTitle()
{
    $("#info").css('display','none');
}

//文章列表页搜索
function search_go(num)
{
    if('' != num)
    {
        $("form").submit();
    }
}

var show_tag = function (t) {
    $(t).css('border-bottom-color','#333').find("div[rel=tag]").show();
};
var hide_tag = function (t) {
    $(t).css('border-bottom-color','#e4e4e4').find("div[rel=tag]").hide();
};
