<div class="page-content-wrap">

	<div class="row">
		<div class="col-md-3 col-sm-4 col-xs-5">

			<form action="#" class="form-horizontal">
				<div class="panel panel-default">
					<div class="panel-body">
						<h3><span class="fa fa-user"></span> <?php echo Yii::app()->user->first_name . " ". Yii::app()->user->last_name ?> </h3>
						<p>
							Teacher
						</p>
						<div class="text-center" id="user_image">
							<img src="<?php echo  Yii::app()->request->baseUrl . '/images/' . Yii::app() -> user -> image ?>" class="img-thumbnail"/>
						</div>
					</div>
					<div class="panel-body form-group-separated">

						<div class="form-group">
							<label class="col-md-3 col-xs-5 control-label">#ID</label>
							<div class="col-md-9 col-xs-7">
								<label class="control-label"><?php echo Yii::app()->user->id; ?></label>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-5 control-label">Login</label>
							<div class="col-md-9 col-xs-7">
								<label class="control-label"><?php echo Yii::app()->user->username; ?></label>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-5 control-label">Age</label>
							<div class="col-md-9 col-xs-7">
								<label class="control-label"><?php echo Yii::app()->user->age ?></label>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-5 control-label">Phone</label>
							<div class="col-md-9 col-xs-7">
								<label class="control-label"><?php echo Yii::app()->user->phone_no ?></label>
							</div>
						</div>

					</div>
				</div>
			</form>

		</div>
		<div class="col-md-6 col-sm-8 col-xs-7">

			<form action="#" class="form-horizontal">
				<div class="panel panel-default">
					<div class="panel-body">
						<h3><span class="fa fa-pencil"></span> Profile</h3>
					</div>
					<div class="panel-body form-group-separated">
						<div class="form-group">
							<label class="col-md-3 col-xs-5 control-label">First Name</label>
							<div class="col-md-9 col-xs-7">
								<label class="control-label"><?php echo Yii::app()->user->first_name; ?></label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 col-xs-5 control-label">Last Name</label>
							<div class="col-md-9 col-xs-7">
								<label class="control-label"><?php echo Yii::app()->user->last_name; ?></label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 col-xs-5 control-label">E-mail</label>
							<div class="col-md-9 col-xs-7">
								<label class="control-label"><?php echo Yii::app()->user->email; ?></label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 col-xs-5 control-label">Skype ID</label>
							<div class="col-md-9 col-xs-7">
								<label class="control-label"><?php echo Yii::app()->user->skype_id; ?></label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 col-xs-5 control-label">Country</label>
							<div class="col-md-9 col-xs-7">
								<label class="control-label"><?php echo Yii::app()->user->country; ?></label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 col-xs-5 control-label">City</label>
							<div class="col-md-9 col-xs-7">
								<label class="control-label"><?php echo Yii::app()->user->city; ?></label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 col-xs-5 control-label">Gender</label>
							<div class="col-md-9 col-xs-7">
								<label class="control-label"><?php if(Yii::app()->user->gender == 0 ): ?>Male<?php else: ?>Female <?php endif; ?></label>
							</div>
						</div>
						<div class="form-group form-group-border-left">
							<label class="col-md-3 col-xs-5 control-label">Notes</label>
							<div class="col-md-9 col-xs-7">
								<label class="control-label"><?php echo Yii::app()->user->notes; ?></label>
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
								<input type="checkbox" checked value="1" disabled/>
								<span></span> </label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-6 col-xs-6 control-label">Messeging</label>
						<div class="col-md-6 col-xs-6">
							<label class="switch">
								<input type="checkbox" checked value="1" disabled/>
								<span></span> </label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-6 col-xs-6 control-label">Quran</label>
						<div class="col-md-6 col-xs-6">
							<label class="switch">
								<input type="checkbox" checked value="1" disabled/>
								<span></span> </label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-6 col-xs-6 control-label">Arabic</label>
						<div class="col-md-6 col-xs-6">
							<label class="switch">
								<input type="checkbox" checked value="0" disabled/>
								<span></span> </label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-6 col-xs-6 control-label">Supervisor</label>
						<div class="col-md-6 col-xs-6">
							<label class="switch">
								<input type="checkbox" checked value="0" disabled/>
								<span></span> </label>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12 col-sm-8 col-xs-7">

			<form action="#" class="form-horizontal">
				<div class="panel panel-default">
					<div class="panel-body">
						<h3><span class="fa fa-calendar"></span> Working Times</h3>
					</div>
					<div class="panel-body form-group-separated">

						<?php 
						$days = array("Saturday" , "Sunday" , "Monday" , "Tuesday" , "Wednesday" , "Thursday" , "Friday");
						foreach ($slots as $slot): 
						$slot->from  = date("g:i a", strtotime($slot->from));
						$slot->to = date("g:i a", strtotime($slot->to));
																			
						?>
						<div class="form-group">
							<div class="col-md-2 col-xs-12">
								<label class="check">
									<input type="checkbox" class="icheckbox" disabled checked="checked"/>
									<?php echo $days[$slot->day]; ?></label>
							</div>
							<div class="col-md-5 col-xs-12">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<input type="text" class="form-control timepicker" value="<?php echo $slot->from; ?>" disabled/>
								</div>
							</div>
							<div class="col-md-5 col-xs-12">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<input type="text" class="form-control timepicker" value="<?php echo $slot->to; ?>" disabled/>
								</div>
							</div>
						</div>
						
						<?php endforeach; ?>


					</div>
				</div>
			</form>

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
