//anchor slide move
$(function(){
   $("#letter_nav a").click(function(){
        var rel=$(this).attr("rel");
        if (null==$(rel).offset()) return;
        var pos=$(rel).offset().top;
        $("html,body").animate({scrollTop:pos-80}, 800);
	});
   $("b[class=key]").click(function(){
        var top_pos = $('#myTop').offset();
        if (null==top_pos) return;
        var pos=top_pos.top;
        $("html,body").animate({scrollTop:pos}, 0);
	});
});

