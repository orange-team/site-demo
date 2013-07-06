$(document).ready(function(){
	$("#re_one").change(function(){
		var pids = $(this).val();
		$("#re_two").empty().append("<option value=''>城市</option>");
		$.get("/admin/dealer/city_ajax/"+pids+"/2",function(data){
			//$(data).each(function(index,elem){
				//alert(data);
				$("#re_two").append(data);
			//});
		});	
	});
	$("#re_two").change(function(){
		var pids = $(this).val();
		$("#re_three").empty().append("<option value=''>区县</option>");
		$.get("/admin/dealer/city_ajax/"+pids+"/3",function(data){
			//$(data).each(function(index,elem){
				$("#re_three").append(data)
			//});
		});	
	});	
});
