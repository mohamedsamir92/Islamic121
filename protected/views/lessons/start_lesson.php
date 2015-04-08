<!-- PAGE CONTENT WRAPPER -->
<?php
$teacher = DataModuleController::getTeacher($lesson -> teacher_id);
$student = DataModuleController::getStudent($lesson -> student_id);
$lessonType = LessonsController::getType($lesson -> lesson_type_id);
?>
<div class="page-content-wrap">

	<div class="row">
		<div class="col-md-12">

			<form class="form-horizontal" action="index.php?r=Lessons/changeLessonState" method="post">
				<input type="hidden" name="id" value="<?php echo $lesson->id ?>" />
				<div class="panel panel-default">
					<div class="panel-heading ui-draggable-handle">
						<h3 class="panel-title">Lesson <strong>View</strong></h3>
					</div>
					<div class="panel-body">

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Student Name</label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-user"></span></span>
									<input type="text" class="form-control" disabled="" value="<?php echo $student->first_name . " " . $student->last_name ?>">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Teacher Name</label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-briefcase"></span></span>
									<input type="text" class="form-control" disabled="" value="<?php echo $teacher->first_name . " " . $teacher->last_name ?>">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Lesson Type</label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-info"></span></span>
									<input type="text" class="form-control" disabled="" value="<?php echo $lessonType->name ?>">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Date</label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-calendar"></span></span>
									<input type="text" class="form-control" disabled="" value="<?php echo substr($lesson->expected_start_time,0,strpos($lesson->expected_start_time, " ")); ?>">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Expected Time</label>
							<div class="col-md-3 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon">From</span>
									<input type="text" class="form-control" disabled="" value="<?php echo substr($lesson->expected_start_time,strpos($lesson->expected_start_time, " ")+1); ?>">
								</div>
							</div>

							<div class="col-md-3 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon">To</span>
									<input type="text" class="form-control" disabled="" value="<?php echo substr($lesson->expected_end_time,strpos($lesson->expected_end_time, " ")+1); ?>">
								</div>
							</div>

						</div>

						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Price</label>
							<div class="col-md-6 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon">$</span>
									<input type="text" class="form-control" disabled="" value="<?php echo $lesson->cost; ?>">
									<span class="input-group-addon"><span class="fa fa-money"></span></span>
								</div>
							</div>

						</div>

					</div>
					<div class="panel-footer">
						<button type="submit" class="btn btn-primary pull-right">
							Start Lesson Now
						</button>
					</div>
				</div>
			</form>

		</div>
	</div>

</div>
<!-- END PAGE CONTENT WRAPPER -->

<!-- THIS PAGE PLUGINS -->
<script type="text/javascript" src="js/plugins/icheck/icheck.min.js"></script>
<script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>

<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-file-input.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>

<script type="text/javascript" src="js/plugins/bootstrap/jquery.tagsinput.min.js"></script>
<!-- END THIS PAGE PLUGINS -->
