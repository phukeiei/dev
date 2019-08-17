	<meta charset="UTF-8" />
	<link type="text/css" href="theme/jquery.ui.all.css" rel="stylesheet" />
	<script type="text/javascript" src="jquery-1.4.2.js"></script>
	<script type="text/javascript" src="ui/jquery.ui.core.js"></script>
	<script type="text/javascript" src="ui/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="ui/jquery.ui.tabs.js"></script>
	<script type="text/javascript"> $(function() { $("#tabs").tabs(); }); </script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/js/ums/permissionuser.js"></script>
        
                <!-- Main Content Wrapper -->
                <div id="da-content-wrap" class="clearfix">
                
                	<!-- Content Area -->
                	<div id="da-content-area">
                    	<div class="grid_3_center">
                        	<div class="da-panel">
                            	<div class="da-panel-header">
                                	<span class="da-panel-title">
                                        <img src="<?php echo base_url(); ?>/images/icons/black/16/cog2.png" alt="" />
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
											<!--<form class="da-form">-->
												
												<div class="da-form-row">
													<div class="da-form-col-6-10">
														<label>รหัสผู้ใช้ <span class="required">*</span></label>
														<div class="da-form-item large">
															<input type="text" name="UsPsCode" value="<?php echo $edit['UsPsCode'];?>" placeholder="รหัสบุคลากร / รหัสนักศึกษา"/>
														</div>
													</div>
												</div>
												<div class="da-form-row">
													<div class="da-form-col-6-10">
														<label>ชื่อ-สกุล <span class="required">*</span></label>
														<div class="da-form-item large">
															<input type="text" name="UsName" value="<?php echo $edit['UsName'];?>" placeholder="ชื่อ-สกุล"/>
														</div>
													</div>
												</div>
												<div class="da-form-row">
													<div class="da-form-col-10-10">
														<label>กลุ่มผู้ใช้<span class="required">*</span></label>
														<div class="da-form-item default"> 
															<select name="UsWgID">
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
															<input type="text" name="UsLogin" value="<?php echo $edit['UsLogin'];?>" placeholder="รหัสบุคลากร / รหัสนักศึกษา"/>
														</div>
													</div>
												</div>

												<div class="da-form-row">
													<div class="da-form-col-6-10">
														<label>รหัสผ่าน<span class="required">*</span></label>
														<div class="da-form-item large">
															<input type="password" name="UsPassword" value="<?php echo $edit['UsPassword'];?>" placeholder="รหัสบุคลากร / รหัสนักศึกษา"/>
														</div>
													</div>
												</div>

												<div class="da-form-row">
													<div class="da-form-col-10-10">
														<label>หน่วยงาน<span class="required">*</span></label>
														<div class="da-form-item default"> 
															<select name="UsDpID">
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
													<div class="da-form-col-10-10">
														<label>คำถามส่วนตัว<span class="required">*</span></label>
														<div class="da-form-item default"> 
															<select name="UsQsID">
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
															<input type="text" name="UsAnswer" value="<?php echo $edit['UsAnswer'];?>" placeholder="กรุณากรอกคำตอบ"/>
														</div>
													</div>
												</div>
												<div class="da-form-row">
													<div class="da-form-col-6-10">
														<label>E-mail<span class="required">*</span></label>
														<div class="da-form-item large">
															<input type="text" name="UsEmail" value="<?php echo $edit['UsEmail'];?>" placeholder="example@example.com"/>
														</div>
													</div>
												</div>
												<div class="da-form-row">
													<div class="da-form-col-6-10">
														<label>หมายเหตุ<span class="required"></span></label>
														<div class="da-form-item large">
															<textarea cols="auto" rows="auto" name="UsDesc"  placeholder=" กรอกคำอธิบาย "><?php echo $edit ['UsDesc'];?></textarea>
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
															<?php foreach($sysname as $sys) {
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
                    
                         
