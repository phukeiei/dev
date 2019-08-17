<script type="text/javascript" src="<?php echo base_url();?>backend/js/validateTHENDI.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>backend/plugins/validate/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>backend/js/demo/demo.validation.js"></script>
<script>
$(document).ready(function(){
	<?php
		if($OK == 1){?>
			notics_error();
	<?php }?>
});

function notics_error(){
	new PNotify({title: 'New Thing',
		title: 'พบข้อผิดพลาด',
		text: 'รหัสผ่านผิดพลาด',
		type: 'error',
		icon: 'ti ti-close',
		styling: 'fontawesome'
	});
}
</script>
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-teal">
			<div class="panel-heading">
				<h2><i class="fa fa-key"></i>Change Your Password</h2>
			</div>
			<form class="form-horizontal row-border" id="validate-form" data-parsley-validate method="post" action="<?php echo base_url();?>backend/index.php/user/checkchange">	
			<div class="panel-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">รหัสผ่านเก่า</label>
					<div class="col-sm-4">
						<input placeholder="รหัสผ่านเก่า" id="oldpass" name="oldpass" type="password" required class="form-control"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">รหัสผ่านใหม่</label>
					<div class="col-sm-4">
						<input placeholder="รหัสผ่านใหม่" id="newpass" name="newpass" type="password" required class="form-control"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">ยืนยันรหัสผ่านใหม่</label>
					<div class="col-sm-4">
						<input placeholder="ยืนยันรหัสผ่านใหม่" id="newpass2" name="newpass2" type="password" required class="form-control"/>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<div class="btn-toolbar">
					<input class="btn-inverse btn pull-left" type="button" value="Cancel" onclick="history.back();">
					<input class="btn-success btn pull-right" type="Submit" value="Change">
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
