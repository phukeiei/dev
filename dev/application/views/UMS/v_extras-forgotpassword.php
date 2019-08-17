<script>
	$(document).ready(function(){
		<?php 
		if($OK == 1){?>
			notics_error();
		<?php } ?>
	});

	function notics_error(){
	new PNotify({title: 'New Thing',
		title: 'พบข้อมูลผิดพลาด',
		text: 'ไม่พบข้อมูล E-mail ข้างต้น กรุณากรอกข้อมูล E-mail ใหม่',
		type: 'error',
		icon: 'ti ti-close',
		styling: 'fontawesome'
	});
}
</script>
<?php 
// if(isset($pass)){
	// echo $pass;
// }
?>
<div class="container" id="forgotpassword-form">
	<center><a href="#" class="login-logo"><img src="<?php echo base_url();?>assets/img/SME_LOGO-ver7.png"></a></center>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-teal">
				<div class="panel-heading">
					<h2>Forgot password</h2>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>index.php/UMS/forgotpassword/mail">
						<div class="form-group mb-n">
	                        <div class="col-xs-12">
	                        	<p>Enter your email to reset your password</p>
	                        	<div class="input-group">							
									<span class="input-group-addon">
										<i class="ti ti-user"></i>
									</span>
									<input name="email" type="text" required class="form-control" placeholder="Email Address">
								</div>
	                        </div>
						</div>
				</div>
							<div class="panel-footer">
								<div class="clearfix">
									<a href="<?php echo base_url();?>" class="btn btn-default pull-left">Go Back</a>
									<input type="submit" value="sent" class="btn btn-primary pull-right" />
								</div>
							</div>
						</div>
					</div>
					</form>
	</div>
</div>