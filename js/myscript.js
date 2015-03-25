$(document).ready(function() {
	$("#sender-type").change(function() {
		var val = $("#sender-type").val();
		if (val == 0) {
			$("custom-sender").css("visibility", "visible");
		} else
			$("custom-sender").css("visibility", "hidden");
	});	
	$("form").submit(function(event) {
		if ($(".glyphicon-remove").length > 0) {
			noty({
				text : 'Some fields contain incorrect data, check your data again',
				layout : 'topRight',
				type : 'error',
				timeout : 5000,
			});
		} else {
			noty({
				text : 'Registered Successfully',
				layout : 'topRight',
				type : 'error',
				timeout : 5000,

			});
			return;
		}
		event.preventDefault();
	});
	$("#username").change(function() {
		var uname = $("#username").val();
		$.ajax("index.php?r=DataModule/checkStudentUsername&uname=" + uname, {
			success : function(data) {
				$("#username-group #username-status").html();
				var obj = jQuery.parseJSON(data);
				if (obj.status == "ok") {
					$("#username-group #username-status").html('<span style="display: table-cell; vertical-align: middle;" class="glyphicon glyphicon-ok"></span>');
					$("#username").removeClass('error');
				} else {
					$("#username-group #username-status").html('<div style="display: table-cell; vertical-align: middle;"><span class="glyphicon glyphicon-remove"></span> This username has already been taken</div>');
					$("#username").addClass('error');
				}

			},
		});

	});

	$("#password,#confirmed-password").change(function() {

		var pass = $("#password").val();
		var confirmed_pass = $("#confirmed-password").val();
		$("#password-group #password-status").html();
		if (pass == confirmed_pass && pass.length > 1) {
			$("#password-group #password-status").html('<span class="glyphicon glyphicon-ok"></span>');
			$("#password").removeClass('error');
			$("#confirmed-password").removeClass('error');
		} else {
			$("#password-group #password-status").html('<span class="glyphicon glyphicon-remove"></span>');
			$("#password").addClass('error');
			$("#confirmed-password").addClass('error');
		}

	});
	
	$("select#package").change();
	
});

$("#country").change(function() {
	
	$.ajax("index.php?r=DataModule/getRegions&id=" + $("#country").val(), {
		success : function(data) {
			var obj = jQuery.parseJSON(data);
			$("#cities").html("");
			if(obj.length>0){
			
				$("#cities").append('<span class="input-group-addon"><span class="fa fa-flag-o"></span></span>');
				$("#cities").append('<select id = "cities-select" class="form-control select" name="Student[city]">');
				for(var i=0;i<obj.length;i++){
					$("#cities-select").append('<option value = '+obj[i].id+'>' + obj[i].name + '</option>');
				}
				$("#cities").append('</select>');
				$('#cities-select').selectpicker();
				
			}			
		},
		error : function() {
			alert("ERROR");
		}
	});

});
$("#country").change();

$("select#package").change(function() {
	createPreferences();
	
});

function handleChange() {
	for (var counter = 0; counter < $(".timepicker_to").length; counter++) {
		handleAjax(counter, $(".timepicker_from").eq(counter).val(), $(".timepicker_to").eq(counter).val() , $(".period").eq(counter).val() , $("#gender").val());

	}
}

function handleAjax(index, from, to , period) {
	$.ajax("index.php?r=DataModule/checkSlot&from=" + from + "&to=" + to + "&period=" + period, {
		success : function(data) {
			var obj = jQuery.parseJSON(data);

			$(".logo" + index).html("");
			if (obj.status == "Success")
				$('.slot-time').eq(index).append('<div class = "logo' + index + '"><span class="glyphicon glyphicon-ok"></span> Success</div>');
			else
				$('.slot-time').eq(index).append('<div class = "logo' + index + '"><span class="glyphicon glyphicon-remove"></span>' + obj.status + '</div>');

		},
		error : function() {
			alert("ERROR");
		}
	});
}

