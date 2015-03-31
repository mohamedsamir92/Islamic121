<?php if(isset($my_message)): ?>

	<script>
		$(document).ready(function(){

			noty({
				text: '<?php echo $my_message ?>
				',
				layout: 'topRight',
				type: 'error',
				timeout: 5000,

			});
		});
	</script>
<?php endif; ?>

<!-- PAGE CONTENT WRAPPER -->

	<div class="row">
		<div class="col-md-12">

			<form id="jvalidate" class="form-horizontal" action="index.php?r=members/editStudent" method="post" enctype="multipart/form-data">
						<?php
						 
						if(isset($_GET['id'])){
							$id = 	$_GET['id'];
						}
						if(isset($edit) && $edit == 1)$enable_edit = $edit;
						else if(isset($_GET['edit'])){
							$edit = $_GET['edit'];
							if($edit == 1)
								$enable_edit = $edit;
						}
						
						//else $edit = 0;
						?>
						<input type = "hidden" name = "id" value = "<?php echo $id ?>" />
						<input type = "hidden" name = "edit" value = "<?php echo $edit ?>" />
					

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">First Name <span class="text-danger">*</span></label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
									<input type="text" class="form-control" name="Student[first_name]" value="<?php echo $student->first_name; ?>" required="" />
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Last Name <span class="text-danger">*</span></label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
									<input type="text" class="form-control" name="Student[last_name]" value="<?php echo $student->last_name; ?>" required />
								</div>
							</div>
						</div>

						<div id="username-group" class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Username <span class="text-danger">*</span></label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="glyphicon glyphicon-log-in"></span></span>
									<input id="username" type="text" class="form-control" name="Student[username]" value="<?php echo $student->username; ?>" required/>
								</div>
							</div>
							<div id="username-status" style="display: table;  height: 30px; overflow: hidden;"></div>
						</div>
						
						

						
						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Address <span class="text-danger">*</span></label>
							<div class="col-md-3 col-xs-12">
								<div class="input-group" style="z-index: 999">
									<span class="input-group-addon"><span class="fa fa-flag"></span></span>
									<select id="country" class="form-control select" data-live-search="true" name="Student[country]">
										<?php foreach ($countries as $country):	?>
											<?php if($country->id == $student->country): ?>
												<option value="<?php echo $country->id ?>" selected ><?php echo $country -> name; ?></option>
											<?php else: ?>
												<option value="<?php echo $country->id ?>" ><?php echo $country -> name; ?></option>
											<?php endif; ?>
										<?php endforeach; ?>
									</select>
									
								</div>
							</div>

							<div class="col-md-3 col-xs-12">
								<div id="cities" class="input-group" city-id = "<?php echo $student->city ?>" style="z-index: 999">
									

								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Gender <span class="text-danger">*</span></label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group" style="z-index: 990">
									<span class="input-group-addon"><span class="fa fa-group"></span></span>
									<select id="gender" class="form-control select" name="Student[gender]">
										
										<?php if($student->gender == 0): ?>
											<option value="0" selected>Male</option>
										<?php else: ?>
											<option value="0">Male</option>
										<?php endif; ?>
										
										<?php if($student->gender == 1): ?>
											<option value="1" selected>Female</option>
										<?php else: ?>
											<option value="1">Female</option>
										<?php endif; ?>
										
									</select>
								</div>
							</div>
						</div>


						
						
						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Phone Number <span class="text-danger">*</span></label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-phone"></span></span>
									<input type="text" class="form-control" name="Student[phone_no]" value="<?php echo $student->phone_no; ?>" required/>
								</div>
							</div>
						</div>

						<div id="email-group" class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Email Address</label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-envelope"></span></span>
									<input id="email" type="email" class="form-control" name="Student[email]" value="<?php echo $student->email; ?>" />
								</div>
							</div>
							<div id="email-status"></div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Skype ID <span class="text-danger">*</span></label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-skype"></span></span>
									<input type="text" class="form-control" name="Student[skype_id]" value="<?php echo $student->skype_id; ?>" />
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Date of Birth <span class="text-danger">*</span></label>
							<div id="date-day-group" class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-calendar"></span></span>
									<input id="date_of_birth" type="text" class="form-control datepicker" name="Student[date_of_birth]" value="<?php echo $student->date_of_birth; ?>" >
								</div>

							</div>
						</div>
						
						
						
						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Class Package <span class="text-danger">*</span></label>
							<div class="col-md-6 col-xs-12">
								<?php if(isset($enable_edit)): ?>
								<select id="package" class="form-control select" name="Student[class_package]">
								<?php else: ?>
								<select id="package" class="form-control select" name="Student[class_package]" disabled>
								<?php endif; ?>
								
									<?php for($i=1;$i<11;$i++): ?>
										<?php if($i == count($slots)): ?>
											<option value="<?php echo $i ?>" selected><?php echo $i ?> Lesson/Week</option>
										<?php else: ?>
											<option value="<?php echo $i ?>" ><?php echo $i ?> Lesson/Week</option>
										<?php endif; ?>
									<?php endfor; ?>
								</select>
							</div>

						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Lessons Times <span class="text-danger">*</span></label>
							<label class="col-md-2 col-xs-12" style="text-align: center;">Lesson Type</label>
							<label class="col-md-1 col-xs-12" style="text-align: center;">Day</label>
							<label class="col-md-1 col-xs-12" style="text-align: center;">Period (Minutes)</label>
							<label class="col-md-1 col-xs-12" style="text-align: center;">From</label>
							<label class="col-md-1 col-xs-12" style="text-align: center;">To</label>
						</div>



						<!--<div class="slots" style="visibility: hidden">
							<?php foreach($slots as $slot): ?>
								<input type="text" class="time-from" value="<?php echo $slot->from ?>" />
								<input type="text" class="time-to" value="<?php echo $slot->to ?>" />
								<input type="text" class="time-day" value="<?php echo $slot->day ?>" />
							<?php endforeach; ?>
							
						</div>-->
						<div class="form-group" id="preference">
							<?php $days = array("Saturday" , "Sunday" , "Monday" , "Tuesday" , "Wednesday" , "Thursday" , "Friday"); ?>
							<?php for($i=0;$i<count($slots);$i++): ?>
							<div class="form-group slot-time"> 
								<label class="col-md-3 col-xs-12 control-label"></label> 
								<div class="col-md-2 col-xs-12 lesson-type"> 
									<?php if(isset($enable_edit)): ?>
									<select class="form-control select" name="Student[prefered_lesson_type_<?php echo ($i+1); ?>]">
									<?php else: ?> 
									<select class="form-control select" name="Student[prefered_lesson_type_<?php echo ($i+1); ?>]" disabled>
									<?php endif; ?>
										<option value="1">Quran Hifdh</option>
										<option value="2">Quran Reading</option>
										<option value="3">Arabic</option>
									</select>
								</div>  
								<?php if(isset($enable_edit)): ?>
									<div edit="0" class="col-md-1 col-xs-12 days-container" first="1" day = <?php echo $days[$slots[$i]->day]; ?> ></div>
								<?php else: ?>
									<div edit="1" class="col-md-1 col-xs-12 days-container" first="1" day = <?php echo $days[$slots[$i]->day]; ?> ></div>
								<?php endif; ?>
								
								<div class="col-md-1 col-xs-12">
									<?php if(isset($enable_edit)): ?>
										<input type="number" min="30" max="120" value="<?php echo $slots[$i]->period; ?>" class="form-control period" name="Student[prefered_lesson_period_<?php echo ($i+1); ?>]" > 
									<?php else: ?>
										<input type="number" min="30" max="120" value="30" class="form-control period" name="Student[prefered_lesson_period_<?php echo ($i+1); ?>]" disabled >
									<?php endif; ?>
								</div>
								<div class="col-md-1 col-xs-12"> 
									<div class="input-group bootstrap-timepicker">
										<?php
										$slots[$i]->from = date("g:i a", strtotime($slots[$i]->from));
				 						$slots[$i]->to = date("g:i a", strtotime($slots[$i]->to));
				 						
				 						//$received_data['LessonRequest']['to'][$i] = date("H:i", strtotime($received_data['LessonRequest']['to'][$i]));
										
										 ?>
										<?php if(isset($enable_edit)): ?>
											<input value="<?php echo $slots[$i]->from ?>" type="text" name="Student[prefered_from_<?php echo ($i+1) ?>]" class="form-control timeslot timepicker_from" style="border-radius: 5px;"/>
										<?php else: ?>
											<input value="<?php echo $slots[$i]->from ?>" type="text" name="Student[prefered_from_<?php echo ($i+1) ?>]" class="form-control timeslot timepicker_from" style="border-radius: 5px;" disabled />
										<?php endif; ?>
									</div>
								</div>
								<div class="col-md-1 col-xs-12">
									<div class="input-group bootstrap-timepicker">
										<?php if(isset($enable_edit)): ?>
											<input value="<?php echo $slots[$i]->to ?>" type="text" name="Student[prefered_to_<?php echo ($i+1) ?>]" class="form-control timeslot timepicker_to" style="border-radius: 5px;"/>
										<?php else: ?>
											<input value="<?php echo $slots[$i]->to ?>" type="text" name="Student[prefered_to_<?php echo ($i+1) ?>]" class="form-control timeslot timepicker_to" style="border-radius: 5px;" disabled />
										<?php endif; ?>
									</div>
								</div>
							</div>
							<?php endfor; ?>

						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Guardians Name</label>
							<div class="col-md-6 col-xs-12">
								<input type="text" class="form-control" name="Student[guardians_name]" value="<?php echo $student->guardians_name; ?>" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Notes</label>
							<div class="col-md-6 col-xs-12">
								<textarea class="form-control" rows="3" name="Student[notes]" > <?php echo $student->notes ?> </textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">How did you hear about us</label>
							<div class="col-md-2 col-xs-12">
								<select id="hear_us" class="form-control select" name="Student[hear_us]" >
									<option value="Twitter">Twitter</option>
									<option value="Facebook">Facebook</option>
									<option value="Whats App">Whats App</option>
									<option value="Flyer">Flyer</option>
									<option value="Google">Google</option>
									<option value="Gum Tree">Gum Tree</option>
									<option value="Friend">Friend</option>
									<option value="Masjid">Masjid</option>
									<option value="Email">Email</option>
									<option value="Others">Others</option>
								</select>
							</div>
							<div class="col-md-4 col-xs-12">
								<input id="hear_us_others" type="text" class="form-control" name="Student[hear_us_others]" />
							</div>
						</div>

						
						
					
					<div class="panel-footer">
						<button class="btn btn-default">
							Clear Form
						</button>
						<button type="submit" class="btn btn-primary pull-right">
							Submit
						</button>
					</div>
				
			</form>

		</div>
	</div>


<!-- THIS PAGE PLUGINS -->
<script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<script type='text/javascript' src='js/plugins/validationengine/languages/jquery.validationEngine-en.js'></script>
<script type='text/javascript' src='js/plugins/validationengine/jquery.validationEngine.js'></script>        

<script type='text/javascript' src='js/plugins/jquery-validation/jquery.validate.js'></script>                

<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-file-input.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="js/edit_student.js"></script>

<!-- END THIS PAGE PLUGINS -->
