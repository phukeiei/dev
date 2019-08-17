<script type="text/javascript" src="<?php echo base_url(); ?>js/ums/permissionuser.js"></script>
<link type="text/css" href="<?php echo base_url(); ?>assets/plugins/iCheck/skins/minimal/_all.css" rel="stylesheet">                   <!-- Custom Checkboxes / iCheck -->
<link type="text/css" href="<?php echo base_url(); ?>assets/plugins/iCheck/skins/flat/_all.css" rel="stylesheet">
<link type="text/css" href="<?php echo base_url(); ?>assets/plugins/iCheck/skins/square/_all.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script> 		<!-- iCheck // already included on site-level -->
<script>
	$(document).ready(function(){
		$(".select2").select2();
	});
</script>
<style>
.panel .panel-heading h2 {
	padding: 8px 0 14px;
}
</style>
	<?php //print_r($this->session->userdata('UsDpID'));?>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-teal">
				<div class="panel-heading">
					<h2><i class="fa fa-user-plus" style="font-size:26px"></i><?php echo nbs(2);?>เพิ่มข้อมูล-กลุ่มระบบงานของผู๋ใช้</h2>
					<div class="options">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab-12-1" data-toggle="tab">แก้ไขข้อมูลผู้ใช้</a></li>
							<li><a href="#tab-12-2" data-toggle="tab">กลุ่มระบบงานของผู้ใช้</a></li>
							<?php	$hdAc = 0;$hdAd = 0;?>
						</ul>
					</div>
				</div>
				<div class="col-sm-12">
				<form id="validate-User" class="form-horizontal row-border" method="post" action="<?php echo base_url(); ?>index.php/UMS/showUser/add">
					<div class="panel-body">
						<div class="tab-content">
							<div class="tab-pane active" id="tab-12-1">
								<div class="panel-body">
									<div class="form-group">
										<label class="col-sm-1 control-label">รหัสผู้ใช้</label>
										<div class="col-sm-5">
											<input type="text" name="UsPsCode" id="UsPsCode" style="width:100%" placeholder="รหัสบุคลากร / รหัสนักศึกษา" required class="form-control"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-1 control-label">ชื่อ-สกุล</label>
										<div class="col-sm-5">
											<input type="text" name="UsName" id="UsName" style="width:100%" placeholder="ชื่อ-สกุล" required class="form-control"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-1 control-label">กลุ่มผู้ใช้</label>
										<div class="col-sm-5">
											<select name="UsWgID" id="UsWgID" class="select2" style="width:100%">
												<?php foreach($groupname->result_array() as $optgroupname) {?>
												<option value="<?php echo $optgroupname['WgID']; ?>"><?php echo $optgroupname['WgNameT'];?></option>
												<?php } ?>
											</select>
										</div>	
									</div>
									<div class="form-group">
										<label class="col-sm-1 control-label">ชื่อผู้ใช้</label>
										<div class="col-sm-5">
											<input type="text" name="UsLogin" id="UsLogin" style="width:100%"placeholder="รหัสบุคลากร / รหัสนักศึกษา" required class="form-control"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-1 control-label">รหัสผ่าน</label>
										<div class="col-sm-5">
											<input type="password" name="UsPassword" id="UsPassword" style="width:100%" placeholder="กรุณากรอกเพื่อเปลี่ยนรหัสผ่าน" class="form-control"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-1 control-label">หน่วยงาน</label>
										<div class="col-sm-5">
											<select name="UsDpID" id="UsDpID" class="select2" style="width:100%" <?php if($this->session->userdata('UsID')!=1){ echo "disabled";} ?>>
												<?php foreach ($department->result_array() as $optdepartment){?>
													<option value="<?php echo $optdepartment['dpID'];?>" ><?php echo $optdepartment['dpName'];?></option>
												<?php }?>
											</select>	
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-1 control-label">คำถามส่วนตัว</label>
										<div class="col-sm-5"> 
											<select name="UsQsID" id="UsQsID" class="select2" style="width:100%">
												<?php foreach ($question->result_array() as $optquestion){?>
													<option value="<?php echo $optquestion['QsID'];?>" ><?php echo $optquestion['QsDescT'];?></option>
												<?php }?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-1 control-label">คำตอบ </label>
										<div class="col-sm-5">
											<input type="text" name="UsAnswer" id="UsAnswer" style="width:100%" placeholder="กรุณากรอกคำตอบ" required class="form-control"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-1 control-label">E-mail</label>
										<div class="col-sm-5">
											<input type="text" name="UsEmail" id="UsEmail" style="width:100%" placeholder="example@example.com" required class="form-control"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-1 control-label">หมายเหตุ</label>
										<div class="col-sm-5">
											<textarea style="resize:none" cols="90" rows="4" name="UsDesc" id="UsDesc" style="width:100%" placeholder=" กรอกคำอธิบาย "></textarea>
										</div>
									</div>
								</div>
								<div class="page-body">
									<div class="form-group">
										<label class="col-sm-1 control-label">สถานะ</label>
										<div class="col-sm-6">
												<input type = "hidden" name ="hiddenUsActive" value = "<?php echo $hdAc; ?>" />
												<input type="checkbox" name="UsActive"  id="UsActive"> Active<br>
											
											<?php if($this->session->userdata('UsID')==1){?>
												<input type = "hidden" name ="hiddenUsAdmin"  value = "<?php echo $hdAd; ?>" />
												<input type="checkbox" name="UsAdmin"  id="UsAdmin"> Administrator
											<?php }?>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane" id="tab-12-2">
								<div class="panel-body">
									<table class="da-table">
										<tbody>
											<?php foreach($sysname as $sys) {
													$check = "";
													$hdcheck = 0;
												foreach($persys as $per){
													if($sys['GpID'] == $per['GpID']){
														$check = "checked";
														$hdcheck = 1;
														echo $hdcheck;
													}
												} ?>
											<tr>
												<td>
													<input type="checkbox" name = "<?php echo $sys['GpID']; ?>" id="<?php echo $sys['GpID'];?>"  /> 
													<input type="hidden" name = "hidden<?php echo $sys['GpID']; ?>" value = "<?php echo $hdcheck; ?>" /> 
												</td>
												<td>&nbsp;<?php echo $sys['StNameT']; ?>&nbsp; ( <?php echo $sys['GpNameT']; ?> )</td>
											</tr>
											<?php  }?>
										</tbody>										
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<div class="col-sm-11 col-sm-offset-1">
						<div class="btn-toolbar">
							<input id="cancle" class="btn-inverse btn pull-left" type="reset" value="เคลียร์ข้อมูล" ></input>
							<input id="submit" class="btn-success btn pull-right" type="submit" onclick="window.location.href='<?php echo base_url(); ?>index.php/UMS/showUser/'" name="submit" value="บันทึก" ></input>
						</div>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div> 