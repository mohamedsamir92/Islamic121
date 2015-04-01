<div class="page-content-wrap">

	<div class="row">
		<div class="col-md-12">

			<!-- START SIMPLE DATATABLE -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Teachers Table</h3>
					<ul class="panel-controls">
						<li>
							<a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a>
						</li>
					</ul>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table datatable_simple">
							<thead>
								<tr>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Age</th>
									<th>Gender</th>
									<th>Phone</th>
									<th>Email</th>
									<th>Country</th>
									<th>City</th>
									<th>Working Hours</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$j = 0;
									foreach ($results as $teacher) {
										$j++;
										 ?>
								
								<tr>
									<td><?php echo $teacher -> first_name ; ?></td>
									<td><?php echo $teacher -> last_name ; ?></td>
									<?php

										$date = new DateTime($teacher -> date_of_birth);
										$now = new DateTime();
										$interval = $now -> diff($date);
										$age = $interval -> y;
										//echo "Age is:" . $age;
									?>

									<td><?php echo $age ; ?></td>
									<td><?php if($teacher->gender == 0 ): ?>Male<?php else: ?>Female <?php endif; ?></td>
									<td><?php echo $teacher -> phone_no; ?></td>
									<td><?php echo $teacher -> email; ?></td>
									<td><?php echo $teacher -> country; ?></td>
									<td><?php echo $teacher -> city; ?></td>
									<td>
									<div class="btn-group">
										<a href="index.php?r=members/showTeacherCalendar&id=<?php echo $teacher->id; ?>" class="btn btn-default btn-condensed" data-toggle="modal" >
											<i class="fa fa-calendar"></i>
										</a>
	
										<a href="index.php?r=members/editTeacher&id=<?php echo $teacher->id; ?>" data-toggle="modal" class="btn btn-default btn-condensed">
											<i class="fa fa-pencil"></i>
										</a>
										<a href="index.php?r=members/removeTeacher&id=<?php echo $teacher -> id; ?>" class="btn btn-danger btn-condensed">
											<i class="fa fa-times"></i>
										</a>
										
									</div>
										<div class="modal fade" id="myModal<?php echo $j; ?>" style="z-index:0;">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
															×
														</button>
														<h3 class="modal-title">Working times</h3>
													</div>
													<div class="modal-body">
														<div class="table-responsive">
															<table class="table" id="tblGrid">
																<thead id="tblHead">
																	<tr>
																		<th>Day</th>
																		<th style="min-width: 150px;">From</th>
																		<th style="min-width: 150px;">To</th>
																	</tr>
																</thead>
																<tbody>
																	<?php $counter = -1; foreach ($teacher->teacherTimeSlots as $slot) { 
																		$counter++;
																		?>
																		
																	
																	<tr>
																		<td>
																		<select class="form-control select">
																			<?php 
																			$days = array("Saturday" , "Sunday" , "Monday" , "Tuesday" , "Wednesday" , "Thursday" , "Friday");
																			for($i=0;$i<7;$i++): ?>
																				<?php if($slot->day == $i): ?>
																					<option selected><?php echo $days[$i]; ?></option>
																					<?php else: ?>
																					<option><?php echo $days[$i]; ?></option>
																					<?php endif; ?>
																			<?php endfor; ?>
																		</select>
																		</td>
																		<td>
																		<div class="input-group bootstrap-timepicker">
																			<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
																			<?php $slot->from  = date("g:i a", strtotime($slot->from));
																			$slot->to = date("g:i a", strtotime($slot->to)); ?>
																			<input type="text" class="form-control timepicker" value="<?php echo $slot->from ?>" />
																		</div></td>
																		<td>
																		<div class="input-group bootstrap-timepicker">
																			<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
																			<input type="text" class="form-control timepicker" value="<?php echo $slot->to ?>" />
																		</div></td>
																	</tr>
																	
																	<?php
																	 
																	 } ?>
																</tbody>
															</table>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">
															Close
														</button>
													</div>

												</div><!-- /.modal-content -->
											</div><!-- /.modal-dialog -->
										</div><!-- /.modal -->
										</td>

								</tr>

								<?php
							
							//break;
							} ?>
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- END SIMPLE DATATABLE -->

		</div>
	</div>

</div>

<!-- START THIS PAGE PLUGINS-->
<script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="js/plugins/scrolltotop/scrolltopcontrol.js"></script>

<script type="text/javascript" src="js/plugins/morris/raphael-min.js"></script>
<script type="text/javascript" src="js/plugins/morris/morris.min.js"></script>
<script type="text/javascript" src="js/plugins/rickshaw/d3.v3.js"></script>
<script type="text/javascript" src="js/plugins/rickshaw/rickshaw.min.js"></script>
<script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
<script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>
<script type='text/javascript' src='js/plugins/bootstrap/bootstrap-datepicker.js'></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>

<script type="text/javascript" src="js/plugins/owl/owl.carousel.min.js"></script>

<script type="text/javascript" src="js/plugins/moment.min.js"></script>
<script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>

<!-- END THIS PAGE PLUGINS-->


