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
<style>
.item{
	 height: 750px;
}
</style>
</head>

<body class="">
	<div class="header-3">
      <?php $this->load->view('template_front/menu');?>
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			<div class="carousel slide" data-ride="carousel">

				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
					<li data-target="#carousel-example-generic" data-slide-to="1" class="active"></li>
					<li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
				</ol>

				<!-- Wrapper for slides -->
				<div class="carousel-inner">
					<div class="item">
						<div class="page-header header-filter" style="background-image: url('<?php echo base_url(); ?>frontend/assets/img/img-3.jpg');">
				        </div>

					</div>
					<div class="item active">
						<div class="page-header header-filter" style="background-image: url('<?php echo base_url(); ?>frontend/assets/img/img.jpg');">						

				        </div>

					</div>

					<div class="item">
						<div class="page-header header-filter" style="background-image: url('<?php echo base_url(); ?>frontend/assets/img/img-5.jpg'); ">
					</div>

				</div>

				<!-- Controls -->
				<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
					<i class="material-icons">keyboard_arrow_left</i>
				</a>
				<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
					<i class="material-icons">keyboard_arrow_right</i>
				</a>
			</div>
		</div>
    </div>
	<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-login">
		<div class="modal-content">
			<div class="card card-signup card-plain">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>

					<div class="header header-info text-center">
						<h4 class="card-title">Log in</h4>
						
					</div>
				</div>
				<div class="modal-body">
					<form class="form" method="post" id="validate-form" action="<?php echo base_url();?>/index.php/gear/checklogin">
						<p class="description text-center">Aos</p>
						<div class="card-content">

							<div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">face</i>
								</span>
								<input type="text" name="username" class="form-control" placeholder="Username">
							</div>

							<div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">lock_outline</i>
								</span>
								<input type="password" name="password" placeholder="Password..." class="form-control" />
								
								<input type="hidden" name="type_view" value="1">
								<input type="hidden" name="type_url" value="<?php echo $this->uri->segment(1)."/".$this->uri->segment(2);?>">
							</div>
							
							
						</div>
					
				</div>
				<div class="modal-footer text-center">
					<button type="submit" class="btn btn-primary btn-simple btn-wd btn-lg">LOGIN</button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--  End Modal -->

<!-- Register Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-signup">
	    <div class="modal-content">
			<div class="card card-signup card-plain">
				<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
					<h2 class="modal-title card-title text-center" id="myModalLabel">Register</h2>
		      	</div>
		      	<div class="modal-body">
					<div class="row">
						<div class="col-md-5 col-md-offset-1">
							<div class="info info-horizontal">
								<div class="icon icon-rose">
									<i class="material-icons">timeline</i>
								</div>
								<div class="description">
									<h4 class="info-title">Marketing</h4>
									<p class="description">
										We've created the marketing campaign of the website. It was a very interesting collaboration.
									</p>
								</div>
							</div>

							<div class="info info-horizontal">
								<div class="icon icon-primary">
									<i class="material-icons">code</i>
								</div>
								<div class="description">
									<h4 class="info-title">Fully Coded in HTML5</h4>
									<p class="description">
										We've developed the website with HTML5 and CSS3. The client has access to the code using GitHub.
									</p>
								</div>
							</div>

							<div class="info info-horizontal">
								<div class="icon icon-info">
									<i class="material-icons">group</i>
								</div>
								<div class="description">
									<h4 class="info-title">Built Audience</h4>
									<p class="description">
										There is also a Fully Customizable CMS Admin Dashboard for this product.
									</p>
								</div>
							</div>
						</div>

						<div class="col-md-5">
							<div class="social text-center">
								<button class="btn btn-just-icon btn-round btn-twitter">
									<i class="fa fa-twitter"></i>
								</button>
								<button class="btn btn-just-icon btn-round btn-dribbble">
									<i class="fa fa-dribbble"></i>
								</button>
								<button class="btn btn-just-icon btn-round btn-facebook">
									<i class="fa fa-facebook"> </i>
								</button>
								<h4> or be classical </h4>
							</div>

							<form class="form" method="" action="">
								<div class="card-content">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">face</i>
										</span>
										<input type="text" class="form-control" placeholder="First Name...">
									</div>

									<div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">email</i>
										</span>
										<input type="text" class="form-control" placeholder="Email...">
									</div>

									<div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">lock_outline</i>
										</span>
										<input type="password" placeholder="Password..." class="form-control" />
									</div>

									<!-- If you want to add a checkbox to this form, uncomment this code -->

									<div class="checkbox">
										<label>
											<input type="checkbox" name="optionsCheckboxes" checked>
											I agree to the <a href="#something">terms and conditions</a>.
										</label>
									</div>
								</div>
								<div class="modal-footer text-center">
									<a href="#pablo" class="btn btn-primary btn-round">Get Started</a>
								</div>
							</form>
						</div>
					</div>
		      	</div>
			</div>
	    </div>
	</div>
</div>
<!--  End Modal -->
	<div class="main main-raised">
	
	
	
	