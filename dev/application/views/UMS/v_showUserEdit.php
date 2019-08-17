<meta charset="UTF-8" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/ums/permissionuser.js"></script>
<script>
	$(document).ready(function(){
		$(".select2").select2();
	});
</script>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-teal">
			<div class="panel-heading">
				<h2><img src="<?php echo base_url(); ?>/images/icons/black/16/cog_2.png" alt="" /><?php echo nbs(2);?>กำหนดกลุ่มระบบงานของผู้ใช้</h2>
				<div class="options">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab-12-1" data-toggle="tab">แก้ไขข้อมูลผู้ใช้</a></li>
						<li><a href="#tab-12-2" data-toggle="tab">กลุ่มระบบงานของผู้ใช้</a></li>
					</ul>
				</div>
			</div>
			<form id="validate-User" class="form-horizontal row-border" method="post" action="<?php echo base_url(); ?>index.php/UMS/showUser/submit" >
			
				<div class="tab-content">
					<div class="tab-pane active" id="tab-12-1">
						<?php foreach($editshow as $edit){?>
							<div class="panel-body">
								<div class="form-group">
									<label class="col-sm-1 control-label">รหัสผู้ใช้</label>
									<div class="col-sm-5">
										<input type="text" readonly="readonly" name="UsPsCode" id="UsPsCode" value="<?php echo $edit['UsPsCode'];?>" style="width:100%" placeholder="รหัสบุคลากร / รหัสนักศึกษา" required class="form-control"/>
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
											<?php foreach($wgroup as $key => $wg) { ?>
												<option value="<?php echo $wg['WgID'];?>" <?php if($edit['WgID'] == $wg['WgID']){ echo "selected";}?>><?php echo $wg['WgNameT'];?></option>
											<?php  } ?>
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
							</div>
							<div class="page-body">
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
						<div class="panel-body">
							<table class="da-table">
								<thead>
									<tr>
									</tr>
								</thead>
									<tbody>
										<?php 
										if($this->session->userdata('UsID')==1){
										foreach($sysname as $sys) {
												$check = "";
												$hdcheck = 0;
											foreach($persys as $per){
											if($sys['GpID'] == $per['GpID']){
										
												$check = "checked";
												$hdcheck = 1;
											}
										}?>
									<tr>
										<td>
											<input type="hidden" name="UsID" value="<?php echo $UsID; ?>">
											<input type="checkbox" name = "<?php echo $sys['GpID'];?>" id="<?php echo $sys['GpID'];?>"<?php echo $check; ?>> 
											<input type="hidden" name = "hidden<?php echo $sys['GpID'];?>" value = "<?php echo $hdcheck;?>">
										</td>
										<td><?php echo $sys['StNameT']; ?>&nbsp; ( <?php echo $sys['GpNameT']; ?> )</td>
									</tr>
										<?php }}else{
											foreach($sysname as $sys) {
											$check = "";
											$hdcheck = 0;
										foreach($persys as $per){
											if($sys['GpID'] == $per['GpID']){
												$check = "checked";
												$hdcheck = 1;
												// echo $hdcheck;
											}
										} ?>
									<tr>
										<td>
											<input type="hidden" name="UsID" value="<?php echo $UsID; ?>">
											<input style='<?php if($sys['GpID']== 10001 || $sys['GpID']== 550083){ echo "display:none";} ?>' type="checkbox" name = "<?php echo $sys['GpID'];?>" id="<?php echo $sys['GpID'];?>"<?php echo $check; ?>> 
											<input type="hidden" name = "hidden<?php echo $sys['GpID'];?>" value = "<?php echo $hdcheck;?>">
										</td>
										<td style='<?php if($sys['GpID']== 10001 || $sys['GpID']== 550083){ echo "display:none";} ?>'>&nbsp;<?php echo $sys['StNameT']; ?>&nbsp; ( <?php echo $sys['GpNameT']; ?> )</td>
									</tr>
											
										<?php }}?>
								</tbody>										
							</table>	
						</div>
					</div>
				</div>
			<div class="panel-footer">
				<div class="col-sm-11 col-sm-offset-1">
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
                <!-- Main Content Wrapper 
                <div id="da-content-wrap" class="clearfix">
                
                	<!-- Content Area 
                	<div id="da-content-area">
                    	<div class="grid_3_center">
                        	<div class="da-panel">
                            	<div class="da-panel-header">
                                	<span class="da-panel-title">
                                        <img src="<?php echo base_url(); ?>/images/icons/black/16/cog_2.png" alt="" />
                                        กำหนดกลุ่มระบบงานของผู้ใช้ <br />
                                    </span>
                                    
                                </div>
					<form id="validate-User" class="da-form" method="post" action="<?php echo base_url(); ?>index.php/UMS/showUser/submit" >
						<div id="valUser-error" class="da-message error" style="display:none;"></div>
						<div class="da-form-inline">
							<div class="demo">
								<div id="tabs">
								<ul>
									<li><a href="#tabs-1">แก้ไขข้อมูลผู้ใช้</a></li>
									<li><a href="#tabs-2">กลุ่มระบบงานของผู้ใช้</a></li>
								</ul>
									<div id="tabs-1">
										<div class="da-panel-content">
											<?php foreach($editshow as $edit){?>
											
											<!--<form class="da-form">
												<div class="da-form-row">
													<div class="da-form-col-6-10">
														<label>รหัสผู้ใช้ <span class="required">*</span></label>
														<div class="da-form-item large">
															<input type="text" name="UsPsCode" value="<?php echo $edit['UsPsCode'];?>" style="width:100%" placeholder="รหัสบุคลากร / รหัสนักศึกษา"/>
														</div>
													</div>
												</div>
												<div class="da-form-row">
													<div class="da-form-col-6-10">
														<label>ชื่อ-สกุล <span class="required">*</span></label>
														<div class="da-form-item large">
															<input type="text" name="UsName" value="<?php echo $edit['UsName'];?>" style="width:100%" placeholder="ชื่อ-สกุล"/>
														</div>
													</div>
												</div>
												<div class="da-form-row">
													<div class="da-form-col-6-10">
														<label>กลุ่มผู้ใช้<span class="required">*</span></label>
														<div class="da-form-item default" class="chzn-select"> 
															<select name="UsWgID" class="chzn-select">
																<option value="<?php echo $edit['WgID'];?>" ><?php echo $edit['WgNameT'];?></option>
																<?php foreach($wgroup as $wg) {?>
																<option value="<?php echo $wg['WgID']?>" ><?php echo $wg['WgNameT'];?></option>
																<?php } ?>
															</select>
														</div>
													</div>	
												</div>	
												<div class="da-form-row">
													<div class="da-form-col-6-10">
														<label>ชื่อผู้ใช้ <span class="required">*</span></label>
														<div class="da-form-item large">
															<input type="text" name="UsLogin" value="<?php echo $edit['UsLogin'];?>" style="width:100%" placeholder="รหัสบุคลากร / รหัสนักศึกษา"/>
														</div>
													</div>
												</div>	
												<div class="da-form-row">
													<div class="da-form-col-6-10">
														<label>หน่วยงาน<span class="required">*</span></label>
														<div class="da-form-item default">
															<select name="UsDpID" class="chzn-select">
																<?php foreach ($dpment as $dp){ ?>
																	<option value="<?php echo $dp['dpID'];?>" ><?php echo $dp['dpName'];?></option>
																<?php }?>
																<?php foreach($department as $depart) {?>
																	<option value="<?php echo $depart['dpID'];?>" ><?php echo $depart['dpName'];?></option>
																<?php } ?>
															</select>
														</div>
													</div>	
												</div>
												<div class="da-form-row">
													<div class="da-form-col-6-10">
														<label>คำถามส่วนตัว<span class="required">*</span></label>
														<div class="da-form-item default"> 
															<select name="UsQsID" class="chzn-select">
																<?php foreach ($showques as $show){ ?>
																	<option value="<?php echo $show['QsID'];?>" ><?php echo $show['QsDescT'];?></option>
																<?php }?>
																<?php foreach($question as $ques) {?>
																	<option value="<?php echo $ques['QsID'];?>" ><?php echo $ques['QsDescT'];?></option>
																<?php } ?>
															</select>
														</div>
													</div>	
												</div>
												
												<div class="da-form-row">
													<div class="da-form-col-6-10">
														<label>คำตอบ <span class="required">*</span></label>
														<div class="da-form-item large">
															<input type="text" name="UsAnswer" value="<?php echo $edit['UsAnswer'];?>" style="width:100%" placeholder="กรุณากรอกคำตอบ"/>
														</div>
													</div>
												</div>
												<div class="da-form-row">
													<div class="da-form-col-6-10">
														<label>E-mail<span class="required">*</span></label>
														<div class="da-form-item large">
															<input type="text" name="UsEmail" value="<?php echo $edit['UsEmail'];?>" style="width:100%" placeholder="example@example.com"/>
														</div>
													</div>
												</div>
												<div class="da-form-row">
													<div class="da-form-col-6-10">
														<label>หมายเหตุ<span class="required"></span></label>
														<div class="da-form-item large">
															<textarea cols="auto" rows="auto" name="UsDesc" style="width:100%" placeholder=" กรอกคำอธิบาย "><?php echo $edit ['UsDesc'];?></textarea>
														</div>
													</div>
												</div>	
												
										
										
							                <div class="da-form-col-6-10">
												<tr>
													<input type="hidden" name="hiddenUsActive" value="<?php echo $edit['UsActive'];?>">
													<input type="hidden" name="hiddenUsAdmin" value="<?php echo $edit['UsAdmin'];?>">
													<td><input type="checkbox" <?php if($edit['UsActive'] == 1){echo "checked = checked";}?> name="hiddenUsActive" value="<?php echo $edit['UsActive'];?>" id="UsActive"/>Active<br/></td>
													<td><input type="checkbox" <?php if($edit['UsAdmin'] == 1){echo "checked = checked";}?> name="hiddenUsAdmin" value="<?php echo $edit['UsAdmin'];?>" id="UsAdmin"/>Administrator<br/></td>
												</tr>
                                            	
                                            </div><br><br><br>
											
											
							
											<?php }?>

                                        </div>	
									</div>	
									
									<div id="tabs-2">
										 <div class="da-panel-content">
											
												<table class="da-table">
													<thead>
														<tr>
                                                
														</tr>
													</thead>
														<tbody>
															<?php foreach($sysnames as $sys) {
																	$check = "";
																	$hdcheck = 0;
																foreach($persys as $per){
																if($sys['GpID'] == $per['GpID']){
															
																	$check = "checked";
																	$hdcheck = 1;
																}
															}?>
											<tr>
												<td>
												<input type="hidden" name="UsID" value="<?php echo $UsID; ?>">
												<input type="checkbox" name = "<?php echo $sys['GpID'];?>" id="<?php echo $sys['GpID'];?>"<?php echo $check; ?>> 
												<input type="hidden" name = "hidden<?php echo $sys['GpID'];?>" value = "<?php echo $hdcheck;?>">
												</td>
                                                <td><?php echo $sys['StNameT']; ?>&nbsp; ( <?php echo $sys['GpNameT']; ?> )</td>
											</tr>
											<?php }?>
                                        </tbody>										
                                    </table>	
									
                                </div>								
                            </div>
							<div class="da-button-row" align = "right">									
									<input  id="submit" class="da-button green" type="submit"  name="submit" value="บันทึก" ></input>
									<input id="cancle" class="da-button red" type="button" onclick="window.location.href='<?php echo base_url(); ?>index.php/UMS/showUser/'" value="ยกเลิกการแก้ไข" name="cancle"></input>
									
									</div>
                        </div> 
						
						</form>
                    </div>
								
				</div>
	
                            </div>
                        </div>         
                    </div>
                    
                         
