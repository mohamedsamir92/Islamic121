<?php if(isset($my_message)): ?>
			
		<script>
			$(document).ready(function(){
				
				noty({
                        text: '<?php echo $my_message ?>',
                        layout: 'topRight',
                        type: 'error',
                        
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
							<label class="col-md-3 col-xs-12 control-label">Name</label>
							<div class="col-md-3 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span>First</span></span>
									<input type="text" class="form-control"/ name="Teacher[first_name]">
								</div>
							</div>

							<div class="col-md-3 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span>Last</span></span>
									<input type="text" class="form-control" name="Teacher[last_name]"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Username</label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="glyphicon glyphicon-log-in"></span></span>
									<input type="text" class="form-control" name="Teacher[username]" />
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Password</label>
							<div class="col-md-3 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
									<input type="password" class="form-control" name="Teacher[password]"/>
								</div>
							</div>

							<div class="col-md-3 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
									<input type="password" class="form-control" placeholder="Enter your password again" name="Teacher[confirmed_password]" />
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Phone No.</label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-phone"></span></span>
									<input type="text" class="form-control" name="Teacher[phone_no]"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Email Address</label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-envelope"></span></span>
									<input type="text" class="form-control" name="Teacher[email]"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Skype ID</label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-skype"></span></span>
									<input type="text" class="form-control" name="Teacher[skype_id]"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Age</label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="glyphicon glyphicon-signal"></span></span>
									<input type="text" class="form-control" name="Teacher[age]"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Address</label>
							<div class="col-md-3 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-flag"></span></span>
									<input type="text" class="form-control" placeholder="Country" name="Teacher[country]"/>
								</div>
							</div>

							<div class="col-md-3 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-flag-o"></span></span>
									<input type="text" class="form-control" placeholder="City" name="Teacher[city]"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Gender</label>
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
									<input type="checkbox" class="icheckbox" checked="checked" name="Teacher[days][]" value="0"/>
									Saturday</label>
							</div>
							<div class="col-md-2 col-xs-12">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<input type="text" class="form-control timepicker" name="Teacher[from][]"/>
								</div>
							</div>
							<div class="col-md-2 col-xs-12">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<input type="text" class="form-control timepicker" name="Teacher[to][]" />
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label"></label>

							<div class="col-md-2 col-xs-12">
								<label class="check">
									<input type="checkbox" class="icheckbox" checked="checked" name="Teacher[days][]" value="1"/>
									Sunday</label>
							</div>
							<div class="col-md-2 col-xs-12">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<input type="text" class="form-control timepicker" name="Teacher[from][]" />
								</div>
							</div>
							<div class="col-md-2 col-xs-12">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<input type="text" class="form-control timepicker" name="Teacher[to][]" />
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label"></label>

							<div class="col-md-2 col-xs-12">
								<label class="check">
									<input type="checkbox" class="icheckbox" checked="checked" name="Teacher[days][]" value="2"/>
									Monday</label>
							</div>
							<div class="col-md-2 col-xs-12">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<input type="text" class="form-control timepicker" name="Teacher[from][]" />
								</div>
							</div>
							<div class="col-md-2 col-xs-12">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<input type="text" class="form-control timepicker" name="Teacher[to][]" />
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label"></label>

							<div class="col-md-2 col-xs-12">
								<label class="check">
									<input type="checkbox" class="icheckbox" checked="checked" name="Teacher[days][]" value="3" />
									Tuesday</label>
							</div>
							<div class="col-md-2 col-xs-12">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<input type="text" class="form-control timepicker" name="Teacher[from][]" />
								</div>
							</div>
							<div class="col-md-2 col-xs-12">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<input type="text" class="form-control timepicker" name="Teacher[to][]" />
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label"></label>

							<div class="col-md-2 col-xs-12">
								<label class="check">
									<input type="checkbox" class="icheckbox" checked="checked" name="Teacher[days][]" value="4" />
									Wednesday</label>
							</div>
							<div class="col-md-2 col-xs-12">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<input type="text" class="form-control timepicker" name="Teacher[from][]" />
								</div>
							</div>
							<div class="col-md-2 col-xs-12">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<input type="text" class="form-control timepicker" name="Teacher[to][]" />
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label"></label>

							<div class="col-md-2 col-xs-12">
								<label class="check">
									<input type="checkbox" class="icheckbox" checked="checked" name="Teacher[days][]" value="5" />
									Thursday</label>
							</div>
							<div class="col-md-2 col-xs-12">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<input type="text" class="form-control timepicker" name="Teacher[from][]" />
								</div>
							</div>
							<div class="col-md-2 col-xs-12">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<input type="text" class="form-control timepicker" name="Teacher[to][]" />
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label"></label>

							<div class="col-md-2 col-xs-12">
								<label class="check">
									<input type="checkbox" class="icheckbox" checked="checked" name="Teacher[days][]" value="6" />
									Friday</label>
							</div>
							<div class="col-md-2 col-xs-12">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<input type="text" class="form-control timepicker" name="Teacher[from][]" />
								</div>
							</div>
							<div class="col-md-2 col-xs-12">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<input type="text" class="form-control timepicker" name="Teacher[to][]" />
								</div>
							</div>
						</div>

						
						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Notes</label>
							<div class="col-md-6 col-xs-12">
								<textarea class="form-control" rows="3" name="Teacher[notes]"></textarea>
							</div>
						</div>

<!--						
						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Teach</label>
							<div class="col-md-1 col-xs-12">
								<label class="check">
									<input type="checkbox" class="icheckbox" checked="checked" name="Teacher[quran_course]" value="1" />
									Quran</label>
							</div>
							<div class="col-md-1 col-xs-12">
								<label class="check">
									<input type="checkbox" class="icheckbox" checked="checked" name="Teacher[arabic_course]" value="1" />
									Arabic</label>
							</div>
						</div>
-->
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
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-timepicker.min.js"></script>                
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-file-input.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>
        <script type="text/javascript" src="js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
        <!-- END THIS PAGE PLUGINS -->       
        