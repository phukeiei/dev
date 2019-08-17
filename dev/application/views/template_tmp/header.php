<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--<title>SMartEcoSoftbuU</title>-->
	<title>Information System Engineering Research Laboratory</title> <!-- edit by naruecha 17/03/2017 -->
	
	<!--link rel="icon" type="image/png" href="<?php echo base_url();?>backend/assets/img/SME_logo_ver7.png"-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="description" content="Avenxo Admin Theme">
    <meta name="author" content="ISERL-INFORMATICS-BUU">

<link type="text/css" href="<?php echo base_url();?>backend/assets/plugins/form-select2/select2.css" rel="stylesheet">
<link type="text/css" href="<?php echo base_url();?>backend/assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">        <!-- Font Awesome -->
<link type="text/css" href="<?php echo base_url();?>backend/assets/fonts/themify-icons/themify-icons.css" rel="stylesheet">              <!-- Themify Icons -->
<link type="text/css" href="<?php echo base_url();?>backend/assets/css/styles.css" rel="stylesheet">                                     <!-- Core CSS with all styles -->
<link type="text/css" href="<?php echo base_url();?>backend/assets/plugins/form-multiselect/css/multi-select.css" rel="stylesheet">           <!-- Multiselect -->
<link type="text/css" href="<?php echo base_url();?>backend/assets/plugins/form-fseditor/fseditor.css" rel="stylesheet">                      <!-- FullScreen Editor -->
<link type="text/css" href="<?php echo base_url();?>backend/assets/plugins/bootstrap-tokenfield/css/bootstrap-tokenfield.css" rel="stylesheet">   <!-- Tokenfield -->

<link type="text/css" href="<?php echo base_url();?>backend/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet"> <!-- Touchspin -->

<link type="text/css" href="<?php echo base_url();?>backend/assets/plugins/iCheck/skins/minimal/_all.css" rel="stylesheet">                   <!-- Custom Checkboxes / iCheck -->
<link type="text/css" href="<?php echo base_url();?>backend/assets/plugins/iCheck/skins/flat/_all.css" rel="stylesheet">
<link type="text/css" href="<?php echo base_url();?>backend/assets/plugins/iCheck/skins/square/_all.css" rel="stylesheet">

<link type="text/css" href="<?php echo base_url();?>backend/assets/plugins/card/lib/css/card.css" rel="stylesheet">
<link type="text/css" href="<?php echo base_url();?>backend/assets/plugins/codeprettifier/prettify.css" rel="stylesheet">                <!-- Code Prettifier -->
<link type="text/css" href="<?php echo base_url();?>backend/assets/plugins/iCheck/skins/minimal/blue.css" rel="stylesheet">              <!-- iCheck -->
<link type="text/css" href="<?php echo base_url();?>backend/assets/plugins/pines-notify/pnotify.css" rel="stylesheet"> 		<!-- PNotify -->


<link type="text/css" href="<?php echo base_url();?>backend/assets/plugins/fullcalendar/fullcalendar.css" rel="stylesheet"> 						<!-- FullCalendar -->
<link type="text/css" href="<?php echo base_url();?>backend/assets/plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"> 			<!-- jVectorMap -->
<link type="text/css" href="<?php echo base_url();?>backend/assets/plugins/switchery/switchery.css" rel="stylesheet">   							<!-- Switchery -->

<link type="text/css" href="<?php echo base_url();?>backend/assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
<link type="text/css" href="<?php echo base_url();?>backend/assets/plugins/datatables/dataTables.themify.css" rel="stylesheet">
<link type="text/css" href="<?php echo base_url();?>backend/assets/plugins/form-daterangepicker/daterangepicker-bs3.css" rel="stylesheet">    <!-- DateRangePicker -->

<link type="text/css" href="<?php echo base_url();?>backend/assets/plugins/fancybox/jquery.fancybox.css" rel="stylesheet"> 		<!-- fancy -->

<!-- tui calendar -->
<link rel="stylesheet" type="text/css"
      href="<?php echo base_url(); ?>backend/plugins/tui_calendar/tui-time-picker.css"/>
<link rel="stylesheet" type="text/css"
      href="<?php echo base_url(); ?>backend/plugins/tui_calendar/tui-date-picker.css"/>
<link rel="stylesheet" type="text/css"
      href="<?php echo base_url(); ?>backend/plugins/tui_calendar/tui-calendar.css"/>
<link rel="stylesheet" type="text/css"
      href="<?php echo base_url(); ?>backend/plugins/tui_calendar/css/default.css"/>
<link rel="stylesheet" type="text/css"
      href="<?php echo base_url(); ?>backend/plugins/tui_calendar/css/icons.css"/>

<style>
.table.table_iserl > tbody > tr > td {
    text-align: center;
}
.note-editable{
	background-color: white !important;
}
.note-editor {
	text-align: left;
}
</style>
<link type="text/css" href="<?php echo base_url();?>backend/assets/plugins/summernote/dist/summernote.css" rel="stylesheet"> 	

