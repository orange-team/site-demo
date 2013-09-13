$(function(){
    //隔行变色
    $('#table tr:even').find('td:nth-child(1)').addClass('left_title_1 even');
    $('#table tr:odd').find('td:nth-child(1)').addClass('left_title_2 odd');
});
//显示全部
function showAll()
{
    window.location.href="/admin/"+_info.cls+"/showlist/";
}
function chkform()
{
	var len = chkarr.length;
	var doSub = true;
	for ( var i=0; i<len; i++ )
	{
		var e = document.getElementById(chkarr[i]);
		if ( ''==e.value || null==e.value || !e.value )
		{
			if (!document.getElementById('tip_'+i))
			{
				var sp = document.createElement('SPAN');
				sp.id = 'tip_'+i;
				sp.className = 'vTipClass';
				sp.innerHTML = '&nbsp;&nbsp;此项不能为空!';
			
				var pe = e.parentNode;
				(pe.lastChild==e)? pe.appendChild(sp) 
								 : pe.insertBefore(sp,e.nextSibling);
			}
			if( doSub==true )
			{ 
				doSub=false;
				e.focus();
			}
		}else {
			if ( document.getElementById('tip_'+i) )
			{
				document.getElementById('tip_'+i).innerHTML='';
			}
		}
			
	}
	return doSub;
}
//栏目三级分类 Liangxifeng 2013-06-30
function changeOn(level,id,showKey)
{
    if('one' == level)
    {
        levelNew = 'two';
        $('#two,#three').find('option[value!=0]').remove();
    }else
    {
        levelNew = 'three';
        if('two' == level)
            $('#three').find('option[value!=0]').remove();
    }
    if(showKey == 1)
    {
        $('#keyword').find('option[value!=0]').remove();
    }
    $.ajax({
        type:"GET",
        url:"/admin/article/ajax_change",
        data:{'section_id':id,'showKey':showKey},
        dataType:"json",
        cache:false,
        success:function(msg){
            if(msg != -1)
            {
                $("#"+levelNew).css("display","inline");
                $.each( msg, function(i, n){
                    if(i != 'keywords')
                    {
                        $("#"+levelNew).append("<option value='"+n.id+"'>"+n.name+"</option>");//子栏目
                    }else if(showKey == 1 && i == 'keywords')
                    {
                        $.each(n,function(ki,kv)
                        {
                            $("#keyword").append("<option value='"+kv.id+"'>"+kv.name+"</option>");//该栏目下的关键词
                        });
                    }
                });
            }/*else
            {
                if('three'!=level)
                    $("#"+levelNew+",#three").css("display","none");
            }*/
        }
    })
}

