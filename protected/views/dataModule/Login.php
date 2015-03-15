<?php if(isset($my_message)): ?>
			
		<script>
			$(document).ready(function(){
				
				noty({
                        text: '<?php echo $my_message ?>',
                        layout: 'topRight',
                        type: 'error',
                        
                   });
			});
		</script>
		<?php endif; ?>
<div class="login-container login-v2">

	<div class="login-box animated fadeInDown">
		<div class="login-body">
			<div class="login-title"><strong>  Welcome</strong>, Please login.</div>
			<form class="form-horizontal" action="index.php?r=DataModule/Login" method="post" >

				<div class="form-group">
					<div class="col-md-12">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="fa fa-user"></span>
							</div>
							<input type="text" class="form-control" placeholder="Username"  name="Login[username]"/>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-12">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="fa fa-lock"></span>
							</div>                                
							<input type="password" class="form-control" placeholder="Password"  name="Login[password]"/>
						</div>
					</div>
				</div>

				
				<div class="form-group">
					<div class="col-md-6">
						<a href="#">Forgot your password?</a>
					</div>          
					<div class="col-md-6 text-right">
						<a href="index.php?r=DataModule/AddStudent">Create an account</a>
					</div>              
				</div>

				<div class="form-group">
					<div class="col-md-12">
						<button class="btn btn-primary btn-lg btn-block">Login</button>
					</div>
				</div>
			</form>
		</div>
	</div>

</div>




<!-- THIS PAGE PLUGINS -->
<script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>

<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-file-input.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
<!-- END THIS PAGE PLUGINS -->