</head>

    <body class="animated-content">

        <header id="topnav" class="navbar navbar-default" role="banner" style="background:<?php echo $tem['ColorHeadTop']?>;">

			<div class="logo-area">
				<span id="trigger-sidebar" class="toolbar-trigger toolbar-icon-bg">
					<a data-toggle="tooltips" data-placement="right" title="Toggle Sidebar">
						<span class="icon-bg">
							<i class="ti ti-menu"></i>
						</span>
					</a>
				</span>
				<?php
					$path = $this->config->item('uploads_url');
					$pathString = $path."header&image=".$tem['HeadIcon'];
				?>
				<!--<a class="navbar-brand" >Avenxo</a>-->
				<?php //echo $pathString; ?>
				<img style="height:58px;" src="<?php echo $pathString; ?>">

				<!--<div class="toolbar-icon-bg hidden-xs" id="toolbar-search">
					<div class="input-group">
						<span class="input-group-btn"><button class="btn" type="button"><i class="ti ti-search"></i></button></span>
						<input type="text" class="form-control" placeholder="Search...">
						<span class="input-group-btn"><button class="btn" type="button"><i class="ti ti-close"></i></button></span>
					</div>
				</div>-->

			</div><!-- logo-area -->
			<!--<div style="margin-top:10px;color:white">
				<span align="" style="margin-left:900px;color:white">
					<?php //echo $this->session->userdata('UsName');?>
				</span>
				<br>
				<span style="margin-left:850px;color:white">
					<?php //echo $this->session->userdata('GpName')." ".$this->session->userdata('dpName'); ?>
				</span>
			</div>-->
			<ul class="nav navbar-nav toolbar pull-right">
				<!--<li class="toolbar-icon-bg visible-xs-block" id="trigger-toolbar-search">
					<a href="#"><span class="icon-bg"><i class="ti ti-search"></i></span></a>
				</li>

				<li class="toolbar-icon-bg hidden-xs">
					<a href="#"><span class="icon-bg"><i class="ti ti-world"></i></span></i></a>
				</li>

				<li class="toolbar-icon-bg hidden-xs">
					<a href="#"><span class="icon-bg"><i class="ti ti-view-grid"></i></span></i></a>
				</li>

				<li class="toolbar-icon-bg hidden-xs" id="trigger-fullscreen">
					<a href="#" class="toggle-fullscreen"><span class="icon-bg"><i class="ti ti-fullscreen"></i></span></i></a>
				</li>

				<li class="dropdown toolbar-icon-bg hidden-xs">
					<a href="#" class="hasnotifications dropdown-toggle" data-toggle='dropdown'><span class="icon-bg"><i class="ti ti-email"></i></span><span
					class="badge badge-deeporange">2</span></a>
					<div class="dropdown-menu notifications arrow">
						<div class="topnav-dropdown-header">
							<span>Messages</span>
						</div>
						<div class="scroll-pane">
							<ul class="media-list scroll-content">
								<li class="media notification-message">
									<a href="#">
										<div class="media-left">
											<img class="img-circle avatar" src="http://placehold.it/300&text=Placeholder" alt="" />
										</div>
										<div class="media-body">
											<h4 class="notification-heading"><strong>Vincent Keller</strong> <span class="text-gray">? Design should be ...</span></h4>
											<span class="notification-time">2 mins ago</span>
										</div>
									</a>
								</li>
								<li class="media notification-message">
									<a href="#">
										<div class="media-left">
											<img class="img-circle avatar" src="http://placehold.it/300&text=Placeholder" alt="" />
										</div>
										<div class="media-body">
											<h4 class="notification-heading"><strong>Frend Pratt</strong> <span class="text-gray">? I will start with the ...</span></h4>
											<span class="notification-time">40 mins ago</span>
										</div>
									</a>
								</li>
								<li class="media notification-message">
									<a href="#">
										<div class="media-left">
											<img class="img-circle avatar" src="http://placehold.it/300&text=Placeholder" alt="" />
										</div>
										<div class="media-body">
											<h4 class="notification-heading"><strong>Cynthia Hines</strong> <span class="text-gray">? Interior bits are ...</span></h4>
											<span class="notification-time">6 hours ago</span>
										</div>
									</a>
								</li>
								<li class="media notification-message">
									<a href="#">
										<div class="media-left">
											<img class="img-circle avatar" src="http://placehold.it/300&text=Placeholder" alt="" />
										</div>
										<div class="media-body">
											<h4 class="notification-heading"><strong>Robin Horton</strong> <span class="text-gray">? Are you even ...</span></h4>
											<span class="notification-time">8 days ago</span>
										</div>
									</a>
								</li>
								<li class="media notification-message">
									<a href="#">
										<div class="media-left">
											<img class="img-circle avatar" src="http://placehold.it/300&text=Placeholder" alt="" />
										</div>
										<div class="media-body">
											<h4 class="notification-heading"><strong>Amanda Torrez</strong> <span class="text-gray">? The message is ...</span></h4>
											<span class="notification-time">16 hours ago</span>
										</div>
									</a>
								</li>
								<li class="media notification-message">
									<a href="#">
										<div class="media-left">
											<img class="img-circle avatar" src="http://placehold.it/300&text=Placeholder" alt="" />
										</div>
										<div class="media-body">
											<h4 class="notification-heading"><strong>Khan Farhan</strong> <span class="text-gray">? Expected the stuff ...</span></h4>
											<span class="notification-time">2 days ago</span>
										</div>
									</a>
								</li>
								<li class="media notification-message">
									<a href="#">
										<div class="media-left">
											<img class="img-circle avatar" src="http://placehold.it/300&text=Placeholder" alt="" />
										</div>
										<div class="media-body">
											<h4 class="notification-heading"><strong>Will Whedon</strong> <span class="text-gray">? The movie of this ...</span></h4>
											<span class="notification-time">4 days ago</span>
										</div>
									</a>
								</li>
							</ul>
						</div>
						<div class="topnav-dropdown-footer">
							<a href="#">See all messages</a>
						</div>
					</div>
				</li>

				<li class="dropdown toolbar-icon-bg">
					<a href="#" class="hasnotifications dropdown-toggle" data-toggle='dropdown'><span class="icon-bg"><i class="ti ti-bell"></i></span><span class="badge badge-deeporange">2</span></a>
					<div class="dropdown-menu notifications arrow">
						<div class="topnav-dropdown-header">
							<span>Notifications</span>
						</div>
						<div class="scroll-pane">
							<ul class="media-list scroll-content">
								<li class="media notification-success">
									<a href="#">
										<div class="media-left">
											<span class="notification-icon"><i class="ti ti-check"></i></span>
										</div>
										<div class="media-body">
											<h4 class="notification-heading">Update 1.0.4 successfully pushed</h4>
											<span class="notification-time">8 mins ago</span>
										</div>
									</a>
								</li>
								<li class="media notification-info">
									<a href="#">
										<div class="media-left">
											<span class="notification-icon"><i class="ti ti-check"></i></span>
										</div>
										<div class="media-body">
											<h4 class="notification-heading">Update 1.0.3 successfully pushed</h4>
											<span class="notification-time">24 mins ago</span>
										</div>
									</a>
								</li>
								<li class="media notification-teal">
									<a href="#">
										<div class="media-left">
											<span class="notification-icon"><i class="ti ti-check"></i></span>
										</div>
										<div class="media-body">
											<h4 class="notification-heading">Update 1.0.2 successfully pushed</h4>
											<span class="notification-time">16 hours ago</span>
										</div>
									</a>
								</li>
								<li class="media notification-indigo">
									<a href="#">
										<div class="media-left">
											<span class="notification-icon"><i class="ti ti-check"></i></span>
										</div>
										<div class="media-body">
											<h4 class="notification-heading">Update 1.0.1 successfully pushed</h4>
											<span class="notification-time">2 days ago</span>
										</div>
									</a>
								</li>
								<li class="media notification-danger">
									<a href="#">
										<div class="media-left">
											<span class="notification-icon"><i class="ti ti-arrow-up"></i></span>
										</div>
										<div class="media-body">
											<h4 class="notification-heading">Initial Release 1.0</h4>
											<span class="notification-time">4 days ago</span>
										</div>
									</a>
								</li>
							</ul>
						</div>
						<div class="topnav-dropdown-footer">
							<a href="#">See all notifications</a>
						</div>
					</div>
				</li>-->
				<span>
				<li class="dropdown toolbar-icon-bg">
					<a href="#" class="dropdown-toggle username" data-toggle="dropdown">
						<span style="margin-top:8px" class="icon-bg"><i class="ti ti-user"></i></span>
					</a>
					<ul class="dropdown-menu userinfo arrow">
						<li><a href="<?php echo base_url();?>index.php/gear/switch_template/1"><i class="ti ti-user"></i><span>Switch</span><!--<span class="badge badge-info pull-right">80%</span>--></a></li>
						<li><a href="<?php echo base_url();?>index.php/user/ChangePassword"><i class="fa fa-key"></i><span>Change Password</span></a></li>
						<!--<li class="divider"></li>
						<li><a href="#/"><i class="ti ti-stats-up"></i><span>Earnings</span></a></li>
						<li><a href="#/"><i class="ti ti-view-list-alt"></i><span>Statement</span></a></li>
						<li><a href="#/"><i class="ti ti-money"></i><span>Withdrawals</span></a></li>-->
						<li class="divider"></li>
						<li><a href="<?php echo base_url();?>index.php/gear/logout"><i class="fa fa-sign-out"></i><span>Sign Out</span></a></li>
					</ul>
				</li>
				</span>
			</ul>

		</header>
