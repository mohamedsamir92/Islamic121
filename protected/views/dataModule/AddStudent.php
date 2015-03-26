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
<div class="page-content-wrap" style="padding: 15px;">

	<div class="row">
		<div class="col-md-12">

			<form id="jvalidate" class="form-horizontal" action="index.php?r=DataModule/AddStudent" method="post" enctype="multipart/form-data">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>Student</strong> Sign Up</h3>
					</div>
					<div class="panel-body">

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">First Name <span class="text-danger">*</span></label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
									<input type="text" class="form-control" name="Student[first_name]" required="" />
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Last Name <span class="text-danger">*</span></label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
									<input type="text" class="form-control" name="Student[last_name]" required />
								</div>
							</div>
						</div>

						<div id="username-group" class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Username <span class="text-danger">*</span></label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="glyphicon glyphicon-log-in"></span></span>
									<input id="username" type="text" class="form-control" name="Student[username]" required/>
								</div>
							</div>
							<div id="username-status" style="display: table;  height: 30px; overflow: hidden;"></div>
						</div>

						<div id="password-group" class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Password <span class="text-danger">*</span></label>
							<div class="col-md-3 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
									<input id="password" type="password" class="form-control" name="Student[password]" placeholder="Enter your password" required/>
								</div>
							</div>

							<div class="col-md-3 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
									<input id="confirmed-password" type="password" class="form-control" name="Student[confirmed_password]" placeholder="Enter your password again" required/>
								</div>
							</div>
							<div id="password-status"></div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Address <span class="text-danger">*</span></label>
							<div class="col-md-3 col-xs-12">
								<div class="input-group" style="z-index: 999">
									<span class="input-group-addon"><span class="fa fa-flag"></span></span>
									<select id="country" class="form-control select" data-live-search="true" name="Student[country]">
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
								<div class="input-group" style="z-index: 990">
									<span class="input-group-addon"><span class="fa fa-group"></span></span>
									<select id="gender" class="form-control select" name="Student[gender]">
										<option value="0">Male</option>
										<option value="1">Female</option>
									</select>
								</div>
							</div>
						</div>


						
						
						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Phone Number <span class="text-danger">*</span></label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-phone"></span></span>
									<input type="text" class="form-control" name="Student[phone_no]" required/>
								</div>
							</div>
						</div>

						<div id="email-group" class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Email Address</label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-envelope"></span></span>
									<input id="email" type="email" class="form-control" name="Student[email]" />
								</div>
							</div>
							<div id="email-status"></div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Skype ID <span class="text-danger">*</span></label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-skype"></span></span>
									<input type="text" class="form-control" name="Student[skype_id]" />
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Date of Birth <span class="text-danger">*</span></label>
							<div id="date-day-group" class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-calendar"></span></span>
									<input id="date_of_birth" type="text" class="form-control datepicker" name="Student[date_of_birth]" value="2005-01-01">
								</div>

							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Class Package <span class="text-danger">*</span></label>
							<div class="col-md-6 col-xs-12">
								<select id="package" class="form-control select" name="Student[class_package]">
									<option value="1">1 Lesson/Week</option>
									<option value="2">2 Lessons/Week</option>
									<option value="3">3 Lessons/Week</option>
									<option value="4">4 Lessons/Week</option>
									<option value="5">5 Lessons/Week</option>
									<option value="6">6 Lessons/Week</option>
									<option value="7">7 Lessons/Week</option>
									<option value="8">8 Lessons/Week</option>
									<option value="9">9 Lessons/Week</option>
									<option value="10">10 Lessons/Week</option>
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

						<div class="form-group" id="preference">

						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Guardians Name</label>
							<div class="col-md-6 col-xs-12">
								<input type="text" class="form-control" name="Student[guardians_name]" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Notes</label>
							<div class="col-md-6 col-xs-12">
								<textarea class="form-control" rows="3" name="Student[notes]" ></textarea>
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
<script type='text/javascript' src='js/plugins/validationengine/languages/jquery.validationEngine-en.js'></script>
<script type='text/javascript' src='js/plugins/validationengine/jquery.validationEngine.js'></script>        

<script type='text/javascript' src='js/plugins/jquery-validation/jquery.validate.js'></script>                

<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-file-input.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="js/myscript.js"></script>

<!-- END THIS PAGE PLUGINS -->
