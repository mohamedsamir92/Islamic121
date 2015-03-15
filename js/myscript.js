$(document).ready(function() {
	$("#sender-type").change(function(){
		
		var val = $("#sender-type").val();
		alert(val);
		if(val == 0){
			$("custom-sender").css("visibility","visible");
		}
		else
			$("custom-sender").css("visibility","hidden");
		
	});
	$( "form" ).submit(function( event ) {
		   
		  if($(".glyphicon-remove").length > 0){
		  	noty({
                        text: 'Some fields contain incorrect data, check your data again',
                        layout: 'topRight',
                        type: 'error',
                        timeout: 5000,
                   });
		  }
		  else{
		  	noty({
                        text: 'Registered Successfully',
                        layout: 'topRight',
                        type: 'error',
                        timeout: 5000,
                        
                   });
		  	return;
		  }
		  event.preventDefault();
	});
	
	$("#date-day").change(function(){
		if(!$.isNumeric( $("#date-day").val() ) || $("#date-day").val() > 31 || $("#date-day").val() < 1){
			$("#date-day-group .help-block").html("");
			$("#date-day-group .help-block").html('<span class="glyphicon glyphicon-remove"></span> day should be number less than 31');
			$("#date-day").addClass("error");
		}
		else{
			$("#date-day-group .help-block").html("");
			$("#date-day-group .help-block").html('<span class="glyphicon glyphicon-ok"></span>');
			$("#date-day").removeClass("error");
		}
	});
	
	$("#date-month").change(function(){
		if(!$.isNumeric( $("#date-month").val() ) || $("#date-month").val() > 12 || $("#date-month").val() < 1){
			$("#date-month-group .help-block").html("");
			$("#date-month-group .help-block").html('<span class="glyphicon glyphicon-remove"></span> month should be number less than 12');
			$("#date-month").addClass("error");
		}
		else{
			$("#date-month-group .help-block").html("");
			$("#date-month-group .help-block").html('<span class="glyphicon glyphicon-ok"></span>');
			$("#date-month").removeClass("error");
		}
	});
	
	$("#date-year").change(function(){
		if(!$.isNumeric( $("#date-year").val() ) || $("#date-year").val() < 1900){
			$("#date-year-group .help-block").html("");
			$("#date-year-group .help-block").html('<span class="glyphicon glyphicon-remove"></span> Year should be number greater than 1900');
			$("#date-year").addClass("error");
		}
		else{
			$("#date-year-group .help-block").html("");
			$("#date-year-group .help-block").html('<span class="glyphicon glyphicon-ok"></span>');
			$("#date-year").removeClass("error");
		}
	});
	
	
	//$("#user-date").inputmask("d/m/y",{ "placeholder": "*" });
	
	$("#username").change(function(){
		
		var uname = $("#username").val();
		$.ajax("index.php?r=DataModule/checkStudentUsername&uname=" + uname, {
			success : function(data){
				$("#username-group #username-status").html();
				var obj = jQuery.parseJSON(data);
				if(obj.status == "ok"){
					$("#username-group #username-status").html('<span class="glyphicon glyphicon-ok"></span>');
					$("#username").removeClass('error');
				}
				else{
					$("#username-group #username-status").html('<span class="glyphicon glyphicon-remove"></span> This username has already been taken');
					$("#username").addClass('error');
				}
				
				
			},
		});
		
	});
	
	$("#email").change(function(){
		
		var email = $("#email").val();
		$.ajax("index.php?r=DataModule/checkStudentEmail&email=" + email, {
			success : function(data){
				$("#email-group #email-status").html();
				var obj = jQuery.parseJSON(data);
				if(obj.status == "ok"){
					$("#email-group #email-status").html('<span class="glyphicon glyphicon-ok"></span>');
					$("#email").removeClass('error');
				}
				else{
					$("#email-group #email-status").html('<span class="glyphicon glyphicon-remove"></span> This email has already been taken');
					$("#email").addClass('error');
				}
				
				
			},
		});
		
	});
	
	
	$("#password,#confirmed-password").change(function(){
		
		var pass = $("#password").val();
		var confirmed_pass = $("#confirmed-password").val();
		$("#password-group #password-status").html();
		if(pass == confirmed_pass && pass.length > 1){
			$("#password-group #password-status").html('<span class="glyphicon glyphicon-ok"></span>');
			$("#password").removeClass('error');
			$("#confirmed-password").removeClass('error');
		}
		else{
			$("#password-group #password-status").html('<span class="glyphicon glyphicon-remove"></span>');
			$("#password").addClass('error');
			$("#confirmed-password").addClass('error');
		}
		
	});
	//$("#password").change();
	$('#time_from').timepicker({ 'minuteStep' : 30 });
	$('#time_to').timepicker({ 'minuteStep' : 30 });
	
	
	//$('.days,.timepicker_to,.timepicker_from').on('change',handleChange());
	
	$("select#package").change();
	
					
//					$( ".days" ).trigger( "change" );


//$(".days").change();
//					$( ".days" ).trigger( "change" );
	
});


