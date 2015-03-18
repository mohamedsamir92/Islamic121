<?php if(isset($my_message)): ?>
			
		<script>
			$(document).ready(function(){
				
				noty({
                        text: '<?php echo $my_message ?>',
                        layout: 'topRight',
                        type: 'error',
                        timeout: 5000,
                        
                   });
			});
		</script>
		<?php endif; ?>

<!-- PAGE CONTENT WRAPPER -->
            <div class="page-content-wrap">

                <div class="row">
                    <div class="col-md-12">

                        <form class="form-horizontal" method="post" action="index.php?r=Treasury/paper">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Treasury Paper</h3>
                                </div>
                                <div class="panel-body">                                                                        

                                    <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Date</label>
                                        <div class="col-md-6 col-xs-12">                                            
                                            <div style=" z-index: 102;position: relative;" class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                                <input name="date" type="text" class="form-control datepicker" value="2015-03-15">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Paper Type</label>
                                        <div class="col-md-6 col-xs-12">
                                            <div style=" z-index: 101;position: relative;" class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-compress"></span></span>
                                                <select name="paper_type" class="form-control select">
                                                    <option value="1">In</option>
                                                    <option value="-1">Out</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">From</label>
                                        <div class="col-md-2 col-xs-12">                                            
                                            <div style=" z-index: 100;position: relative;" class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                                <select  id="user-type" name="type" class="form-control select">
                                                    <option value="0">User</option>
                                                    <option value="1">Others</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="user-name" class="col-md-4 col-xs-12">                                            
                                            <div class="row">
	                                            <div class="col-md-11">
		                                            <div class="input-group">
		                                                <span class="input-group-addon"><span class="fa fa-info"></span></span>
		                                                <input name="username" id="user-name-search" class="form-control" />
		                                            	
		                                            </div>
	                                            </div>
	                                            <div class="col-md-1" id="user-name-status"></div> 
                                            </div>   
                                        </div>
                                    </div>

                                    <div class="form-group">                                        
                                        <label class="col-md-3 col-xs-12 control-label">Value</label>

                                        <div class="col-md-2 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-money"></span></span>
                                                <select name="currency_id" id="currency" class="form-control select">
                                                    <option value="2">$</option>
                                                    <option value="1">EGP</option>
                                                    <option value="3">GBP</option>
                                                    <option value="4">Euro</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-money"></span></span>
                                                <input name="value" type="number" class="form-control" required=""/>
                                            </div>
                                        </div>

                                        
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Notes</label>
                                        <div class="col-md-6 col-xs-12">                                            
                                            <textarea name="notes" class="form-control" rows="3" required=""></textarea>
                                        </div>
                                    </div>

                                </div>
                                <div class="panel-footer">
                                    <button type="reset" class="btn btn-default">Clear Form</button>                                    
                                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>                    

            </div>
            <!-- END PAGE CONTENT WRAPPER -->
            
<!-- THIS PAGE PLUGINS -->
	<script type='text/javascript' src='js/treasury.js'></script>
    <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
    <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>

    <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-datepicker.js"></script>                
    <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-file-input.js"></script>
    <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>
    <script type="text/javascript" src="js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
    <!-- END THIS PAGE PLUGINS -->       
