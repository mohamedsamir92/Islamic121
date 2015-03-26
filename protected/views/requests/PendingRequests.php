<script>
	
	$(document).ready(function() {
	<?php for($i=0;$i<count($results);$i++): ?>
	$( "#myform<?php echo $i ?>" ).submit(function( event ) {
		var state = 0;
		if(typeof $("#from<?php echo $i ?>").val() !== "undefined"){
		$.ajax("index.php?r=Requests/checkTeacher&id=" + $("#teacher<?php echo $i ?>").val() +"&from=" + $("#from<?php echo $i ?>").val()+"&to="+$("#to<?php echo $i ?>").val()+"&day="+$("#day<?php echo $i ?>").val()+"&student_gender="+$("#gender<?php echo $i ?>").text(), {
							success : function(data) {
									var obj = jQuery.parseJSON(data);
									noty({
                        					text: obj.status,
                        					layout: 'topRight',
                        					type: 'error',
                        
                   						});
                   						if (obj.status == "Success") 
                   						{
                   							state = 1;
                   						}	
										
									
								
							},
							error : function() {
								alert("ERROR");
							},
							async: false
							
							
							
						});
					}

		//return;
		if(state == 1){
			state = 0;
			return;
		}
		else {
			state = 0;
			event.preventDefault();
		
		}
	});
	
	<?php endfor; ?>
	$(".daysReq,.time_from,.time_to").change(function(){
		
		var index = $(this).attr("number");
		//alert($("#from"+index).val());
		//handleAjax(index,$("#from"+index).val(),$("#to"+index).val())
						
	});
	$('.time_from').timepicker({ 'minuteStep' : 30 });
	$('.time_to').timepicker({ 'minuteStep' : 30 });
	<?php if(isset($my_message)): ?>
	noty({
                        text: '<?php echo $my_message ?>',
                        layout: 'topRight',
                        type: 'error',
                        
                   });
    <?php endif; ?>

});

function handleAjax(index,from,to){
	$.ajax("index.php?r=DataModule/checkSlot&from=" + from+"&to="+to, {
							success : function(data) {
									var obj = jQuery.parseJSON(data);
								
									$(".logo"+index).html("");
									//alert($('.slot-time').index("#preference"));
									//alert($('.timepicker_to').index(this));
									//if($( '#check'+index+' span' ).hasClass( "glyphicon" )){return;}
									if($( '#check'+index+' span' ).hasClass( "glyphicon-remove" )&&obj.status == "Success")
										$('#check'+index).html('<span class="glyphicon glyphicon-ok"></span> Success');
										
									else if($( '#check'+index+' span' ).hasClass( "glyphicon-ok" )&&obj.status != "Success")
										$('#check'+index).html('<span class="glyphicon glyphicon-remove"></span> Error');
									else if(!$( '#check'+index+' span' ).hasClass( "glyphicon" )){
									
										if(obj.status == "Success")
										$('#check'+index).html('<span class="glyphicon glyphicon-ok"></span> Success');
										
										else 
										$('#check'+index).html('<span class="glyphicon glyphicon-remove"></span> Error');
										
										
									}
								
							},
							error : function() {
								alert("ERROR");
							}
							
							
							
						});
}

				
				

