<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<!-- META SECTION -->
		<title>Add Student</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<link rel="icon" href="favicon.ico" type="image/x-icon" />
		<!-- END META SECTION -->

		<!-- CSS INCLUDE -->
		<link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
		<link rel="stylesheet" type="text/css" id="theme" href="css/style.css"/>
		
		<!-- EOF CSS INCLUDE -->
		<!-- START PLUGINS -->
		<script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
		<script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
		<script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>
		<!-- END PLUGINS -->

	</head>

	<body>

		<?php if(!isset(Yii::app() -> user -> id)): ?>
		<?php echo $content; ?>
		<?php else: ?>
	
		<!-- START PAGE CONTAINER -->
		<div class="page-container">

			<!-- START PAGE SIDEBAR -->
			<div class="page-sidebar">
				<!-- START X-NAVIGATION -->
				<ul class="x-navigation">
					<li class="xn-logo">
						<a href="index.html">121IslamOnline</a>
						<a href="#" class="x-navigation-control"></a>
					</li>
					<li class="xn-profile">
						<a href="#" class="profile-mini"> <img src="<?php echo  Yii::app()->request->baseUrl . '/images/' . Yii::app() -> user -> image ?>" alt="<?php echo Yii::app() -> user -> first_name; ?>" /> </a>
						<div class="profile">
							<div class="profile-image">
								<img src="<?php echo  Yii::app()->request->baseUrl . '/images/' . Yii::app() -> user -> image ?>" alt="<?php echo Yii::app() -> user -> first_name; ?>"/>
							</div>
							<div class="profile-data">
								<div class="profile-data-name">
									<?php echo Yii::app()->user-> first_name . " " . Yii::app()->user->last_name; ?>
								</div>
								<div class="profile-data-title">
									<?php echo Yii::app()->user->type; ?>
								</div>
							</div>
							<div class="profile-controls">
								<a href="pages-profile.html" class="profile-control-left"><span class="fa fa-info"></span></a>
								<a href="pages-messages.html" class="profile-control-right"><span class="fa fa-envelope"></span></a>
							</div>
						</div>
					</li>
					<li class="xn-title">
						Menu
					</li>
					<li class="active">
						<a href="index.html"><span class="fa fa-desktop"></span><span class="xn-text">Home</span></span></a>
					</li>
					<li>
						<a href="<?php echo Yii::app()->request->baseUrl ?>/index.php?r=Requests/PendingRequests"><span class="fa fa-bell-o"></span><span class="xn-text">New Requests</span></a>
					</li>
					<li>
						<a href="<?php echo Yii::app()->request->baseUrl ?>/index.php?r=Calendar/CalendarView"><span class="fa fa-calendar"></span><span class="xn-text">Calendar</span></a>
					</li>
					<li>
						<a href="#"><span class="fa fa-comments"></span><span class="xn-text">Messages</span></a>
					</li>
					<li class="xn-openable">
						<a href="#"><span class="fa fa-group"></span><span class="xn-text">Members</span></a>
						<ul>
							<li>
								<a href="<?php echo Yii::app()->request->baseUrl ?>/index.php?r=Members/Students"><span class="fa fa-user"></span><span class="xn-text">Students</span></a>
							</li>
							<li>
								<a href="<?php echo Yii::app()->request->baseUrl ?>/index.php?r=Members/Teachers"><span class="fa fa-briefcase"></span><span class="xn-text">Teachers</span></a>
							</li>
						</ul>
					</li>
					<li>
						<a href="<?php echo Yii::app()->request->baseUrl ?>/index.php?r=Preview/Preview<?php echo Yii::app()->user->type ?>"><span class="fa fa-user"></span><span class="xn-text">My Profile</span></a>
					</li>
					<li>
						<a href="<?php echo Yii::app()->request->baseUrl ?>/index.php?r=Edit/Edit<?php echo Yii::app()->user->type ?>"><span class="fa fa-edit"></span><span class="xn-text">Edit Profile</span></a>
					</li>
					<li>
						<a href="#"><span class="fa fa-money"></span><span class="xn-text">Invoice</span></a>
					</li>
					<li>
						<a href="#"><span class="glyphicon glyphicon-stats"></span><span class="xn-text">Reports</span></a>
					</li>
					<?php if(Yii::app()->user->type == "Admin"): ?>
					<li class="xn-openable">
						<a href="#"><span class="fa fa-plus"></span><span class="xn-text">Add Member</span></a>
						<ul>
							<li>
								<a href="<?php echo Yii::app()->request->baseUrl ?>/index.php?r=DataModule/AddAdmin"><span class="fa fa-user"></span><span class="xn-text">Add Admin</span></a>
							</li>
							<li>
								<a href="<?php echo Yii::app()->request->baseUrl ?>/index.php?r=DataModule/AddTeacher"><span class="fa fa-briefcase"></span><span class="xn-text">Add Teacher</span></a>
							</li>
						</ul>
					</li>
					<?php endif; ?>
				</ul>
				<!-- END X-NAVIGATION -->
			</div>
			<!-- END PAGE SIDEBAR -->

			<!-- PAGE CONTENT -->
			<div class="page-content">

				<!-- START X-NAVIGATION VERTICAL -->
				<ul class="x-navigation x-navigation-horizontal x-navigation-panel">
					<!-- TOGGLE NAVIGATION -->
					<li class="xn-icon-button">
						<a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
					</li>
					<!-- END TOGGLE NAVIGATION -->
					<!-- SEARCH -->
					<li class="xn-search">
						<form role="form">
							<input type="text" name="search" placeholder="Search..."/>
						</form>
					</li>
					<!-- END SEARCH -->
					<!-- POWER OFF -->
					<li class="xn-icon-button pull-right last">
						<a href="#"><span class="fa fa-power-off"></span></a>
						<ul class="xn-drop-left animated zoomIn">
							<li>
								<a href="#"><span class="fa fa-lock"></span> Lock Screen</a>
							</li>
							<li>
								<a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span> Sign Out</a>
							</li>
						</ul>
					</li>
					<!-- END POWER OFF -->
					<!-- MESSAGES -->
					<li class="xn-icon-button pull-right">
						<a href="#"><span class="fa fa-comments"></span></a>
						<div class="informer informer-danger">
							4
						</div>
						<div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
							<div class="panel-heading">
								<h3 class="panel-title"><span class="fa fa-comments"></span> Messages</h3>
								<div class="pull-right">
									<span class="label label-danger">4 new</span>
								</div>
							</div>
							<div class="panel-body list-group list-group-contacts scroll" style="height: 200px;">
								<a href="#" class="list-group-item"> <div class="list-group-status status-online"></div> <img src="assets/images/users/user2.jpg" class="pull-left" alt="John Doe"/> <span class="contacts-title">John Doe</span>
								<p>
									Praesent placerat tellus id augue condimentum
								</p> </a>
								<a href="#" class="list-group-item"> <div class="list-group-status status-away"></div> <img src="assets/images/users/user.jpg" class="pull-left" alt="Dmitry Ivaniuk"/> <span class="contacts-title">Dmitry Ivaniuk</span>
								<p>
									Donec risus sapien, sagittis et magna quis
								</p> </a>
								<a href="#" class="list-group-item"> <div class="list-group-status status-away"></div> <img src="assets/images/users/user3.jpg" class="pull-left" alt="Nadia Ali"/> <span class="contacts-title">Nadia Ali</span>
								<p>
									Mauris vel eros ut nunc rhoncus cursus sed
								</p> </a>
								<a href="#" class="list-group-item"> <div class="list-group-status status-offline"></div> <img src="assets/images/users/user6.jpg" class="pull-left" alt="Darth Vader"/> <span class="contacts-title">Darth Vader</span>
								<p>
									I want my money back!
								</p> </a>
							</div>
							<div class="panel-footer text-center">
								<a href="#">Show all messages</a>
							</div>
						</div>
					</li>
					<!-- END MESSAGES -->
					<!-- TASKS -->
					<li class="xn-icon-button pull-right">
						<a href="#"><span class="fa fa-user"></span></a>
						<div class="informer informer-warning">
							3
						</div>
						<div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
							<div class="panel-heading">
								<h3 class="panel-title"><span class="fa fa-tasks"></span> Notifications </h3>
								<div class="pull-right">
									<span class="label label-warning">3 Absent</span>
								</div>
							</div>
							<div class="panel-body list-group scroll" style="height: 200px;">
								<a class="list-group-item" href="#"> <strong>Moaz Al Masry</strong>
								<br>
								<small>Moaz-masry@gmail.com</small> </a>
								<a class="list-group-item" href="#"> <strong>Moaz Al Masry</strong>
								<br>
								<small>Moaz-masry@gmail.com</small> </a>
								<a class="list-group-item" href="#"> <strong>Moaz Al Masry</strong>
								<br>
								<small>Moaz-masry@gmail.com</small> </a>
							</div>
							<div class="panel-footer text-center">
								<a href="#">Show all Notifications</a>
							</div>
						</div>
					</li>
					<!-- END TASKS -->
					<!-- LANG BAR -->
					<li class="xn-icon-button pull-right">
						<a href="#"><span class="flag flag-gb"></span></a>
						<ul class="xn-drop-left xn-drop-white animated zoomIn">
							<li>
								<a href="#"><span class="flag flag-gb"></span> English</a>
							</li>
							<li>
								<a href="index-ar.html"><span class="flag flag-sa"></span> اللغة العربية</a>
							</li>
						</ul>
					</li>
					<!-- END LANG BAR -->
				</ul>
				<!-- END X-NAVIGATION VERTICAL -->

				<!-- START BREADCRUMB -->
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a>
					</li>
					<li>
						<a href="#">Forms Stuff</a>
					</li>
					<li>
						<a href="#">Form Layout</a>
					</li>
					<li class="active">
						One Column
					</li>
				</ul>
				<!-- END BREADCRUMB -->

				<?php echo $content; ?>
				<!-- END PAGE CONTENT WRAPPER -->
			</div>
			<!-- END PAGE CONTENT -->
		</div>
		<!-- END PAGE CONTAINER -->

		<!-- MESSAGE BOX-->
		<div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
			<div class="mb-container">
				<div class="mb-middle">
					<div class="mb-title">
						<span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?
					</div>
					<div class="mb-content">
						<p>
							Are you sure you want to log out?
						</p>
						<p>
							Press No if youwant to continue work. Press Yes to logout current user.
						</p>
					</div>
					<div class="mb-footer">
						<div class="pull-right">
							<a href="<?php echo Yii::app()->request->baseUrl ?>/index.php?r=DataModule/Logout" class="btn btn-success btn-lg">Yes</a>
							<button class="btn btn-default btn-lg mb-control-close">
								No
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END MESSAGE BOX-->

		<?php endif; ?>
		<!-- START PRELOADS -->
		<audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
		<audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
		<!-- END PRELOADS -->

		<!-- START SCRIPTS -->

		<!-- START TEMPLATE -->
		<script type="text/javascript" src="js/plugins.js"></script>
		<script type="text/javascript" src="js/actions.js"></script>
		<!-- END TEMPLATE -->
		<!-- END SCRIPTS -->
	</body>
</html>
