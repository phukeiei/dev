<?php 
	// echo $this->config->item('uploads_dir');
	// echo base_url()."index.php/UMS/showIcon/upload_file";
?>
<script>
function removeIcon(sid)
{
	var web="<?php echo base_url()?>index.php/UMS/showIcon/remove/"+sid;
	bootbox.confirm("คุณต้องการลบหรือไม่?", function(result) {
		if(result==true){
			window.location.href=web;
		}
	});
}
$(document).ready(function() {
    $(".select2").select2();
	<?php 
		if($OK == 1){?>
			notics_succuess();
	<?php	} 
		if($OK == 2){?>
			notics_error();
	<?php }?>

});

function notics_succuess(){
	new PNotify({title: 'New Thing',
		title: 'สำเร็จ',
		text: 'บันทึกข้อมูลเสร็จสมบูรณ์',
		type: 'success',
		icon: 'ti ti-check',
		styling: 'fontawesome'
	});
}

function notics_error(){
	new PNotify({title: 'New Thing',
		title: 'เกิดข้อผิดพลาด!',
		text: 'ไม่สามารถอัพโหลดไฟล์ดังกล่าวได้ เนื่องจากไฟล์อาจมีขนาดใหญ่เกินไปหรือเป็นชนิดของไฟล์ที่ไม่ถูกต้อง',
		type: 'error',
		icon: 'ti ti-close',
		styling: 'fontawesome'
	});
}
</script>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-teal panel-collapsed" data-widget='{"draggable": "false"}'>
				<div class="panel-heading">
					<h2><i class="fa fa-upload" style="font-size:26px"></i><?php echo nbs(2); ?>เพิ่มไอคอนรูปภาพ</h2>
					<div style="cursor:pointer" class="button-icon pull-right" data-actions-container=""  data-action-collapse='{"target": ".panel-body,.panel-footer"}'></div>
				</div>
				<form class="form-horizontal row-border" id="validate-form" data-parsley-validate method = "post" <?php echo form_open_multipart('UMS/showIcon/upload_file'); ?>	
					
					<div class="panel-body">
						<div class="form-group">
							<label class="col-sm-1 control-label">File</label>
							<div class="col-sm-5">
								<div class="fileinput fileinput-new" style="width: 100%;" data-provides="fileinput">
									<div class="fileinput-preview thumbnail mb20" data-trigger="fileinput" style="width: 100%; height: 150px;"></div>
									<div>
										<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">ลบรูปภาพ</a>
										<span class="btn btn-default btn-file">
											<span class="fileinput-new">เลือกรูปภาพ</span>
											<span class="fileinput-exists">เปลี่ยนรูปภาพ</span>
											<input type="file" name="IcPic" class="ephoto-upload" data-trigger="hover">
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-1 control-label">ชื่อไอคอน</label>
							<div class="col-sm-5">
								<input type="text" name="IcName" required class="form-control tooltips" data-trigger="hover" data-original-title="กรุณากรอกชื่อไอคอน"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-1 control-label">ระบุชนิดไอคอน</label>
							<div class="col-sm-8">
								<select id="e1" name="IcType" class="select2" style="width:50%">
										<option value="menu">Menu</option>
										<option value="header">Header</option>
										<option value="gear">Gear</option>
										<option value="system">System</option>
								</select>
							</div>
						</div>
						<div class="panel-footer">
							<div class="col-sm-12 col-sm-offset-0">
								<div class="btn-toolbar">
									<input class="btn-inverse btn pull-left" type="reset" value="เคลียร์ข้อมูล">
									<input class="btn-success btn pull-right" type="Submit" value="บันทึก">
								</div>
							</div>
						</div>
					</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-midnightblue">
				<div class="panel-heading">
					<h2>
						<ul class="nav nav-tabs">
							<li class="active"><a href="#menu-icon" data-toggle="tab">Menu Icons</a></li>
							<li><a href="#header-icon" data-toggle="tab">Header Icons</a></li>
							<li><a href="#gear-icon" data-toggle="tab">Gear Icons</a></li>
							<li><a href="#system-icon" data-toggle="tab">System Icons</a></li>
						</ul>
					</h2>
				</div>
				<div class="panel-body">
					<div class="tab-content">
						<div class="tab-pane active" id="menu-icon">
							<?php foreach($icon as $iconmenu){ 
									if($iconmenu['IcType'] == "menu"){
										$path = $this->config->item('uploads_url');
										$pathString = $path.$iconmenu['IcType']."&image=".$iconmenu['IcName'];
									?>
								<div class="col-md-2">
									<div class="info-tile tile-success">
										<img width="60" height="60" align = "left" src="<?php echo $pathString; ?>" alt="" />
										<span class="da-gallery-hover">
											<ul class="pull-right">
												<a style="color:red" onclick = 'removeIcon("<?php echo $iconmenu['IcID'];?>")' ><li style="font-size:20px" class="fa fa-times-circle"></li></a>
											</ul>
										</span>
									</div>	
								</div>
							<?php } } ?>
						</div>
						<div class="tab-pane" id="header-icon">
							<?php foreach($icon as $iconheader){ 
									if($iconheader['IcType'] == "header"){
										$path = $this->config->item('uploads_url');
										$pathString = $path.$iconheader['IcType']."&image=".$iconheader['IcName'];
							?>
								<div class="col-md-4">
									<div class="info-tile info-tile-alt tile-teal">
										<img width="200px" height="60px" align="left" src="<?php echo $pathString; ?>" alt="" />
										<span class="da-gallery-hover" align="left">
											<ul class="pull-right">
												<a style="color:red" onclick = 'removeIcon("<?php echo $iconheader['IcID'];?>")' ><li style="font-size:20px" class="fa fa-times-circle"></li></a>
											</ul>
										</span>
									</div>	
								</div>
							<?php } } ?>	
						</div>
						<div class="tab-pane" id="gear-icon">
							<?php foreach($icon as $icongear){ 
									if($icongear['IcType'] == "gear"){
										$path = $this->config->item('uploads_url');
										$pathString = $path.$icongear['IcType']."&image=".$icongear['IcName'];
							?>
								<div class="col-md-2">
									<div class="info-tile tile-success">
										<img width="60" height="60" align = "left" src="<?php echo $pathString; ?>" alt="" />
										<span class="da-gallery-hover">
											<ul class="pull-right">
												<a style="color:red" onclick = 'removeIcon("<?php echo $icongear['IcID'];?>")' ><li style="font-size:20px" class="fa fa-times-circle"></li></a>
											</ul>
										</span>
									</div>	
								</div>
							<?php } } ?>				
						</div>
						<div class="tab-pane" id="system-icon">
							<?php foreach($icon as $iconsystem){ 
									if($iconsystem['IcType'] == "system"){
										$path = $this->config->item('uploads_url');
										$pathString = $path.$iconsystem['IcType']."&image=".$iconsystem['IcName'];
							?>
							<div class="col-md-2">
									<div class="info-tile tile-success">
										<img width="60" height="60" align = "left" src="<?php echo $pathString; ?>" alt="" />
										<span class="da-gallery-hover">
											<ul class="pull-right">
												<a style="color:red" onclick = 'removeIcon("<?php echo $iconsystem['IcID'];?>")' ><li style="font-size:20px;" class="fa fa-times-circle"></li></a>
											</ul>
										</span>
									</div>	
								</div>
							<?php } } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>