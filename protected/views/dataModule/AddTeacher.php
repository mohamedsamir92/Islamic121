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
<div class="page-content-wrap" style="padding: 15px;">

	<div class="row">
		<div class="col-md-12">

			<form class="form-horizontal" action="index.php?r=DataModule/AddTeacher" method="post" enctype="multipart/form-data">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Add New <strong>Teacher</strong></h3>
					</div>
					<div class="panel-body">

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Name<span class="text-danger">*</span></label>
							<div class="col-md-3 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span>First</span></span>
									<input type="text" class="form-control"/ name="Teacher[first_name]" required="">
								</div>
							</div>

							<div class="col-md-3 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span>Last</span></span>
									<input type="text" class="form-control" name="Teacher[last_name]" required=""/>
								</div>
							</div>
						</div>

						<div id="username-group" class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Username <span class="text-danger">*</span></label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="glyphicon glyphicon-log-in"></span></span>
									<input id="username" type="text" class="form-control" name="Teacher[username]" required="" />
								</div>
							</div>
							<div id="username-status" style="display: table;  height: 30px; overflow: hidden;"></div>
						</div>

						<div id="password-group" class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Password <span class="text-danger">*</span></label>
							<div class="col-md-3 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
									<input id="password" type="password" class="form-control" name="Teacher[password]" required="" />
								</div>
							</div>

							<div class="col-md-3 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
									<input id="confirmed-password" type="password" class="form-control" placeholder="Enter your password again" name="Teacher[confirmed_password]" />
								</div>
							</div>
							<div id="password-status"></div>
							
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Phone Number <span class="text-danger">*</span></label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-phone"></span></span>
									<input type="text" class="form-control" name="Teacher[phone_no]" required=""/>
								</div>
							</div>
						</div>

						<div id="email-group" class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Email Address</label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-envelope"></span></span>
									<input id="email" type="text" class="form-control" name="Teacher[email]"/>
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
									<input id="date_of_birth" type="text" class="form-control datepicker" name="Teacher[date_of_birth]" value="2005-01-01">
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
											<option value="<?php echo $country->id ?>"><?php echo $country -> name; ?></option>
										<?php endforeach; ?>
									</select>
									
								</div>
							</div>

							<div class="col-md-3 col-xs-12">
								<div id="cities" class="input-group" style="z-index: 999">
									

								</div>
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Gender <span class="text-danger">*</span></label>
							<div class="col-md-6 col-xs-12">
								<select class="form-control select" name="Teacher[gender]">
									<option value="0">Male</option>
									<option value="1">Female</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Working Times</label>

							<div class="col-md-2 col-xs-12">
								<label class="check">
									<input type="checkbox" class="day-check icheckbox" checked="checked" number="0" name="Teacher[days][]" value="0"/>
									Saturday</label>
							</div>
							<div class="col-md-2 col-xs-12">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<input type="text" class="time-from form-control timepicker" name="Teacher[from][]" number="0" />
								</div>
							</div>
							<div class="col-md-2 col-xs-12">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<input type="text" class="time-to form-control timepicker" name="Teacher[to][]" number="0" />
								</div>
							</div>
							<div class="col-md-2 col-xs-12 slot-status"></div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label"></label>

							<div class="col-md-2 col-xs-12">
								<label class="check">
									<input type="checkbox" class="day-check icheckbox" checked="checked" number="1" name="Teacher[days][]" value="1"/>
									Sunday</label>
							</div>
							<div class="col-md-2 col-xs-12">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<input type="text" class="time-from form-control timepicker" name="Teacher[from][]" number="1" />
								</div>
							</div>
							<div class="col-md-2 col-xs-12">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<input type="text" class="time-to form-control timepicker" name="Teacher[to][]" number="1" />
								</div>
							</div>
							<div class="col-md-2 col-xs-12 slot-status"></div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label"></label>

							<div class="col-md-2 col-xs-12">
								<label class="check">
									<input type="checkbox" class="day-check icheckbox" checked="checked" number="2" name="Teacher[days][]" value="2"/>
									Monday</label>
							</div>
							<div class="col-md-2 col-xs-12">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<input type="text" class="time-from form-control timepicker" name="Teacher[from][]" number="2" />
								</div>
							</div>
							<div class="col-md-2 col-xs-12">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<input type="text" class="time-to form-control timepicker" name="Teacher[to][]" number="2" />
								</div>
							</div>
							<div class="col-md-2 col-xs-12 slot-status"></div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label"></label>

							<div class="col-md-2 col-xs-12">
								<label class="check">
									<input type="checkbox" class="day-check icheckbox" checked="checked" number="3" name="Teacher[days][]" value="3" />
									Tuesday</label>
							</div>
							<div class="col-md-2 col-xs-12">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<input type="text" class="time-from form-control timepicker" name="Teacher[from][]" number="3" />
								</div>
							</div>
							<div class="col-md-2 col-xs-12">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<input type="text" class="time-to form-control timepicker" name="Teacher[to][]" number="3" />
								</div>
							</div>
							<div class="col-md-2 col-xs-12 slot-status"></div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label"></label>

							<div class="col-md-2 col-xs-12">
								<label class="check">
									<input type="checkbox" class="day-check icheckbox" checked="checked" number="4" name="Teacher[days][]" value="4" />
									Wednesday</label>
							</div>
							<div class="col-md-2 col-xs-12">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<input type="text" class="time-from form-control timepicker" name="Teacher[from][]" number="4" />
								</div>
							</div>
							<div class="col-md-2 col-xs-12">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<input type="text" class="time-to form-control timepicker" name="Teacher[to][]" number="4" />
								</div>
							</div>
							<div class="col-md-2 col-xs-12 slot-status"></div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label"></label>

							<div class="col-md-2 col-xs-12">
								<label class="check">
									<input type="checkbox" class="day-check icheckbox" checked="checked" number="5" name="Teacher[days][]" value="5" />
									Thursday</label>
							</div>
							<div class="col-md-2 col-xs-12">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<input type="text" class="time-from form-control timepicker" name="Teacher[from][]" number="5" />
								</div>
							</div>
							<div class="col-md-2 col-xs-12">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<input type="text" class="time-to form-control timepicker" name="Teacher[to][]" number="5" />
								</div>
							</div>
							<div class="col-md-2 col-xs-12 slot-status"></div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label"></label>

							<div class="col-md-2 col-xs-12">
								<label class="check">
									<input type="checkbox" class="day-check icheckbox" checked="checked" number="6" name="Teacher[days][]" value="6" />
									Friday</label>
							</div>
							<div class="col-md-2 col-xs-12">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<input type="text" class="time-from form-control timepicker" name="Teacher[from][]" number="6" />
								</div>
							</div>
							<div class="col-md-2 col-xs-12">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<input type="text" class="time-to form-control timepicker" name="Teacher[to][]" number="6" />
								</div>
							</div>
							<div class="col-md-2 col-xs-12 slot-status"></div>
						</div>

						
						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Notes</label>
							<div class="col-md-6 col-xs-12">
								<textarea class="form-control" rows="3" name="Teacher[notes]"></textarea>
							</div>
						</div>

						
						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Teach</label>
							<?php for($i=0;$i<count($lessons);$i++): ?>
							
							<div class="col-md-2 col-xs-12">
								<label class="check">
									<input type="checkbox" class="icheckbox" checked="checked" name="Teacher[lesson][]" value="<?php echo $lessons[$i]->id; ?>" />
									<?php echo $lessons[$i]->name; ?></label>
							</div>
							<?php endfor; ?>
							
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Profile Image</label>
							<div class="col-md-6 col-xs-12">
								<input type="file" class="fileinput btn-primary" name="Teacher[image]" title="Browse image"/>
							</div>
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
				</div>
			</form>

		</div>
	</div>

</div>
<!-- THIS PAGE PLUGINS -->
		<script type='text/javascript' src='js/teacher_script.js'></script>
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-timepicker.min.js"></script>                
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-file-input.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>
        <script type="text/javascript" src="js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
        <!-- END THIS PAGE PLUGINS -->       
        