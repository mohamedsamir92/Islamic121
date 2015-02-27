<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap" style="padding: 15px;">

	<div class="row">
		<div class="col-md-12">

			<form class="form-horizontal" action="index.php?r=DataModule/AddStudent" method="post" enctype="multipart/form-data">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>Student</strong> Sign Up</h3>
					</div>
					<div class="panel-body">

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Name</label>
							<div class="col-md-3 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span>First</span></span>
									<input type="text" class="form-control"/ name="Student[first_name]" required="">
								</div>
							</div>

							<div class="col-md-3 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span>Last</span></span>
									<input type="text" class="form-control" name="Student[last_name]" required="" />
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Username</label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="glyphicon glyphicon-log-in"></span></span>
									<input type="text" class="form-control" name="Student[username]" required="" />
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Password</label>
							<div class="col-md-3 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
									<input type="password" class="form-control" name="Student[password]" required=""/>
								</div>
							</div>

							<div class="col-md-3 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
									<input type="password" class="form-control" required=""/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Phone No.</label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-phone"></span></span>
									<input type="text" class="form-control" name="Student[phone_no]" required=""/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Email Address</label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-envelope"></span></span>
									<input type="text" class="form-control" name="Student[email]" required=""/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Skype ID</label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-skype"></span></span>
									<input type="text" class="form-control" name="Student[skype_id]" required=""/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Age</label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="glyphicon glyphicon-signal"></span></span>
									<input type="text" class="form-control" name="Student[age]" required=""/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Address</label>
							<div class="col-md-3 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-flag"></span></span>
									<input type="text" class="form-control" placeholder="Country" name="Student[country]" required=""/>
								</div>
							</div>

							<div class="col-md-3 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-flag-o"></span></span>
									<input type="text" class="form-control" placeholder="City" name="Student[city]" required=""/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Gender</label>
							<div class="col-md-6 col-xs-12">
								<select class="form-control select" name="Student[gender]">
									<option value="0">Male</option>
									<option value="1">Female</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Class Package</label>
							<div class="col-md-6 col-xs-12">
								<select  id="package" class="form-control select" name="Student[class_package]">
									<option value="1">1 Day/Week</option>
									<option value="2">2 Days/Week</option>
									<option value="3">3 Days/Week</option>
									<option value="4">4 Days/Week</option>
									<option value="5">5 Days/Week</option>
								</select>
							</div>
						</div>

						<div class="form-group" id="preference">
							
						</div>
						
						
						
						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Guardians Names</label>
							<div class="col-md-6 col-xs-12">
								<input type="text" class="form-control" placeholder="Guardians Name" name="Student[guardians_name]" required=""/>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Notes</label>
							<div class="col-md-6 col-xs-12">
								<textarea class="form-control" rows="3" name="Student[notes]" required=""></textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">How did you hear about us</label>
							<div class="col-md-6 col-xs-12">
								<select class="form-control select" name="Student[hear_us]" >
									<option value="facebook">Facebook</option>
									<option value="twitter">Twitter</option>
									<option value="google+">Google+</option>
									<option value="linkedin">LinkedIn</option>
									<option value="others">Others</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Lessons</label>
							<div class="col-md-1 col-xs-12">
								<label class="check">
									<input type="checkbox" class="icheckbox" checked="checked" name="Student[quran_course]" value="1" />
									Quran</label>
							</div>
							<div class="col-md-1 col-xs-12">
								<label class="check">
									<input type="checkbox" class="icheckbox" checked="checked" name="Student[arabic_course]" value="1" />
									Arabic</label>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Profile Image</label>
							<div class="col-md-6 col-xs-12">
								<input type="file" class="fileinput btn-primary" name="Student[image]" title="Browse image"/>
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
<script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>

<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-timepicker.min.js"></script>                
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-file-input.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="js/myscript.js"></script>

<!-- END THIS PAGE PLUGINS -->

