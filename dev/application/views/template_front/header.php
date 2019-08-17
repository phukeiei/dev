<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>frontend/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>frontend/assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Information System Engineering Research Laboratory</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>frontend/assets/css/fonts.css" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <!-- CSS Files -->
    <link href="<?php echo base_url(); ?>frontend/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>frontend/assets/css/material-kit.css?v=1.2.1" rel="stylesheet"/>

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="<?php echo base_url(); ?>frontend/assets/assets-for-demo/vertical-nav.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>frontend/assets/assets-for-demo/demo.css" rel="stylesheet" />
<style>
.item{
	 height: 750px;
}
</style>
</head>

<body class="">
<!--<nav class="navbar navbar-default navbar-transparent navbar-fixed-top navbar-color-on-scroll" color-on-scroll=" " id="sectionsNav">-->
<nav class="navbar navbar-default  navbar-fixed-top " color-on-scroll=" " id="sectionsNav">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo site_url("/gear/switch_template/1");?>">ALLOSOFT. ALL RIGHTS RESERVED</a>
        </div>

        <div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-center">
						<li>
                            <a href="<?php echo site_url();?>/Home/index">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Products
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Contact Us
                            </a>
                        </li>
                    </ul>
            <ul class="nav navbar-nav navbar-right">
				<li>
                    <a href="<?php echo site_url('UMS/Show_template/Components');?>" class="btn btn-primary btn-round">
                        <i class="material-icons"></i>All Components
                    </a>
                </li>
				<li>
                    <a href="#">
                        <i class="material-icons"></i> <?php echo $this->session->userdata('UsName');?>	
                    </a>
                </li>
				<li class="dropdown">
					<a href="#pablo" class="profile-photo dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

						<div class="profile-photo-small">
							<img src="<?php echo base_url(); ?>frontend/assets/img/faces/default.png" alt="Circle Image" class="img-circle img-responsive">
							
						</div>
						
					<div class="ripple-container"></div></a>
					<ul class="dropdown-menu">
						<li class="dropdown-header">
							Setting
						</li>
						<li>
							<a href="<?php echo base_url();?>/index.php/gear/switch_template">Switch</a>
						</li>
						<li>
							<a href="<?php echo base_url();?>/index.php/user/ChangePassword">Change Password</a>
						</li>
						<li class="divider"></li>
						<li><a href="<?php echo base_url();?>/index.php/gear/logout">Sign out</a></li>
					</ul>
				</li>
            </ul>
        </div>
    </div>
</nav>

<!--<div class="page-header header-filter clear-filter"  data-parallax="true" style="background-image: url('<?php echo base_url(); ?>frontend/assets/img/img-2.jpg');">-->
<div class="page-header header-filter clear-filter"  data-parallax="true" style="background-image: url('<?php echo base_url(); ?>frontend/assets/img/img-5.jpg');  height: 550px;">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                
            </div>
        </div>
    </div>
</div>
<div class="main main-raised">
    
