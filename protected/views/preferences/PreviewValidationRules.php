<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
	<div class="row">
		<div class="col-md-12">

			<?php 
			if ($is_insert) {
				if ($insert_success) {
					?>
					<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<?= $message ?>
					</div>
					<?php
				} else {
					?>
					<div class="alert alert-danger" role="alert">
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<?= $message ?>
					</div>
					<?php
				}
			}
			?>

			<!-- START DEFAULT DATATABLE -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Student Validation Rules &#8239;&#8239;</h3>
					<button href="#AddRule" id="addRuleBtn" data-toggle="modal" class="btn btn-default btn-condensed"><i class="fa fa-plus"> Add New Rule</i></button>
					<ul class="panel-controls">
						<li>
							
							<a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a>

						</li>
					</ul>
				</div>
				<div class="panel-body">
					<table class="table datatable">
						<thead>
							<tr>
								<th width="20%" style="text-align: center;">Lesson Type</th>
								<th width="15%" style="text-align: center;">Gender</th>
								<th width="20%" style="text-align: center;">Day</th>
								<th width="15%" style="text-align: center;">From</th>
								<th width="15%" style="text-align: center;">To</th>
								<th width="15%" style="text-align: center;">Actions</th>

							</tr>
						</thead>
						<tbody>
							<?php
							$days = array("Saturday" , "Sunday" , "Monday" , "Tuesday" , "Wednesday" , "Thursday" , "Friday");
							$index = 0;
							foreach ($validation_rules as $rule) {
								?>
								<tr>
									<td><?= $rule->lessonType->name ?></td>
									<td><?= $rule->gender ? "Female" : "Male" ?></td>
									<td><?= $days[$rule->day] ?></td>
									<td><?= $rule->from ?></td>
									<td><?= $rule->to ?></td>
									<td>
										<div class="btn-group">
											<button href="#deleteIdDialog<?= $index ?>" data-toggle="modal" class="btn btn-danger btn-condensed"><i class="fa fa-times"></i></button>
										</div>
									</td>
								</tr>


								<!-- Delete Person Confirmation -->
								<div id="deleteIdDialog<?= $index ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<!-- Modal Header -->
											<div class="modal-header text-center">
												<h2 class="modal-title"><i class="fa fa-times"></i> Delete</h2>
											</div>
											<!-- END Modal Header -->

											<!-- Modal Body -->
											<div class="modal-body">
												<form action="index.php?r=Preferences/PreviewValidationRules" method="POST" enctype="multipart/form-data" class="form-horizontal form-bordered">
													<fieldset>
														<div class="form-group">
															<div class="col-md-12">
															<p class="form-control-static">Are you sure you want to delete this rule?</p>
															</div>
														</div>
													</fieldset>

													<input type="number" name="deleteId" value="<?= $rule->id ?>" hidden="true"/>

													<div class="form-group form-actions">
														<div class="col-xs-12 text-right">
															<input type="submit" class="btn btn-sm btn-danger" value="Yes">
															<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">No</button>
														</div>
													</div>
												</form>
											</div>
											<!-- END Modal Body -->
										</div>
									</div>
								</div>
								<!-- END Person Confirmation -->


								<?php
								$index++;
							}
							?>
						</tbody>

					</table>
				</div>
			</div>
			<!-- END DEFAULT DATATABLE -->
		</div>
	</div>

</div>
<!-- END PAGE CONTENT WRAPPER -->




<div class="modal fade" id="AddRule">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					×
				</button>
				<h3 class="modal-title">Add Validation Rule</h3>
			</div>
			<form class="form-horizontal" action="index.php?r=Preferences/PreviewValidationRules" method="post" enctype="multipart/form-data">

				<div class="modal-body">

					<div class="form-group">
						<label class="col-md-3 col-xs-12 control-label">Gender</label>
						<div class="col-md-9 col-xs-12">
							<div class="input-group" style="z-index: 999">
								<span class="input-group-addon"><span class="fa fa-group"></span></span>
								<select id="gender" class="form-control select" name="ValidationRules[gender]">
									<option value="0">Male</option>
									<option value="1">Female</option>
								</select>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 col-xs-12 control-label">Day</label>
						<div class="col-md-9 col-xs-12">
							<div class="input-group" style="z-index: 998">
								<span class="input-group-addon"><span class="fa fa-group"></span></span>
								<select id="day" class="form-control select" name="ValidationRules[day]">
									<?php
									$index = 0;
									foreach ($days as $day) {
										?>
										<option value="<?= $index ?>"><?= $day ?></option>
										<?php
										$index++;
									}
									?>
								</select>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 col-xs-12 control-label">Lesson</label>
						<div class="col-md-9 col-xs-12">
							<div class="input-group" style="z-index: 997">
								<span class="input-group-addon"><span class="fa fa-group"></span></span>
								<select id="lesson_type" class="form-control select" name="ValidationRules[lesson_type]">
									<?php
									foreach ($lesson_types as $lesson) {
										?>
										<option value="<?= $lesson->id ?>"><?= $lesson->name ?></option>
										<?php
									}
									?>
								</select>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 col-xs-12 control-label">From</label>
						<div class="col-md-9 col-xs-12">
							<div class="input-group" style="z-index: 996">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<input type="text" class="form-control timepicker" name="ValidationRules[from]" />
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 col-xs-12 control-label">From</label>
						<div class="col-md-9 col-xs-12">
							<div class="input-group" style="z-index: 996">
								<div class="input-group bootstrap-timepicker">
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
									<input type="text" class="form-control timepicker" name="ValidationRules[to]" />
								</div>
							</div>
						</div>
					</div>


				</div>


				<div class="modal-footer">
					<button  type="submit" class="btn btn-primary">Save</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>

			</form>

		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<!-- START THIS PAGE PLUGINS-->
<script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="js/plugins/scrolltotop/scrolltopcontrol.js"></script>

<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>

<script type="text/javascript" src="js/plugins/morris/raphael-min.js"></script>
<script type="text/javascript" src="js/plugins/morris/morris.min.js"></script>
<script type="text/javascript" src="js/plugins/rickshaw/d3.v3.js"></script>
<script type="text/javascript" src="js/plugins/rickshaw/rickshaw.min.js"></script>
<script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
<script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>
<script type='text/javascript' src='js/plugins/bootstrap/bootstrap-datepicker.js'></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="js/plugins/owl/owl.carousel.min.js"></script>
<script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="js/plugins/moment.min.js"></script>
<script type="text/javascript" src="js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
<!-- END THIS PAGE PLUGINS-->
