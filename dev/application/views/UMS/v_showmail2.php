<?php if(isset($pass)){
		// echo $pass;
}?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default" data-widget='{"draggable": "false"}'>
			<div class="panel-heading">
				<h2><img src="<?php echo base_url();?>images/icons/color/accept.png" alt="" /><?php echo nbs(2);?>ยืนยันการเปลี่ยนรหัสผ่าน</h2>
			</div>
			<div class="panel-body">
				<div class="alert alert-dismissable alert-success">
					<h4>ยืนยันการเปลี่ยนรหัสผ่าน สำเร็จ</h4> 

					<p>กรุณาตรวจสอบอีเมล์ของท่าน เพื่อเปลี่ยนรหัสผ่าน </p>
					<p style="color:#FBB117">หมายเหตุ ถ้าไม่พบข้อมูล กรุณาตรวจสอบที่เมลขยะ</p>
					<br>
					<p><a class="btn btn-success" href="<?php echo base_url();?>">Loin</a></p>
				</div>
			</div>
		</div>
	</div>	
</div>
