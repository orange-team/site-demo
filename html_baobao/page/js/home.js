$(function(){
    //6张焦点图区域效果
    $('#pic_hot .item').mouseover(function(){
            $(this).siblings().find('div[rel=cover]').show();
        }).mouseout( function(){
            $('#pic_hot div[rel=cover]').hide();
        });
});

//育儿百科栏目，显示对应的panel
function show_panel(t) {
    var on = $(t).parent().find('dt[class=on]');
    if( on.html() != $(t).html() ) {
        var on_sort = on.attr('sort');
        $('#panel_'+on_sort).hide();
        on.removeClass('on');
        $(t).addClass('on');
    }
    $('#panel_'+$(t).attr('sort')).show();
}
function showHide(id)
{
    var showBox = $("#show_"+id);
    var imgSrc  = $("#img_"+id);   
    showBox.toggle();
    if(true == showBox.is(":visible"))//判断元素显示或隐藏状态                                                                                     
    {
       imgSrc.attr('src','img/top.jpg');
    }else
    {
       imgSrc.attr('src','img/bottom.jpg');
    }
}
function showTitle()
{
    $("#info").css('display','block');
}
function hideTitle()
{
    $("#info").css('display','none');
}
