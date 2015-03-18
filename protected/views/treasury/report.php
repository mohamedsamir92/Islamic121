<div class="page-content-wrap">
	<div class="row">
		<div class="col-md-12">

			<!-- START DEFAULT DATATABLE -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Treasury Report</h3>
				</div>

				<div class="panel-body">

					<form action="#" class="form-horizontal">
						<div class="form-group">

							<label class="col-md-1 control-label">Currency</label>
							<div class="col-md-3">
								<select id="currency" class="form-control select">
									<option value="1">Egyptian Pound (EGP)</option>
									<option value="3">Pound Sterling (£)</option>
									<option value="4">Euro (€)</option>
									<option value="2">United States Dollar ($)</option>
								</select>
							</div>

							<label class="col-md-1 control-label">From</label>
							<div class="col-md-3">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-calendar"></span></span>
									<input id="from" type="text" class="form-control datepicker" value="2015-03-13">
								</div>
							</div>

							<label class="col-md-1 control-label">To</label>
							<div class="col-md-3">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-calendar"></span></span>
									<input id="to" type="text" class="form-control datepicker" value="2015-03-13">
								</div>
							</div>

						</div>
					</form>

				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">

			<!-- START DEFAULT DATATABLE -->
			<div class="panel panel-default">

				<div class="panel-body">
					<div class="table-responsive">
						<table id="report-table" class="table datatable display">
							<thead>
								<tr>
									<th width="20%" style="text-align: center;">Date</th>
									<th width="20%" style="text-align: center;">From / To</th>
									<th width="30%" style="text-align: center;">Notes</th>
									<th width="10%" style="text-align: center;">Type</th>
									<th width="10%" style="text-align: center;">Value</th>
									<th width="10%" style="text-align: center;">Total</th>
								</tr>
							</thead>
							<tbody>
								<!--<tr>
								<td>-</td>
								<td>-</td>
								<td>Period Start Value</td>
								<td>-</td>
								<td>-</td>
								<td>15000</td>
								</tr>
								<tr>
								<td>13-03-2015</td>
								<td>Mohammad Shaker</td>
								<td>Credits for lessons</td>
								<td>In</td>
								<td>500</td>
								<td>15500</td>
								</tr>
								<tr>
								<td>14-03-2015</td>
								<td>Other</td>
								<td>Salaries</td>
								<td>Out</td>
								<td>6500</td>
								<td>9000</td>
								</tr>
								-->
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- END SIMPLE DATATABLE -->

		</div>
	</div>

</div>
<!-- END PAGE CONTENT WRAPPER -->

<!-- START THIS PAGE PLUGINS-->
<script type='text/javascript' src='js/treasury.js'></script>
    
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
