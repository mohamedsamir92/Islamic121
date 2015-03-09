
$(document).ready(function() {
	$( "form" ).submit(function( event ) {
		   
		  if($(".glyphicon-remove").length > 0){
		  	noty({
                        text: 'Check your slots again',
                        layout: 'topRight',
                        type: 'error',
                        
                   });
		  }
		  else{
		  	noty({
                        text: 'Registered Successfully',
                        layout: 'topRight',
                        type: 'error',
                        
                   });
		  	return;
		  }
		  event.preventDefault();
	});
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


