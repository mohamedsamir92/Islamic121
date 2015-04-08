<div class="page-content-wrap">

	<div class="row">
		<div class="col-md-12">

			<!-- START DEFAULT DATATABLE -->
			<div class="panel panel-default">
				<div class="panel-heading ui-draggable-handle">
					<h3 class="panel-title">Lessons Table</h3>
					<ul class="panel-controls">
						<li>
							<a href="http://bareeqtech.net/121islamonlinedesign/all_lessons.html#" class="panel-collapse"><span class="fa fa-angle-down"></span></a>
						</li>
						<li>
							<a href="http://bareeqtech.net/121islamonlinedesign/all_lessons.html#" class="panel-refresh"><span class="fa fa-refresh"></span></a>
						</li>
					</ul>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
							<div class="form-group">

								
								<label class="col-md-1 control-label">From</label>
								<div class="col-md-3">
									<div class="input-group">
										<span class="input-group-addon"><span class="fa fa-calendar"></span></span>
										<input id="from" type="text" class="form-control datepicker" value="<?php echo substr($start_date, 0 , strpos($start_date, " ")); ?>">
									</div>
								</div>
	
								<label class="col-md-1 control-label">To</label>
								<div class="col-md-3">
									<div class="input-group">
										<span class="input-group-addon"><span class="fa fa-calendar"></span></span>
										<input id="to" type="text" class="form-control datepicker" value="<?php echo substr($end_date, 0 , strpos($end_date, " ")); ?>">
									</div>
								</div>

							</div>
							<br><br>

							<table class="table datatable  no-footer" id="DataTables_Table_0" >
								<thead>
									<tr role="row">
										<th style="text-align: center; width: 200px;">student_name</th>
										<th style="text-align: center; width: 198px;">teacher_name</th>
										<th style="text-align: center; width: 183px;">lesson_type</th>
										
										<th style="text-align: center; width: 137px;">expected_start_date</th>
										<th style="text-align: center; width: 137px;">expected_end_date</th>
										<th style="text-align: center; width: 137px;">status</th>
										
										<th style="text-align: center; width: 221px;">Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($lessons as $lesson): 
										$teacher = DataModuleController::getTeacher($lesson->teacher_id);
										$student = DataModuleController::getStudent($lesson->student_id);
										$lessonType = LessonsController::getType($lesson->lesson_type_id);
										?>
									<tr role="row" class="odd">
										
										<td class="sorting_1"><?php echo $student->first_name . " " . $student->last_name; ?></td>
										<td><?php echo $teacher->first_name . " " . $teacher->last_name; ?></td>
										<td><?php echo $lessonType->name; ?></td>
										<td><?php echo $lesson->expected_start_time; ?></td>
										<td><?php echo $lesson->expected_end_time; ?></td>
										
										<?php if($lesson->actual_start_time == $lesson->actual_end_time): ?>								
											<td><span class="label label-default">Not Started</span></td>
										<?php elseif($lesson->actual_start_time > $lesson->actual_end_time): ?>								
											<td><span class="label label-warning">In Progress</span></td>
										<?php elseif($lesson->actual_start_time < $lesson->actual_end_time): ?>								
											<td><span class="label label-info">Finished</span></td>
										<?php endif; ?>
										<td id="actions">
										<div  class="btn-group">
											<a href="index.php?r=lessons/lessonState&id=<?php echo $lesson->id ?>" class="btn btn-default btn-condensed" data-toggle="modal"> <i class="fa fa-eye"></i> </a>
											<a href="#" data-toggle="modal" class="btn btn-default btn-condensed"> <i class="fa fa-pencil"></i> </a>
											<a href="#" class="btn btn-danger btn-condensed"> <i class="fa fa-times"></i> </a>

										</div></td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
							
						</div>
					</div>
				</div>
			</div>
			<!-- END SIMPLE DATATABLE -->

		</div>
	</div>

</div>
<!-- END PAGE CONTENT WRAPPER -->

<!-- START THIS PAGE PLUGINS-->
<script type="text/javascript" src="js/plugins/icheck/icheck.min.js"></script>
<script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="js/plugins/scrolltoptop/scrolltopcontrol.js"></script>

<script type="text/javascript" src="js/plugins/morris/raphael-min.js"></script>
<script type="text/javascript" src="js/plugins/morris/morris.min.js"></script>
<script type="text/javascript" src="js/plugins/rickshaw/d3.v3.js"></script>
<script type="text/javascript" src="js/plugins/rickshaw/rickshaw.min.js"></script>
<script type="text/javascript" src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script type="text/javascript" src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="js/plugins/owl/owl.carousel.min.js"></script>

<script type="text/javascript" src="js/plugins/moment.min.js"></script>
<script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="js/lessons.js"></script>

<!-- END THIS PAGE PLUGINS-->
