<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2><img src="<?php echo base_url();?>images/icons/color/accept.png" alt="" /><?php echo nbs(2);?> แจ้งความประสงค์การเปลี่ยน password</h2>
			</div>
			<form class="form-horizontal row-border" id="validate-form" data-parsley-validate method="post" action="<?php echo base_url(); ?>index.php/UMS/forgotpassword/update/">	
			<div class="panel-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">username</label>
						<div class="col-sm-5">
							<input type="text" placeholder="username" name="username" required class="form-control"/>
						</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">new password</label>
						<div class="col-sm-5">
							<input type="PASSWORD"  name="password" placeholder="new password" class="form-control">
						</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">confirm new password</label>
						<div class="col-sm-5">
							<input type="PASSWORD" name="password" placeholder="confirm new password" class="form-control">
						</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12 col-sm-offset-0">
						<div class="btn-toolbar">
							<input class="btn-success btn pull-right" type="Submit" value="บันทึก">
						</div>
					</div>
				</div>	
			</div>
			</form>
		</div>
	</div>	
</div>
