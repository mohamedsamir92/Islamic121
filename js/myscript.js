$(document).ready(function(){

		var x = $(".submitRowButton");
		//alert(x.length);
		$(".submitRowButton").on("click",function(){
			
			//alert($(this).attr("row-class"));	
		});
		
		
		$("select#package").change();
		var days = $("select.prefered_days");
		//alert(days.length);
		$("select.prefered_days").change(function(){
		//alert("KAKA");
		var selectedTeacher = $("select#teachers option:selected").val();
		var selectedDay = $("select.prefered_days option:selected").val();
		$.ajax("index.php?r=DataModule/getTeacherTimeSlots&id="+selectedTeacher+"&day="+selectedDay, {
			success : function(data) {
			//alert(data);
			//$('select.prefered_days').html("");
			$('select.prefered_from').html("");
			$('select.prefered_to').html("");
	
			var obj = jQuery.parseJSON(data);
			var days = ["Saturday" , "Sunday" , "Monday" , "Tuesday" , "Wednesday" , "Thursday" , "Friday"];
			for (var i = 0; i < obj.length; ++i) {
			//$('select.prefered_days').append('<option value='+obj[i].day+' >'+days[obj[i].day - 1]+'</option>');
			$('select.prefered_from').append('<option value='+obj[i].from+'>'+obj[i].from+'</option>');
			$('select.prefered_to').append('<option value='+obj[i].to+'>'+obj[i].to+'</option>');
	
			}
			},
			error : function() {
	
			}
			});

		
	});

	});
	
	$("select#package").change(function(){
		var numberOfRows = $("select#package").val();
		$('#preference').html("");
		$("#preference").append("<div class='row'>"+
		"<div class='col-md-4'>Day</div><div class='col-md-4'>From</div><div class='col-md-4'>To</div></div>");
		for(var i=0;i<numberOfRows;++i)
		$("#preference").append("<div class = 'row'>"+
		"<div class = 'col-md-4'><select class='prefered_days' name='Student[prefered_days_"+(i+1)+"]'></select></div>"+
		"<div class = 'col-md-4'><select class='prefered_from' name='Student[prefered_from_"+(i+1)+"]'></select></div>"+
		"<div class = 'col-md-4'><select class='prefered_to' class='form-control select' name='Student[prefered_to_"+(i+1)+"]'></select></div></div>");
		$("select#teachers").change();
	});
	
	$("select#teachers").change(function() {

		var selected = $("select#teachers option:selected").val();
		$.ajax("index.php?r=DataModule/getTeacherTimeSlots&id="+selected, {
			success : function(data) {
			//alert(data);
			$('select.prefered_days').html("");
			$('select.prefered_from').html("");
			$('select.prefered_to').html("");
	
			var obj = jQuery.parseJSON(data);
			var days = ["Saturday" , "Sunday" , "Monday" , "Tuesday" , "Wednesday" , "Thursday" , "Friday"];
			for (var i = 0; i < obj.length; ++i) {
			$('select.prefered_days').append('<option value='+obj[i].day+' >'+days[obj[i].day - 1]+'</option>');
			$('select.prefered_from').append('<option value='+obj[i].from+'>'+obj[i].from+'</option>');
			$('select.prefered_to').append('<option value='+obj[i].to+'>'+obj[i].to+'</option>');
	
			}
			},
			error : function() {
	
			}
			});
			
			$("select.prefered_days").change();
		});
	$("select.prefered_days").on("click",function(){
		
		//alert("KAKA");
	});
	