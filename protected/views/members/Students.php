<div class="page-content-wrap">

	<div class="row">
		<div class="col-md-12">

			<!-- START DEFAULT DATATABLE -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Students Table</h3>
					<ul class="panel-controls">
						<li>
							<a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a>
						</li>
					</ul>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table datatable">
							<thead>
								<tr>
									<th style="text-align: center;">First Name</th>
									<th style="text-align: center;">Second Name</th>
									<th style="text-align: center;">Date of Birth</th>
									<th style="text-align: center;">Gender</th>
									<th style="text-align: center;">Phone</th>
									<th style="text-align: center;">Country</th>
									<th style="text-align: center;">Price/Hour</th>
									<th style="text-align: center;">Teacher</th>
									<th style="text-align: center;">Time</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$j = 0;
									foreach ($results as $request) {
										if(Yii::app()->user->type == "Teacher"){
											if(Yii::app()->user->id != $request -> teacher -> id)
												continue;	
											
										}
										$j++;
										 ?>
										 
									
								<tr>
									<td><?php echo $request -> student -> first_name; ?></td>
									<td><?php echo $request -> student -> last_name; ?></td>
									<td><?php echo $request -> student -> date_of_birth; ?></td>
									<td><?php if($request->student->gender == 0 ): ?>Male<?php else: ?>Female <?php endif; ?></td>
									<td><?php echo $request -> student -> phone_no; ?></td>
									<td><?php echo $request -> student -> country; ?></td>
									<td><?php echo $request -> cost; ?>
										
										<?php if($request->currency_id == 0 ): ?> GBP<?php elseif($request->currency_id == 1): ?> EUR <?php else: ?> EGP <?php endif; ?>
										
									</td>
									<td><?php echo $request -> teacher -> first_name." ".$request -> teacher -> last_name; ?></td>
									<td>
									<button href="#myModal<?php echo $j; ?>" id="openBtn" data-toggle="modal" class="btn btn-primary">
											<span class="fa fa-calendar" style="color: #fff;"></span>
										</button>
										<div class="modal fade" id="myModal<?php echo $j; ?>" style="z-index:0;">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
															×
														</button>
														<h3 class="modal-title">Preferred Times</h3>
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
																	<?php $counter = -1; foreach ($request->lessonRequestTimeSlots as $lessonTimeSlot) { 
																		$counter++;
																		?>
																		
																	
																	<tr>
																		<td>
																		<select class="form-control select" name="LessonRequest[day][]" form="myform<?php echo $j; ?>">
																			<?php 
																			$days = array("Saturday" , "Sunday" , "Monday" , "Tuesday" , "Wednesday" , "Thursday" , "Friday");
																			for($i=0;$i<7;$i++): ?>
																				<?php if($lessonTimeSlot->day == $i): ?>
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
																			<?php $lessonTimeSlot->from  = date("g:i a", strtotime($lessonTimeSlot->from));
																			$lessonTimeSlot->to = date("g:i a", strtotime($lessonTimeSlot->to)); ?>
																			<input type="text" class="form-control timepicker" form="myform<?php echo $j; ?>" name="LessonRequest[from][]" value="<?php echo $lessonTimeSlot->from ?>" />
																		</div></td>
																		<td>
																		<div class="input-group bootstrap-timepicker">
																			<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
																			<input type="text" class="form-control timepicker" form="myform<?php echo $j; ?>" name="LessonRequest[to][]" value="<?php echo $lessonTimeSlot->to ?>" />
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
