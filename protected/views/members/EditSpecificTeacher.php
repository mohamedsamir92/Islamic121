<?php if(isset($my_message)): ?>
			
		<script>
			$(document).ready(function(){
				
				noty({
                        text: '<?php echo $my_message ?>',
                        layout: 'topRight',
                        type: 'error',
                        timeour: 5000
                        
                   });
			});
		</script>
		<?php endif; ?>

<!-- PAGE CONTENT WRAPPER -->

	<div class="row">
		<div class="col-md-12">

			<form class="form-horizontal" action="index.php?r=members/editTeacher" method="post" enctype="multipart/form-data">
					<?php
						 
						if(isset($_GET['id'])){
							$id = 	$_GET['id'];
						}
						?>
						<input type = "hidden" name = "id" value = "<?php echo $id ?>" />
					
					<div class="panel-body">
						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Name<span class="text-danger">*</span></label>
							<div class="col-md-3 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span>First</span></span>
									<input type="text" class="form-control"/ name="Teacher[first_name]" value="<?php echo $teacher->first_name; ?>" required="">
								</div>
							</div>

							<div class="col-md-3 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span>Last</span></span>
									<input type="text" class="form-control" name="Teacher[last_name]" value="<?php echo $teacher->last_name; ?>" required=""/>
								</div>
							</div>
						</div>

						<div id="username-group" class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Username <span class="text-danger">*</span></label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="glyphicon glyphicon-log-in"></span></span>
									<input id="username" type="text" class="form-control" name="Teacher[username]" value="<?php echo $teacher->username; ?>" required="" />
								</div>
							</div>
							<div id="username-status" style="display: table;  height: 30px; overflow: hidden;"></div>
						</div>

						
						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Phone Number <span class="text-danger">*</span></label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-phone"></span></span>
									<input type="text" class="form-control" name="Teacher[phone_no]" value="<?php echo $teacher->phone_no; ?>" required=""/>
								</div>
							</div>
						</div>

						<div id="email-group" class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Email Address</label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-envelope"></span></span>
									<input id="email" type="text" class="form-control" name="Teacher[email]" value="<?php echo $teacher->email; ?>"  />
								</div>
							</div>
							<div id="email-status"></div>
						</div>

						<!--<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Skype ID</label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-skype"></span></span>
									<input type="text" class="form-control" name="Teacher[skype_id]"/>
								</div>
							</div>
						</div>-->

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Date of Birth <span class="text-danger">*</span></label>
							<div id="date-day-group" class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-calendar"></span></span>
									<input id="date_of_birth" type="text" class="form-control datepicker" name="Teacher[date_of_birth]" value="<?php echo $teacher->date_of_birth; ?>">
								</div>

							</div>
						</div>


					 	<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Address <span class="text-danger">*</span></label>
							<div class="col-md-3 col-xs-12">
								<div class="input-group" >
									<span class="input-group-addon"><span class="fa fa-flag"></span></span>
									<select id="country" class="form-control select" data-live-search="true" name="Teacher[country]">
										<?php foreach ($countries as $country):	?>
											<?php if($country->id == $teacher->country): ?>
												<option selected value="<?php echo $country->id ?>"><?php echo $country -> name; ?></option>
											<?php else: ?>
												<option value="<?php echo $country->id ?>"><?php echo $country -> name; ?></option>
											<?php endif; ?>
										
										<?php endforeach; ?>
									</select>
									
								</div>
							</div>

							<div class="col-md-3 col-xs-12">
								<div id="cities" class="input-group" city-id = "<?php echo $teacher->city ?>" style="z-index: 999">
									

								</div>
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Gender <span class="text-danger">*</span></label>
							<div class="col-md-6 col-xs-12">
								<select class="form-control select" name="Teacher[gender]">
									<?php if($teacher->gender == 0): ?>
										<option selected value="0">Male</option>
									<?php else: ?>
										<option value="0">Male</option>
									<?php endif; ?>
									
									<?php if($teacher->gender == 1): ?>	
										<option selected value="1">Female</option>
									<?php else: ?>
										<option value="1">Female</option>
									<?php endif; ?>
								</select>
							</div>
						</div>

						<?php $days = array("Saturday" , "Sunday" , "Monday" , "Tuesday" , "Wednesday" , "Thursday" , "Friday"); ?>
						<?php for($i=0;$i<7;$i++): ?>
						<div class="form-group">
							<?php if($i == 0): ?>
								<label class="col-md-3 col-xs-12 control-label">Working Times</label>
							<?php else: ?>
								<label class="col-md-3 col-xs-12 control-label"></label>
							<?php endif; ?>
							
							
							
							<?php 
							$current_slot = array();
							foreach($slots as $slot): ?>
							<?php if($slot->day == $i) {
								$current_slot = $slot;
								$current_slot->from = date("g:i a", strtotime($current_slot->from));
				 				$current_slot->to = date("g:i a", strtotime($current_slot->to));
				 						
								break;
							}
							?>
							
							<?php endforeach; ?>
							<div class="col-md-2 col-xs-12">
								<label class="check">
									
									<?php if(count($current_slot) == 0): ?>
										<input type="checkbox" class="day-check icheckbox" number="<?php echo $i ?>" name="Teacher[days][]" value="<?php echo $i ?>"/>
									<?php else: ?>
										<input type="checkbox" class="day-check icheckbox" checked="checked" number="<?php echo $i ?>" name="Teacher[days][]" value="<?php echo $i ?>"/>
									<?php endif; ?>
									<?php echo $days[$i] ?></label>
							</div>
							<div class="col-md-2 col-xs-12">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<?php if(count($current_slot) == 0): ?>
										<input type="text" class="time-from form-control timepicker" name="Teacher[from][]" number="<?php echo $i ?>" disabled />
									<?php else: ?>
										<input type="text" class="time-from form-control timepicker" name="Teacher[from][]" number="<?php echo $i ?>" value = "<?php echo $current_slot->from; ?>" />
									<?php endif; ?>
								</div>
							</div>
							<div class="col-md-2 col-xs-12">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<?php if(count($current_slot) == 0): ?>
										<input type="text" class="time-to form-control timepicker" name="Teacher[to][]" number="<?php echo $i ?>" disabled />
									<?php else: ?>
										<input type="text" class="time-to form-control timepicker" name="Teacher[to][]" number="<?php echo $i ?>" value = "<?php echo $current_slot->to; ?>" />
									<?php endif; ?>
								</div>
							</div>
							<div class="col-md-2 col-xs-12 slot-status"></div>
						</div>
						<?php endfor; ?>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Notes</label>
							<div class="col-md-6 col-xs-12">
								<textarea class="form-control" rows="3" name="Teacher[notes]"> <?php echo $teacher->notes ?></textarea>
							</div>
						</div>

						
						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Teach</label>
							<?php for($i=0;$i<count($lessons);$i++): ?>
							
							<div class="col-md-2 col-xs-12">
								<label class="check">
									<?php 
									$checked = "";
									foreach($selected_lessons as $selected_lesson){
										if($lessons[$i]->id == $selected_lesson->type_id){
											$checked = "checked";
											break;
										}
									} ?>
									<input type="checkbox" class="icheckbox" <?php echo $checked ?> name="Teacher[lesson][]" value="<?php echo $lessons[$i]->id; ?>" />
									<?php echo $lessons[$i]->name; ?></label>
							</div>
							<?php endfor; ?>
							
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
		<script type='text/javascript' src='js/edit_teacher.js'></script>
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-timepicker.min.js"></script>                
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-file-input.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>
        <script type="text/javascript" src="js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
        <!-- END THIS PAGE PLUGINS -->       
        