<meta charset="UTF-8" />
<script type="text/javascript" src="<?php echo base_url(); ?>backend/js/ums/permissionuser.js"></script>

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
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-teal">
			<div class="panel-heading">
				<h2><i class="fa fa-cogs" style="font-size:26px"></i><?php echo nbs(2);?>กำหนดกลุ่มระบบงานของผู้ใช้</h2>
				<div class="options">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab-12-1" data-toggle="tab">แก้ไขข้อมูลผู้ใช้</a></li>
						<li><a href="#tab-12-2" data-toggle="tab">กลุ่มระบบงานของผู้ใช้</a></li>
					</ul>
				</div>
			</div>
			<form id="validate-User" class="form-horizontal row-border" method="post" action="<?php echo base_url(); ?>index.php/UMS/showUser/submitAdmin" >
					<div class="panel-body">
						<div class="tab-content">
							<div class="tab-pane active" id="tab-12-1">
								<?php foreach($editshow as $edit){?>
								<div class="panel-body">
									<div class="form-group">
										<label class="col-sm-1 control-label">รหัสผู้ใช้</label>
										<div class="col-sm-5">
											<input type="text" name="UsPsCode" id="UsPsCode" value="<?php echo $edit['UsPsCode'];?>" style="width:100%" placeholder="รหัสบุคลากร / รหัสนักศึกษา" required class="form-control"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-1 control-label">ชื่อ-สกุล</label>
										<div class="col-sm-5">
											<input type="text" name="UsName" id="UsName" value="<?php echo $edit['UsName'];?>" style="width:100%" placeholder="ชื่อ-สกุล" required class="form-control"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-1 control-label">กลุ่มผู้ใช้</label>
										<div class="col-sm-5">
											<select name="UsWgID" id="UsWgID" class="select2" style="width:100%">
												<?php foreach($wgroup as $wg) {?>
												<option value="<?php echo $wg['WgID'];?>" <?php if($edit['WgID'] == $wg['WgID']){ echo "selected";}?>><?php echo $wg['WgNameT'];?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-1 control-label">ชื่อผู้ใช้</label>
										<div class="col-sm-5">
											<input type="text" name="UsLogin" id="UsLogin" value="<?php echo $edit['UsLogin'];?>" style="width:100%"placeholder="รหัสบุคลากร / รหัสนักศึกษา" required class="form-control"/>
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
												<?php foreach ($dpment as $dp){ ?>
													<option value="<?php echo $dp['dpID'];?>" ><?php echo $dp['dpName'];?></option>
												<?php }?>
												<?php foreach($department as $depart) {?>
													<option value="<?php echo $depart['dpID'];?>" ><?php echo $depart['dpName'];?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-1 control-label">คำถามส่วนตัว</label>
										<div class="col-sm-5">
											<select name="UsQsID" id="UsQsID" class="select2" style="width:100%">
												<?php foreach ($showques as $show){ ?>
													<option value="<?php echo $show['QsID'];?>" ><?php echo $show['QsDescT'];?></option>
												<?php }?>
												<?php foreach($question as $ques) {?>
													<option value="<?php echo $ques['QsID'];?>" ><?php echo $ques['QsDescT'];?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-1 control-label">คำตอบ </label>
										<div class="col-sm-5">
											<input type="text" name="UsAnswer" id="UsAnswer" value="<?php echo $edit['UsAnswer'];?>" style="width:100%" placeholder="กรุณากรอกคำตอบ" required class="form-control"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-1 control-label">E-mail</label>
										<div class="col-sm-5">
											<input type="text" name="UsEmail" id="UsEmail" value="<?php echo $edit['UsEmail'];?>" style="width:100%" placeholder="example@example.com" required class="form-control"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-1 control-label">หมายเหตุ</label>
										<div class="col-sm-5">
											<textarea style="resize:none" cols="90" rows="4" name="UsDesc" id="UsDesc" style="width:100%" placeholder=" กรอกคำอธิบาย "><?php echo $edit ['UsDesc'];?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-1 control-label">สถานะ</label>
										<div class="col-sm-5">
											<input type="hidden" name="hiddenUsActive" value="<?php echo $edit['UsActive'];?>">
											<input type="checkbox" <?php if($edit['UsActive'] == 1){echo "checked = checked";}?> name="hiddenUsActive" value="<?php echo $edit['UsActive'];?>" id="UsActive"/>Active<br>
											<?php if($this->session->userdata('UsID')==1){?>
											<input type="hidden" name="hiddenUsAdmin" value="<?php echo $edit['UsAdmin'];?>">
											<input type="checkbox" <?php if($edit['UsAdmin'] == 1){echo "checked = checked";}?> name="hiddenUsAdmin" value="<?php echo $edit['UsAdmin'];?>" id="UsAdmin"/>Administrator
											<?php }?>
										</div>
									</div>
								</div>
								<?php }?>
							</div>
							<div class="tab-pane" id="tab-12-2">
								<?php foreach($systemname as $index => $sys){?>
								<div class="col-md-6">
								<div class="panel panel-default" data-widget='{"draggable": "false"}'>
									<div class="panel-heading">
										<h2><?php echo $sys['StNameT'];?></h2>
										<div class="button-icon pull-right panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body,.form-group"}'></div>
									</div>
									<div class="panel-body no-padding" style="display:none">
										<table class="table table-striped m-n">
											<tbody>
												<?php
												foreach($actor[$sys['StID']] as $key => $val ){
															$check = "";
															$hdcheck = 0;
														foreach($persys as $per){
															if($val['GpID'] == $per['GpID']){
																$check = "checked";
																$hdcheck = 1;
																$show = 1;
															}
														}?>
												<tr><td>
														<input type="hidden" name="UsID" value="<?php echo $UsID; ?>">
														<input type="checkbox" name = "<?php echo $val['GpID'];?>" id="<?php echo $val['GpID'];?>"<?php echo $check; ?>>
														<input type="hidden" name = "hidden<?php echo $val['GpID'];?>" value = "<?php echo $hdcheck;?>">
														<?php echo $val['GpNameT']; ?></td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
								</div>
								<?php } ?>
							</div>

						</div>
					</div>
					<div class="panel-footer">
						<div class="col-sm-12 col-sm-offset-0">
							<div class="btn-toolbar">
								<input id="cancle" class="btn-danger btn pull-left" type="button" onclick="window.location.href='<?php echo base_url(); ?>index.php/UMS/showUser/'" value="ยกเลิกการแก้ไข" name="cancle"></input>&emsp;
								<input  id="submit" class="btn-success btn pull-right" type="submit"  name="submit" value="บันทึก" ></input>
							</div>
						</div>
					</div>
			</form>
		</div>
	</div>
</div>
