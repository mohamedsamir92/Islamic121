<form class="form-horizontal" action="index.php?r=DataModule/Login" method="post" >
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Login</h3>
		</div>
		<div class="panel-body">

			<div class="form-group">
				<label class="col-md-3 col-xs-12 control-label">Username</label>
				<div class="col-md-6 col-xs-12">
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-log-in"></span></span>
						<input type="text" class="form-control" name="Login[username]" />
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 col-xs-12 control-label">Password</label>
				<div class="col-md-3 col-xs-12">
					<div class="input-group">
						<span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
						<input type="password" class="form-control" name="Login[password]"/>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-3 col-xs-12 control-label">Type</label>
				<div class="col-md-3 col-xs-12">
					<div class="input-group">
						<select class="basic" name = "Login[type]">
							<option value = "Student"> Student </option>
							<option value = "Teacher"> Teacher </option>
							<option value = "Admin"> Admin </option>
							<!--<option value = "supervisor"> Supervisor </option>-->
						</select>
					</div>
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

    <!-- THIS PAGE PLUGINS -->
		<script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
		<script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>

		<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-datepicker.js"></script>
		<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-file-input.js"></script>
		<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>
		<script type="text/javascript" src="js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
		<!-- END THIS PAGE PLUGINS -->
