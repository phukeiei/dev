<!DOCTYPE html>
<html lang="en" class="coming-soon">
<head>
    <meta charset="utf-8">
    <!--<title>SMartEcoSoftbuU</title>-->
	<title>Information System Engineering Research Laboratory</title> <!-- edit by naruecha 17/03/2017 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="author" content="KaijuThemes">

    <!--<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600' rel='stylesheet' type='text/css'>-->
    <link type="text/css" href="<?php echo base_url();?>backend/assets/plugins/iCheck/skins/minimal/blue.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url();?>backend/assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url();?>backend/assets/fonts/themify-icons/themify-icons.css" rel="stylesheet">               <!-- Themify Icons -->
    <link type="text/css" href="<?php echo base_url();?>backend/assets/css/styles.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries. Placeholdr.js enables the placeholder attribute -->
    <!--[if lt IE 9]>
        <link type="text/css" href="assets/css/ie8.css" rel="stylesheet">
        <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- The following CSS are included as plugins and can be removed if unused-->
    
    </head>

    <body class="focused-form animated-content">
               
<div class="container" id="login-form" >
	<a href="#" class="login-logo" ><img  src="<?php echo base_url();?>backend/images/logo_iserl.png" width="32%"></a>
	<!-- edit by naruecha 17/03/2017 -->
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-teal">
					<div class="panel-heading">
						<h2>LOGIN</h2>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" id="validate-form" method="post" action="<?php echo base_url();?>index.php/gear/checklogin">
							<div class="form-group mb-md">
		                        <div class="col-xs-12">
		                        	<div class="input-group">							
										<span class="input-group-addon">
											<i class="ti ti-user"></i>
										</span>
										<input type="text" name="username" class="form-control" placeholder="Username" data-parsley-minlength="6" placeholder="At least 6 characters" required>
									</div>
		                        </div>
							</div>

							<div class="form-group mb-md">
		                        <div class="col-xs-12">
		                        	<div class="input-group">
										<span class="input-group-addon">
											<i class="ti ti-key"></i>
										</span>
										<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
										
									</div>
		                        </div>
							</div>

							<div class="form-group mb-n">
								<div class="col-xs-12">
									<a href="<?php echo base_url();?>backend/index.php/UMS/forgotpassword/" class="pull-left">Forgot password?</a>
									
								</div>
							</div><br>
							<input class="btn-primary btn pull-right" type="submit" value="LOGIN"/>												
						</form>
					</div>
						
							<!--<div class="panel-footer">
								<div class="clearfix">
							<!--<a href="<?php //echo base_url();?>index.php/UMS/forgotpassword/" class="btn btn-default pull-left">Forgot password</a>-->
							<!--<a href="#" class="btn btn-primary pull-right">Login</a>
								</div>	
							</div>-->
					</div>

				<!--<div class="text-center">
					<a href="#" class="btn btn-label btn-social btn-facebook mb-md"><i class="ti ti-facebook"></i>Connect with Facebook</a>
					<a href="#" class="btn btn-label btn-social btn-twitter mb-md"><i class="ti ti-twitter"></i>Connect with Twitter</a>
				</div>-->
			</div>
		</div>
</div>

    
    
    <!-- Load site level scripts -->

<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script> -->

<script type="text/javascript" src="<?php echo base_url();?>backend/assets/js/jquery-1.10.2.min.js"></script> 							<!-- Load jQuery -->
<script type="text/javascript" src="<?php echo base_url();?>backend/assets/js/jqueryui-1.10.3.min.js"></script> 							<!-- Load jQueryUI -->
<script type="text/javascript" src="<?php echo base_url();?>backend/assets/js/bootstrap.min.js"></script> 								<!-- Load Bootstrap -->
<script type="text/javascript" src="<?php echo base_url();?>backend/assets/js/enquire.min.js"></script> 									<!-- Load Enquire -->

<script type="text/javascript" src="<?php echo base_url();?>backend/assets/plugins/velocityjs/velocity.min.js"></script>					<!-- Load Velocity for Animated Content -->
<script type="text/javascript" src="<?php echo base_url();?>backend/assets/plugins/velocityjs/velocity.ui.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>backend/assets/plugins/wijets/wijets.js"></script>     						<!-- Wijet -->

<script type="text/javascript" src="<?php echo base_url();?>backend/assets/plugins/codeprettifier/prettify.js"></script> 				<!-- Code Prettifier  -->
<script type="text/javascript" src="<?php echo base_url();?>backend/assets/plugins/bootstrap-switch/bootstrap-switch.js"></script> 		<!-- Swith/Toggle Button -->

<script type="text/javascript" src="<?php echo base_url();?>backend/assets/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js"></script>  <!-- Bootstrap Tabdrop -->

<script type="text/javascript" src="<?php echo base_url();?>backend/assets/plugins/iCheck/icheck.min.js"></script>     					<!-- iCheck -->

<script type="text/javascript" src="<?php echo base_url();?>backend/assets/plugins/nanoScroller/js/jquery.nanoscroller.min.js"></script> <!-- nano scroller -->

<script type="text/javascript" src="<?php echo base_url();?>backend/assets/js/application.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>backend/assets/demo/demo.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>backend/assets/demo/demo-switcher.js"></script>

<!-- End loading site level scripts -->
    <!-- Load page level scripts-->
    

    <!-- End loading page level scripts-->
    </body>
</html>