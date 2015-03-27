$("#hear_us_others").hide();


function IsEmail(email) {
	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return regex.test(email);
}

$(document).ready(function() {
	

	$("#email").change(function(){
		
		if(!IsEmail($("#email").val())){
			
			
			$("#email-group #email-status").html('<div style="display: table-cell; vertical-align: middle;"><span class="glyphicon glyphicon-remove"></span> Invalid email</div>');
			$("#email").addClass('error');

		}
		
		else{
			$("#email-group #email-status").html('<span style="display: table-cell; vertical-align: middle;" class="glyphicon glyphicon-ok"></span>');
			$("#email").removeClass('error');
		}
		
	});
	
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
				text : 'Waiting .. ',
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
				$("#cities").append('<select id = "cities-select" class="form-control select" data-live-search="true" name="Student[city]">');
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

$("select#package,#gender").change(function() {
	createPreferences();
});

$("#hear_us").change(function() {
	if ($("#hear_us").val() == "Others") {
		$("#hear_us_others").show();
	} else {
		$("#hear_us_others").hide();
	}
});

function handleChange() {
	//alert("Handle Change");
	for (var counter = 0; counter < $(".timepicker_to").length; counter++) {
		
		handleAjax(counter, $(".timepicker_from").eq(counter).val(), $(".timepicker_to").eq(counter).val() , $(".period").eq(counter).val() , $("#gender").val() , $(".days").eq(counter*2).val() , $(".lesson-type select").eq(counter).val());

	}
}

function handleAjax(index, from, to , period , gender , day , lessonType ) {
	//console.log("index.php?r=DataModule/checkSlot&from=" + from + "&to=" + to + "&period=" + period + "&gender=" + gender + "&day=" + day + "&type=" + lessonType);
	$.ajax("index.php?r=DataModule/checkSlot&from=" + from + "&to=" + to + "&period=" + period + "&gender=" + gender + "&day=" + day + "&type=" + lessonType, {
		success : function(data) {
			var obj = jQuery.parseJSON(data);

			$(".logo" + index).html("");
			if (obj.status == "Success")
				$('.slot-time').eq(index).append('<span style="display: table-cell; vertical-align: middle;" class="glyphicon glyphicon-ok"></span>');
			else
				$('.slot-time').eq(index).append('<div style="display: table-cell; vertical-align: middle;" class = "logo' + index + '"><span class="glyphicon glyphicon-remove"></span>' + obj.status + '</div>');

		},
		error : function() {
			alert("ERROR in handle Ajax");
		}
	});
}

function createPreferences(){
	var numberOfRows = $("select#package").val();


	$('#preference').html("");

	for (var i = 0; i < numberOfRows; ++i) {
		$("#preference").append('<div class="form-group slot-time">' + 
			'<label class="col-md-3 col-xs-12 control-label"></label>' + 
			'<div class="col-md-2 col-xs-12 lesson-type">' + 
			'<select class="form-control select  " name="Student[prefered_lesson_type_' + (i + 1) + ']">' + 
			'<option value="1">Quran Hifdh</option>' + '<option value="2">Quran Reading</option>' + '<option value = 3>Arabic</option>'+ 
			'</select>' + 
			'</div>' + 
			'<div class="col-md-1 col-xs-12 days-container" >' + 
			'</div>' + 
			'<div class="col-md-1 col-xs-12">' + '<input type="number" min="30" max="120" value="30" class="form-control period" name="Student[prefered_lesson_period_' + (i + 1) + ']">' + '</div>' + '<div class="col-md-1 col-xs-12">' + 
			'<div class="input-group bootstrap-timepicker">' + '<input type="text" name="Student[prefered_from_' + (i + 1) + ']" class="form-control timeslot timepicker_from" style="border-radius: 5px;"/>' + '</div>' + '</div>' + '<div class="col-md-1 col-xs-12">' + 
			'<div class="input-group bootstrap-timepicker">' + '<input type="text" name="Student[prefered_to_' + (i + 1) + ']" class="form-control timeslot timepicker_to" style="border-radius: 5px;"/>' + '</div>' + '</div>' + '</div>');

}

$('.timepicker_to').timepicker({
	'minuteStep' : 5
});

$('.timepicker_from').timepicker({
	'minuteStep' : 5
});
$('.select').selectpicker();
$(".days,.timepicker_to,.timepicker_from,.period").change(function() {
	handleChange();
});
$(".lesson-type").change(function(){
	var index = $(this).parent().prevAll().length;
	var days = ["Saturday", "Sunday", "Monday" , "Tuesday" , "Wednesday" , "Thursday" , "Friday"];
	$(".days-container").eq(index).html("");
	var gender = $("#gender").val();
	var lessonType = $(".lesson-type select").eq(index).val();
	console.log("index.php?r=DataModule/getSlots&gender="+gender+"&type="+lessonType);
	$.ajax("index.php?r=DataModule/getSlots&gender="+gender+"&type="+lessonType, {
		success : function(data) {
			var obj = jQuery.parseJSON(data);
			if(obj.days.length>0){

				$(".days-container").eq(index).append('<select class="form-control select days" name="Student[prefered_days_' + (index + 1) + ']">');
				for(var i=0;i<obj.days.length;i++){
					$(".days").eq(index*2).append('<option value = '+obj.days[i]+'>' + days[obj.days[i]] + '</option>');
				}
				$(".days-container").eq(index).append('</select>');
				$(".days").eq(index*2).selectpicker();
				$(".days").change(function() {
					handleChange();
				});
				//$(".days").trigger("change");
				
				
			}
			
			else{
				$(".days-container").eq(index).append('<select class="form-control select days" name="Student[prefered_days_' + (index + 1) + ']">');
				$(".days-container .days").eq(index).append('<option>Unavailable</option>');
				
				$(".days-container").eq(index).append('</select>');
				//$('.slot-time logo').html();
				//$('.slot-time logo').eq(index).append('<div style="display: table-cell; vertical-align: middle;" class = "logo' + index + '"><span class="glyphicon glyphicon-remove"></span>' + obj.status + '</div>');
				
			}			
		},
		error : function() {
			alert("ERROR");
		},
		
		async : false
		
		
	});
		//alert($(".days").length);

		
		
		$('.select').selectpicker();
		handleChange();
		//alert($(this).parent().prevAll().length);
	});
$(".lesson-type").trigger("change");
$(".period").trigger("change");



}



