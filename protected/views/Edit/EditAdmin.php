<div class="page-content-wrap">

	<div class="row">
		<div class="col-md-3 col-sm-4 col-xs-5">

			<form action="index.php?r=Edit/EditAdmin" method="post" class="form-horizontal" enctype="multipart/form-data">
				<div class="panel panel-default">
					<div class="panel-body">
						<h3><span class="fa fa-user"></span><?php echo Yii::app()->user->first_name . " ". Yii::app()->user->last_name ?></h3>
						<p>
							Admin
						</p>
						<div class="text-center" id="user_image">
							<img src="<?php echo  Yii::app()->request->baseUrl . '/images/' . Yii::app() -> user -> image ?>" class="img-thumbnail"/>
						</div>
					</div>
					<div class="panel-body form-group-separated">

						
						
						<div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Change Image</label>
                                <div class="col-md-6 col-xs-12">
                                    <input type="file" class="fileinput btn-primary" name="Admin[image]" title="Browse image"/>
                                </div>
                        </div>

						<div class="form-group">
							<label class="col-md-3 col-xs-5 control-label">#ID</label>
							<div class="col-md-9 col-xs-7">
								<input type="text" value="<?php echo Yii::app()->user->id ?>" class="form-control" disabled/>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-5 control-label">Login</label>
							<div class="col-md-9 col-xs-7">
								<input type="text" value="<?php echo Yii::app()->user->username ?>" name="Admin[username]" class="form-control"/>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-5 control-label">Age</label>
							<div class="col-md-9 col-xs-7">
								<input type="number" value="<?php echo Yii::app() -> user -> age; ?>" name = "Admin[age]" class="form-control"/>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-5 control-label">Phone</label>
							<div class="col-md-9 col-xs-7">
								<input type="text" value="<?php echo Yii::app() -> user -> phone_no; ?>" name = "Admin[phone_no]" class="form-control"/>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-12 col-xs-12">
								
								<a href="#" class="btn btn-danger btn-block btn-rounded" data-toggle="modal" data-target="#modal_change_password">Change password</a>
							</div>
						</div>

					</div>
				</div>
			

		</div>
		<div class="col-md-6 col-sm-8 col-xs-7">

			
				<div class="panel panel-default">
					<div class="panel-body">
						<h3><span class="fa fa-pencil"></span> Profile</h3>
					</div>
					<div class="panel-body form-group-separated">
						<div class="form-group">
							<label class="col-md-3 col-xs-5 control-label">First Name</label>
							<div class="col-md-9 col-xs-7">
								<input type="text" value="<?php echo Yii::app() -> user -> first_name; ?>" name = "Admin[first_name]" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 col-xs-5 control-label">Last Name</label>
							<div class="col-md-9 col-xs-7">
								<input type="text" value="<?php echo Yii::app() -> user -> last_name; ?>" name = "Admin[last_name]" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 col-xs-5 control-label">E-mail</label>
							<div class="col-md-9 col-xs-7">
								<input type="text" value="<?php echo Yii::app() -> user -> email; ?>" name = "Admin[email]" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 col-xs-5 control-label">Skype ID</label>
							<div class="col-md-9 col-xs-7">
								<input type="text" value="<?php echo Yii::app()->user->skype_id ?>" name="Admin[skype_id]" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 col-xs-5 control-label">Country</label>
							<div class="col-md-9 col-xs-7">
								<input type="text" value="<?php echo Yii::app() -> user -> country; ?>" name = "Admin[skype_id]" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 col-xs-5 control-label">City</label>
							<div class="col-md-9 col-xs-7">
								<input type="text" value="<?php echo Yii::app() -> user -> city; ?>" name = "Admin[city]" class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 col-xs-5 control-label">Gender</label>
							<div class="col-md-9 col-xs-7">
								<select name="Admin[gender]" class="form-control select">
									<option value="0">Male</option>
									<option value="1">Female</option>
								</select>
							</div>
						</div>
						<div class="form-group form-group-border-left">
							<label class="col-md-3 col-xs-5 control-label">Notes</label>
							<div class="col-md-9 col-xs-7">
								<textarea class="form-control" rows="3" name="Admin[notes]"><?php echo Yii::app() -> user -> notes; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12 col-xs-5">
								<button type="submit" class="btn btn-primary btn-rounded pull-right">
									Save
								</button>
							</div>
						</div>
					</div>
				</div>
			</form>

		</div>

		<div class="col-md-3">
			<div class="panel panel-default form-horizontal">
				<div class="panel-body">
					<h3><span class="fa fa-info-circle"></span> Quick Info</h3>
				</div>
				<div class="panel-body form-group-separated">
					<div class="form-group">
						<label class="col-md-4 col-xs-5 control-label">Last visit</label>
						<div class="col-md-8 col-xs-7 line-height-30">
							12:46 27.11.2014
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 col-xs-5 control-label">Registration</label>
						<div class="col-md-8 col-xs-7 line-height-30">
							01:15 21.11.2014
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 col-xs-5 control-label">Birthday</label>
						<div class="col-md-8 col-xs-7 line-height-30">
							14/02/1989
						</div>
					</div>
				</div>

			</div>

			<div class="panel panel-default">
				<div class="panel-body">
					<h3><span class="fa fa-cog"></span> Settings</h3>
				</div>
				<div class="panel-body form-horizontal form-group-separated">
					<div class="form-group">
						<label class="col-md-6 col-xs-6 control-label">Notifications</label>
						<div class="col-md-6 col-xs-6">
							<label class="switch">
								<input type="checkbox" checked value="1"/>
								<span></span> </label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-6 col-xs-6 control-label">Messeging</label>
						<div class="col-md-6 col-xs-6">
							<label class="switch">
								<input type="checkbox" checked value="1"/>
								<span></span> </label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-6 col-xs-6 control-label">Quran</label>
						<div class="col-md-6 col-xs-6">
							<label class="switch">
								<input type="checkbox" checked value="1"/>
								<span></span> </label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-6 col-xs-6 control-label">Arabic</label>
						<div class="col-md-6 col-xs-6">
							<label class="switch">
								<input type="checkbox" checked value="0"/>
								<span></span> </label>
						</div>
					</div>
				</div>
			</div>
		</div>

		
	</div>

</div>
<!-- START THIS PAGE PLUGINS-->
<script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>

<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-file-input.js"></script>
<script type="text/javascript" src="js/plugins/form/jquery.form.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="js/plugins/cropper/cropper.min.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>
<!-- END THIS PAGE PLUGINS-->