</script>

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

	<div class="row">
		<div class="col-md-12">

			<!-- START DEFAULT DATATABLE -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">New Requests</h3>
					<ul class="panel-controls">
						<li>
							<a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a>
						</li>
						<li>
							<a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a>
						</li>
					</ul>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<?php for($i=0;$i<count($results);$i++): ?>
						<form action="index.php?r=Requests/PendingRequests" method="post" id="myform<?php echo $i; ?>"></form>
						
						<?php endfor; ?>
						<table class="table">
							<thead>
								<tr>
									<th width="20%" style="text-align: center;">First Name</th>
									<th width="10%" style="text-align: center;">Last Name</th>
									<th width="10%" style="text-align: center;">Skype id</th>
									
									<th width="5%" style="text-align: center;">Age</th>
									<th width="5%" style="text-align: center;">Gender</th>
									<th width="5%" style="text-align: center;">Currency</th>
									<th width="5%" style="text-align: center;">Price/Hour</th>
									<th width="20%" style="text-align: center;">Teacher</th>
									<th width="10%" style="text-align: center;">Times</th>
									<th width="10%" style="text-align: center;">Action</th>
								</tr>
							</thead>
							<tbody>
									<?php 
									$j = -1;
									foreach ($results as $request) {
										 if($request->status == 1)
										 	continue;
										 ?>
										 <?php
										  $j = $j+1; 
										  
										  ?>
										  
									<tr>
										<td><?php echo $request -> student -> first_name; ?></td>
										<td><?php echo $request -> student -> last_name; ?></td>
										<td><?php echo $request -> student -> skype_id; ?></td>
										<?php
											  //date in mm/dd/yyyy format; or it can be in other formats as well
											  //explode the date to get month, day and year
											  //$birthDate = explode("-", $request -> student -> date_of_birth);
											  //get age from date or birthdate
											  $date = new DateTime($request -> student -> date_of_birth);
											  $now = new DateTime();
											  $interval = $now->diff($date);
											  $age =  $interval->y;
											  //echo "Age is:" . $age;
										?>
										
										<td><?php echo $age; ?></td>
										
										<td><?php if($request->student->gender == 0 ): ?><p id="gender<?php echo $j ?>">Male<p></p><?php else: ?><p id="gender<?php echo $j ?>">Female</p> <?php endif; ?></td>
										
										<td>
										
										<input type="hidden" name = "LessonRequest[student_id]" value="<?php echo $request -> student -> id; ?>" form="myform<?php echo $j; ?>">
										<input type="hidden" name = "LessonRequest[request_id]" value="<?php echo $request -> id; ?>" form="myform<?php echo $j; ?>">
										
										<select name="LessonRequest[currency]" form="myform<?php echo $j; ?>">
											<option value="0">GBP</option>
											<option value="1">EUR</option>
											<option value="2">EGP</option>
										</select></td>
										
										<td>
										<input type="number" class="form-control" placeholder="price" name="LessonRequest[cost]" form="myform<?php echo $j; ?>">
										</td>

										<td>
										<select class="teachers" id="teacher<?php echo $j ?>" number = <?php echo $j; ?> name="LessonRequest[teacher_id]" form="myform<?php echo $j; ?>">
											<?php foreach ($teachers as $teacher) { ?>
												<option value="<?php echo $teacher->id ?>"><?php echo $teacher -> first_name . " " . $teacher -> last_name; ?></option>
											<?php } ?>
											
										</select><!-- <span class="label label-info label-form">Info</span> --></td>
										<td>
										<button href="#myModal<?php echo $j; ?>" id="openBtn" data-toggle="modal" class="btn btn-primary">
											<span class="fa fa-calendar" style="color: #fff;"></span>
										</button>
										<div class="modal fade" id="myModal<?php echo $j; ?>" style="z-index:0;">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
															×
														</button>
														<h3 class="modal-title">Preferred Times</h3>
													</div>
													<div class="modal-body">
														<div class="table-responsive">
															<table class="table" id="tblGrid">
																<thead id="tblHead">
																	<tr>
																		<th>Day</th>
																		<th style="min-width: 150px;">From</th>
																		<th style="min-width: 150px;">To</th>
																	</tr>
																</thead>
																<tbody>
																	<?php $counter = -1; foreach ($request->lessonRequestTimeSlots as $lessonTimeSlot) { 
																		$counter++;
																		?>
																		
																	
																	<tr>
																		<td>
																		<select id="day<?php echo $j; ?>" class="form-control daysReq select" name="LessonRequest[day][]" number="<?php echo $j; ?>" form="myform<?php echo $j; ?>">
																			<?php 
																			$days = array("Saturday" , "Sunday" , "Monday" , "Tuesday" , "Wednesday" , "Thursday" , "Friday");
																			for($i=0;$i<7;$i++): ?>
																				<?php if($lessonTimeSlot->day == $i): ?>
																					<option value="<?php echo $i ?>" selected><?php echo $days[$i]; ?></option>
																					<?php else: ?>
																					<option value="<?php echo $i ?>" ><?php echo $days[$i]; ?></option>
																					<?php endif; ?>
																			<?php endfor; ?>
																		</select>
																		</td>
																		<td>
																		<div class="input-group bootstrap-timepicker">
																			<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
																			<?php $lessonTimeSlot->from  = date("g:i a", strtotime($lessonTimeSlot->from));
																			$lessonTimeSlot->to = date("g:i a", strtotime($lessonTimeSlot->to)); ?>
																			<input id="from<?php echo $j; ?>" type="text" class="form-control timepicker time_from" form="myform<?php echo $j; ?>" number="<?php echo $j; ?>" name="LessonRequest[from][]" value="<?php echo $lessonTimeSlot->from ?>" />
																		</div></td>
																		<td>
																		<div class="input-group bootstrap-timepicker">
																			<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
																			<input id="to<?php echo $j; ?>" type="text" class="form-control timepicker time_to"  form="myform<?php echo $j; ?>" number="<?php echo $j; ?>" name="LessonRequest[to][]" value="<?php echo $lessonTimeSlot->to ?>" />
																		</div></td>
																		<td id="check<?php echo $j; ?>"></td>
																	</tr>
																	
																	<?php
																	 
																	 } ?>
																</tbody>
															</table>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">
															Close
														</button>
													</div>

												</div><!-- /.modal-content -->
											</div><!-- /.modal-dialog -->
										</div><!-- /.modal --></td>

										<td>
										<button type="submit" class="btn btn-success" form="myform<?php echo $j; ?>">
											Accept
										</button></td>
									</tr>
							<?php
							
							//break;
							} ?>
							
							</tbody>
							
						</table>
					</div>
				</div>
			</div>
			<!-- END DEFAULT DATATABLE -->
		</div>
	</div>

</div>
<!-- END PAGE CONTENT WRAPPER -->

<!-- START THIS PAGE PLUGINS-->
<script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="js/plugins/scrolltotop/scrolltopcontrol.js"></script>

<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>

<script type="text/javascript" src="js/plugins/morris/raphael-min.js"></script>
<script type="text/javascript" src="js/plugins/morris/morris.min.js"></script>
<script type="text/javascript" src="js/plugins/rickshaw/d3.v3.js"></script>
<script type="text/javascript" src="js/plugins/rickshaw/rickshaw.min.js"></script>
<script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
<script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>
<script type='text/javascript' src='js/plugins/bootstrap/bootstrap-datepicker.js'></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="js/plugins/owl/owl.carousel.min.js"></script>
<script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="js/plugins/moment.min.js"></script>
<script type="text/javascript" src="js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
<!-- END THIS PAGE PLUGINS-->
