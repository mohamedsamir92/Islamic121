<script>
		$(document).ready(function() {
			//alert("Here");
			//console.log("sdklskds");
			<?php for($i=0;$i<count($results);$i++): ?>
				$("#edit-form<?php echo $i; ?>").submit(function( event ){
					//alert("dksldksd");
					//event.preventDefault();
					noty({
					text: "Request updated successfully",
					layout: 'topRight',
					type: 'error',
				
					});
				});
				$( "#myform<?php echo $i ?>" ).submit(function( event ) {
					
					var state = 1;
					var message = "Success";
					var cost = $("#cost<?php echo $i ?>").val();
					if(cost == ""){
						
						noty({
							text: "Cost cannot be blank",
							layout: 'topRight',
							type: 'error',
							timeout : 5000,
						});
					
						event.preventDefault();
						return;
					
					
					}
					if ($(".request-check<?php echo $i ?> .glyphicon-remove").length > 0) {
						noty({
							text : 'Some fields contain incorrect data in this request, check your data again',
							layout : 'topRight',
							type : 'error',
							timeout : 5000,
						});
						event.preventDefault();
						return;
					}
					
					if(typeof $("#from<?php echo $i ?>").val() !== "undefined"){
					//alert("dksldksld");
					
					var slotsSize = $(".slot<?php echo $i ?>").length;
					var formNumber = <?php echo $i ?>;
					for(var counter = 0;counter<slotsSize;counter++){
						
							console.log("index.php?r=Requests/checkTeacher&id=" + 
							$("#teacher"+formNumber).val() +"&from=" + $("#from"+(formNumber+counter)).val()+
							"&to="+$("#to"+(formNumber+counter)).val()+"&day="+$("#day"+(formNumber+counter)).val()+
							"&student_gender="+$("#gender"+formNumber).text()+"&lesson_type="+$("#lesson-type"+(formNumber+counter)).val()+"&period="+$("#period"+(formNumber+counter)).val());
								
							
							$.ajax("index.php?r=Requests/checkTeacher&id=" + 
							$("#teacher"+formNumber).val() +"&from=" + $("#from"+(formNumber+counter)).val()+
							"&to="+$("#to"+(formNumber+counter)).val()+"&day="+$("#day"+(formNumber+counter)).val()+
							"&student_gender="+$("#gender"+formNumber).text()+"&lesson_type="+$("#lesson-type"+(formNumber+counter)).val()+"&period="+$("#period"+(formNumber+counter)).val(), {
							success : function(data) {
							var obj = jQuery.parseJSON(data);
							if(obj.status != "Success"){
								state = 0;
								message = obj.status;
							}
								
							
							
							},
							error : function() {
							alert("ERROR");
							},
							async: false
						
							});
							if(state == 0)break;
						}
						if(state == 1){
							noty({
								text: message,
								layout: 'topRight',
								type: 'error',
								timeout : 5000,
								
							
							});
							//event.preventDefault();
							return;
						}
						else {
							
							state = 1;
							noty({
								text: message,
								layout: 'topRight',
								type: 'error',
								timeout : 5000,
								
							
							});
							event.preventDefault();
							return;
						}
						
					}
					event.preventDefault();
							return;
				
					//return;
					
					});

			<?php endfor; ?>
			$(".daysReq,.time_from,.time_to,.periodReq").change(function() {
	
				var index = $(this).attr("number");
				
				//alert($("#from"+index).val());
				handleAjax(index,$("#from"+index).val(),$("#to"+index).val(),$("#period"+index).val(), $("#gender"+index).val()
				, $("#day"+index).val() , $("#lesson-type"+index).val());
	
			});
			
			$(".typeReq").change(function(){
				var index = $(this).attr("number");
				var formIndex = $(this).attr("fIndex");
				//alert(index);
				
				var days = ["Saturday", "Sunday", "Monday" , "Tuesday" , "Wednesday" , "Thursday" , "Friday"];
				$(".days-container").eq(index).html("");
				var genderType = $("#gender"+index).html();
				var gender = 0;
				if(genderType == "Female")
					gender = 1;
				var lessonType = $("#lesson-type"+index).val();
				//console.log("index.php?r=DataModule/getSlots&gender="+gender+"&type="+lessonType);
				$.ajax("index.php?r=DataModule/getSlots&gender="+gender+"&type="+lessonType, {
					success : function(data) {
						var obj = jQuery.parseJSON(data);
						if(obj.days.length>0){
							$(".days-container").eq(index).append('<select id="day'+index+'" class = "form-control select daysReq " name="LessonRequest[day][]" number = "'+index+'" form = "myform'+formIndex+'">');
							
							
							//$("#day"+index).append("<option>kdsldksld</option>");
							for(var i=0;i<obj.days.length;i++){
								$("#day"+index).append('<option value = '+obj.days[i]+'>' + days[obj.days[i]] + '</option>');
							}
							$(".days-container").eq(index).append('</select>');
							$("#day"+index).selectpicker();
							$("#day"+index).change(function() {
								handleAjax(index,$("#from"+index).val(),$("#to"+index).val(),$("#period"+index).val(), $("#gender"+index).val()
				, $("#day"+index).val() , $("#lesson-type"+index).val());
							});
							//$(".days").trigger("change");
							
							
						}
						
						else{
							
							$(".days-container").eq(index).append('<select id="day'+index+'" class = "form-control select daysReq" name="LessonRequest[day][]" number = "'+index+'" form = "myform'+index+'">');
							
							
							$("#day"+index).append('<option> No available Slots </option>');
							
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

		
		
		$("#day"+index).selectpicker();
		handleAjax(index,$("#from"+index).val(),$("#to"+index).val(),$("#period"+index).val(), $("#gender"+index).val()
				, $("#day"+index).val() , $("#lesson-type"+index).val());
		//alert($(this).parent().prevAll().length);
	});
			
			$('.time_from').timepicker({
				'minuteStep' : 5
			});
			$('.time_to').timepicker({
				'minuteStep' : 5
			});
			<?php if(isset($my_message)):
			?>
			noty({
			text: '<?php echo $my_message ?>
				',
				layout: 'topRight',
				type: 'error',
				timeout : 5000,

		});
		<?php endif; ?>
		$(".typeReq").trigger("change");
		});

		function handleAjax(index, from, to , period , gender , day , lessonType ) {
			$.ajax("index.php?r=DataModule/checkSlot&from=" + from + "&to=" + to + "&period=" + period + "&gender=" + gender + "&day=" + day + "&type=" + lessonType, {
				success : function(data) {
					var obj = jQuery.parseJSON(data);

					$(".logo" + index).html("");
					if ($('#check' + index + ' span').hasClass("glyphicon-remove") && obj.status == "Success")
						$('#check' + index).html('<span class="glyphicon glyphicon-ok"></span> Success');
					
else if ($('#check' + index + ' span').hasClass("glyphicon-ok") && obj.status != "Success")
						$('#check' + index).html('<span class="glyphicon glyphicon-remove"></span> Error');
					else if (!$('#check' + index + ' span').hasClass("glyphicon")) {

						if (obj.status == "Success")
							$('#check' + index).html('<span class="glyphicon glyphicon-ok"></span> Success');
						
else
							$('#check' + index).html('<span class="glyphicon glyphicon-remove"></span> Error');

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
					</ul>
				</div>
				<div class="panel-body">

					<?php for($i=0;$i<count($results);$i++): ?>
						<form action="index.php?r=Requests/PendingRequests" method="post" id="myform<?php echo $i; ?>"></form>
					
					<?php endfor; ?>
					<table class="table">
						<thead>
							<tr>
								<th width="10%" style="text-align: center;">ID</th>
								<th width="10%" style="text-align: center;">First Name</th>
								<th width="10%" style="text-align: center;">Last Name</th>
								<th width="10%" style="text-align: center;">Skype ID</th>
								<th width="5%" style="text-align: center;">Age</th>
								<th width="5%" style="text-align: center;">Gender</th>
								<th width="5%" style="text-align: center;">Currency</th>
								<th width="5%" style="text-align: center;">Price/Hour</th>
								<th width="15%" style="text-align: center;">Teacher</th>
								<th width="25%" style="text-align: center;">Action</th>
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
							$j = $j + 1;
							?>

							<tr>
								<td> <?php echo $request -> id; ?> </td>
								<td><?php echo $request -> student -> first_name; ?></td> 
								<td><?php echo $request -> student -> last_name; ?></td> 
								<td><?php echo $request -> student -> skype_id; ?></td> 
								<?php

								$date = new DateTime($request -> student -> date_of_birth);
								$now = new DateTime();
								$interval = $now -> diff($date);
								$age = $interval -> y;
								//echo "Age is:" . $age;
								?>
								<td><?php echo $age; ?>	</td> 
								<td><?php if($request->student->gender == 0 ): ?>
									<p id="gender<?php echo $j ?>">Male<p></p><?php else: ?><p id="gender<?php echo $j ?>">Female</p> <?php endif; ?>
								</td> 
								<td>
								<input type="hidden" name = "LessonRequest[student_id]" value="<?php echo $request -> student -> id; ?>" form="myform<?php echo $j; ?>">
								<input type="hidden" name = "LessonRequest[request_id]" value="<?php echo $request -> id; ?>" form="myform<?php echo $j; ?>">
								<select name="LessonRequest[currency]" class="form-control select" form="myform<?php echo $j; ?>">
									<?php foreach ($currencies as $currency) {
									?>
									<?php $selected = ""; 
									if($request->currency_id == $currency->id )
						 				$selected = "selected";
						 
									?>
									
									<option value="<?php echo $currency->id ?>" <?php echo $selected ?> >
										<?php echo $currency -> sign; ?>
									</option> <?php } ?>
								</select></td>

								<td>
								<input id="cost<?php echo $j; ?>" type="number" step="any" class="form-control" value="<?php echo $request->cost; ?>" name="LessonRequest[cost]" form="myform<?php echo $j; ?>">
								</td>

								<td>
								<select class="form-control select teachers" id="teacher<?php echo $j ?>" number = <?php echo $j; ?> name="LessonRequest[teacher_id]" form="myform<?php echo $j; ?>">
									<?php foreach ($teachers as $teacher) {
									?>
									<option value="<?php echo $teacher->id ?>">
										<?php echo $teacher -> first_name . " " . $teacher -> last_name; ?>
									</option> 
									<?php } ?>
								</select><!-- <span class="label label-info label-form">Info</span> --></td>

								<td>
								<div class="btn-group">
									<button href="#myModal<?php echo $j ?>" class="btn btn-default btn-condensed" data-toggle="modal" >
										<i class="fa fa-calendar"></i>
									</button>

									<a href="index.php?r=members/editStudent&id=<?php echo $request->student->id ?>&edit=1" data-toggle="modal" class="btn btn-default btn-condensed">
										<i class="fa fa-pencil"></i>
									</a>
									<a href="index.php?r=requests/declineRequest&id=<?php echo $request->id ?>" class="btn btn-danger btn-condensed">
										<i class="fa fa-times"></i>
									</a>
									<button type="submit" form="myform<?php echo $j; ?>" class="btn btn-success btn-condensed">
										<i class="fa fa-check"></i>
									</button>
								</div>
								<div class="modal fade" id="editModal<?php echo $j; ?>" >

									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
													×
												</button>
												<h3 class="modal-title">Preferred Times</h3>
											</div>
											<div class="modal-body">
												<?php $this -> renderPartial('/requests/EditSpecificRequest', array("request_id"=>$request->id,"selected_currency"=>$request->currency_id,"cost"=>$request->cost,"notes"=>$request->notes,"student_id"=> $request->student->id ,"first_name" => $request -> student -> first_name, "last_name" => $request -> student -> last_name, "skype_id" => $request -> student -> skype_id, "age" => $age, "gender" => $request -> student -> gender, "currencies" => $currencies,  "j" => $j)); ?>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">
													Close
												</button>
											</div>
										</div>
									</div>

								</div>

								<div class="modal fade" id="myModal<?php echo $j; ?>" style="z-index: 100">
									<div class="modal-dialog" style="width: 55%;">
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
																<th>Lesson Type</th>
																<th>Day</th>
																<th style="min-width: 70px;">Period</th>
																<th style="min-width: 150px;">From</th>
																<th style="min-width: 150px;">To</th>
															</tr>
														</thead>
														<tbody>
															<?php $counter = -1; 
															foreach ($request->lessonRequestTimeSlots as $lessonTimeSlot) {
																$counter++;
															?>

															<tr class="slot<?php echo $j ?>">
																<td>
																<select id="lesson-type<?php echo ($counter+$j); ?>" class="form-control typeReq select" name="LessonRequest[lesson-type][]" number="<?php echo ($counter+$j); ?>" fIndex ="<?php echo $j; ?>" form="myform<?php echo $j; ?>">
																	<?php
																		$types = array("Quran Hifdh" , "Quran Reading" , "Arabic");
																		for($i=0;$i<3;$i++): ?>
																			<?php if($lessonTimeSlot->lesson_type == ($i+1)):
																			?>
																			<option value="<?php echo ($i+1) ?>" selected><?php echo $types[$i]; ?></option> 
																			<?php else: ?>
																			<option value="<?php echo ($i+1) ?>" ><?php echo $types[$i]; ?></option> 
																			<?php endif; ?>
																		<?php endfor; ?>
																</select>
																</td>
																<td>
																<div class="days-container">
																	<select id="day<?php echo ($counter+$j); ?>" class="form-control daysReq select" name="LessonRequest[day][]" number="<?php echo ($counter+$j); ?>" form="myform<?php echo $j; ?>">
																		<?php
																		$days = array("Saturday" , "Sunday" , "Monday" , "Tuesday" , "Wednesday" , "Thursday" , "Friday");
																		for($i=0;$i<7;$i++):
																		?>
																			<?php if($lessonTimeSlot->day == $i):
																			?>
																			<option value="<?php echo $i ?>" selected><?php echo $days[$i]; ?></option> 
																			<?php else: ?><option value="<?php echo $i ?>" ><?php echo $days[$i]; ?></option> 
																				<?php endif; ?>
																		<?php endfor; ?>
																	</select>
																</div>
																</td>
																<td>
																	<input id="period<?php echo ($counter+$j) ?>" type="text"  class="form-control periodReq" name="LessonRequest[period][]" number="<?php echo ($counter+$j); ?>" value = "<?php echo $lessonTimeSlot->period; ?>"  form="myform<?php echo $j; ?>">
								
																</td>
								
																<td>
																<div class="input-group bootstrap-timepicker">
																	<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
																	<?php $lessonTimeSlot -> from = date("g:i a", strtotime($lessonTimeSlot -> from));
																		$lessonTimeSlot -> to = date("g:i a", strtotime($lessonTimeSlot -> to));
																	?>
																	<input id="from<?php echo ($counter+$j); ?>" type="text" class="form-control timepicker time_from" form="myform<?php echo $j; ?>" number="<?php echo ($counter+$j); ?>" name="LessonRequest[from][]" value="<?php echo $lessonTimeSlot->from ?>" />
																</div></td>
																<td>
																<div class="input-group bootstrap-timepicker">
																	<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
																	<input id="to<?php echo ($counter+$j); ?>" type="text" class="form-control timepicker time_to"  form="myform<?php echo $j; ?>" number="<?php echo ($counter+$j); ?>" name="LessonRequest[to][]" value="<?php echo $lessonTimeSlot->to ?>" />
																</div></td>
																<td class="request-check<?php echo $j; ?>" id="check<?php echo ($counter+$j); ?>"></td>
															</tr>

															<?php

															}
															?>
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
							</tr>
							<?php

							//break;
							}
							?>
						</tbody>

					</table>
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