function createPreferences(){
	var numberOfRows = $("select#package").val();
		
	
	$.ajax("index.php?r=DataModule/getSlots&gender=0&type=1", {
		success : function(data) {
			var obj = jQuery.parseJSON(data);
			$("#cities").html("");
			if(obj.length>0){
			
				$("#cities").append('<span class="input-group-addon"><span class="fa fa-flag-o"></span></span>');
				$("#cities").append('<select id = "cities-select" class="form-control select" name="Student[city]">');
				for(var i=0;i<obj.length;i++){
					$("#cities-select").append('<option value = '+obj[i].id+'>' + obj[i].name + '</option>');
				}
				$("#cities").append('</select>');
				$('#cities-select').selectpicker();
				
			}			
		},
		error : function() {
			alert("ERROR");
		}
	});

	$('#preference').html("");

	for (var i = 0; i < numberOfRows; ++i) {
		$("#preference").append('<div class="form-group slot-time">' + 
		'<label class="col-md-3 col-xs-12 control-label"></label>' + 
		'<div class="col-md-2 col-xs-12 lesson-type">' + 
		'<select class="form-control select  " name="Student[prefered_lesson_type_' + (i + 1) + ']">' + 
		'<option value="0">Quran</option>' + '<option value="1">Arabic</option>' + 
		'</select>' + 
		'</div>' + 
		'<div class="col-md-1 col-xs-12 days-container" >' + 
		'<select id="days-id" class="form-control select days" name="Student[prefered_days_' + (i + 1) + ']">' + 
		'<option value="0">Saturday</option>' + '<option value="1">Sunday</option>' + 
		'<option value="2">Monday</option>' + 
		'<option value="3">Tuesday</option>' + 
		'<option value="4">Wednesday</option>' + 
		'<option value="5">Thursday</option>' + 
		'<option value="6">Friday</option>' + 
		
		'</select>' + 
		'</div>' + 
		'<div class="col-md-1 col-xs-12">' + '<input type="number" min="30" max="120" value="30" class="form-control period" name="Student[prefered_lesson_period_' + (i + 1) + ']">' + '</div>' + '<div class="col-md-1 col-xs-12">' + 
		'<div class="input-group bootstrap-timepicker">' + '<input type="text" name="Student[prefered_from_' + (i + 1) + ']" class="form-control timeslot timepicker_from"/>' + '</div>' + '</div>' + '<div class="col-md-1 col-xs-12">' + 
		'<div class="input-group bootstrap-timepicker">' + '<input type="text" name="Student[prefered_to_' + (i + 1) + ']" class="form-control timeslot timepicker_to"/>' + '</div>' + '</div>' + '</div>');

	}

	$('.timepicker_to').timepicker({
		'minuteStep' : 5
	});

	$('.timepicker_from').timepicker({
		'minuteStep' : 5
	});
	 $('.timepicker_from').timepicker('setTime', '03:45 AM');
	$('.select').selectpicker();
	$(".days,.timepicker_to,.timepicker_from,.period").change(function() {
		handleChange();
	});
	$(".lesson-type").change(function(){
		var index = $(this).parent().prevAll().length;
		var days = ["Saturday", "Sunday", "Monday" , "Tuesday" , "Wednesday" , "Thursday" , "Friday"];
		$(".days-container").eq(index).html("");
		
		
		$.ajax("index.php?r=DataModule/getSlots&gender=0&type=1", {
		success : function(data) {
			var obj = jQuery.parseJSON(data);
			if(obj.days.length>0){
			
				$(".days-container").eq(index).append('<select id="days-id" class="form-control select days" name="Student[prefered_days_' + (index + 1) + ']">');
				for(var i=0;i<obj.days.length;i++){
					$("#days-id").append('<option value = '+obj.days[i]+'>' + days[obj.days[i]] + '</option>');
				}
				$(".days-container").eq(index).append('</select>');
				$("#days-id").selectpicker();
				
			}			
		},
		error : function() {
			alert("ERROR");
		}
	});

		
		
		/*$(".days-container").eq(index).html('<select class="form-control select days" name="Student[prefered_lesson_type_' + (i + 1) + ']">' + 
		'<option value="0">Saturday</option>' + '<option value="1">Sunday</option>' + 
		'<option value="2">Monday</option>' + 
		'<option value="3">Tuesday</option>' + 
		
		
		'</select>'  
		);*/
		$('.select').selectpicker();
		//alert($(this).parent().prevAll().length);
	});
	$(".days").trigger("change");
	$(".lesson-type").trigger("change");
	//$(".lesson-type").trigger("change");

	
}



