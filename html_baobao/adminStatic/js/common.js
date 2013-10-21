$(function(){
    //隔行变色
    $('#table tr:even').find('td:nth-child(1)').addClass('left_title_1 even');
    $('#table tr:odd').find('td:nth-child(1)').addClass('left_title_2 odd');
});
//页面跳转
function go(url)
{
    window.location.href=url;
}
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
function changeOn(id)
{
    $('#tag').find('option').remove();
    if( 0 == id )
    {
        $("#tag").append("<option value='"+id+"'>-- 请选择 --</option>");//子栏目
    }else
    {
        $.ajax({
            type:"GET",
            url:"/admin/article/ajax_change",
            data:{'section_id':id},
            dataType:"json",
            cache:false,
            success:function(msg){
                if(msg != -1)
                {
                    //$("#"+levelNew).css("display","inline");
                    $.each( msg, function(i, n){
                        $("#tag").append("<option value='"+n.id+"'>"+n.name+"</option>");//子栏目
                    });
                }
            }
        })
    }

}

