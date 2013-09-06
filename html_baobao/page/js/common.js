/** 下拉导航 **/
$(function(){
	var $nav_li = $(".nav ul li.sub");
	
	$nav_li.hover(function(){
			$(this).find("a:first").addClass("selected2");
            $(this).find("div").show();
    },function(){
			$(this).find("a:first").removeClass("selected2");
            $(this).find("div").hide();
    })
});