$("select#package").change(function() {
	var numberOfRows = $("select#package").val();
	
	$('#preference').html("");
		
	
	for (var i = 0; i < numberOfRows; ++i){
		$("#preference").append(
		'<div class="form-group slot-time">'+
			'<label class="col-md-3 col-xs-12 control-label">Working Times</label>'+
				'<div class="col-md-2 col-xs-12">'+
					'<select class="form-control select days" name="Student[prefered_days_'+(i + 1)+']">'+
						'<option value="0">Saturday</option>'+
						'<option value="1">Sunday</option>'+
						'<option value="2">Monday</option>'+
						'<option value="3">Tuesday</option>'+
						'<option value="4">Wednesday</option>'+
						'<option value="5">Tursday</option>'+
						'<option value="6">Friday</option>'+
					'</select>'+
				'</div>'+
				'<div class="col-md-2 col-xs-12">'+
					'<div class="input-group bootstrap-timepicker">'+
						'<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>'+
						'<input type="text" name="Student[prefered_from_'+(i + 1)+']" class="form-control timeslot timepicker_from"/>'+
					'</div>'+
				'</div>'+
				'<div class="col-md-2 col-xs-12">'+
					'<div class="input-group bootstrap-timepicker">'+
						'<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>'+
						'<input type="text" name="Student[prefered_to_'+(i + 1)+']" class="form-control timeslot timepicker_to"/>'+
					'</div>'+
				'</div>'+
			'</div>'
		
		);
		
					}
										
					
					$('.timepicker_to').timepicker({ 'minuteStep' : 30 });
					
					$('.timepicker_from').timepicker({ 'minuteStep' : 30 });
					
					
					
					$('.select').selectpicker();
					//$( ".days" ).trigger( "change" );
					//$(".days").change();
					//$('.days,.timepicker_to,.timepicker_from').on('change',handleChange());
					//$('.days').change(handleChange());
					$(".days,.timepicker_to,.timepicker_from").change(function(){
						handleChange();
					});
					$(".days").trigger("change");
					
					
					
});

function handleChange(){
						for(var counter = 0;counter<$(".timepicker_to").length;counter++){
							handleAjax(counter,$(".timepicker_from").eq(counter).val(),$(".timepicker_to").eq(counter).val());			
					

					}
				}
				
function handleAjax(index,from,to){
	$.ajax("index.php?r=DataModule/checkSlot&from=" + from+"&to="+to, {
							success : function(data) {
									var obj = jQuery.parseJSON(data);
								
									$(".logo"+index).html("");
									//alert($('.slot-time').index("#preference"));
									//alert($('.timepicker_to').index(this));
									if(obj.status == "Success")
										$('.slot-time').eq(index).append('<div class = "logo'+index+'"><span class="glyphicon glyphicon-ok"></span> Success</div>');
									else
										$('.slot-time').eq(index).append('<div class = "logo'+index+'"><span class="glyphicon glyphicon-remove"></span>'+obj.status+'</div>');
								
							},
							error : function() {
								alert("ERROR");
							}
							
							
							
						});
}


