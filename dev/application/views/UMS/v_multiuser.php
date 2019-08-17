				<script type="text/javascript" src="<?php echo base_url(); ?>js/ums/showUserAdd.js"></script>
				<script type="text/javascript"> $(function() { $("#tabs").tabs(); }); </script>
				<script type="text/javascript" src="<?php echo base_url(); ?>js/ums/permissionuser.js"></script>
				<!-- Main Content Wrapper -->
                <div id="da-content-wrap" class="clearfix">
                
                	<!-- Content Area -->
                	<!-- <div id="da-content-area">
						<div class="grid_3_center">
							</?php if(isset($Icon)){?>
							<div class="da-panel collapsible">
                        	</?php }else{?>
								<div class="da-panel collapsible collapsed">
								</?php }?>	
									<div class="da-panel-header" onclick="window.location.href='</?php echo base_url(); ?>index.php/UMS/showUser/showUserAdd'">
										<span class="da-panel-title"  >
											<img src="</?php echo base_url(); ?>/images/icons/black/16/pencil.png"   />
												เพิ่มข้อมูลผู้ใช้
										</span>
										
									</div>
								   
								</div>
							</div>
						
						</div> -->
                	<!-- Content Area -->
                	
                    	<div class="grid_3_center">
                        	<div class="da-panel ">
                            	<div class="da-panel-header">
                                	<span class="da-panel-title">
                                        <img src="<?php echo base_url(); ?>/images/icons/black/32/users_2.png" alt="" />
                                        กำหนดสิทธิรายกลุ่ม
                                    </span>
                                    
                                </div>
								
                                <div class="da-panel-content">
                                    <form id="validate-WG" class="da-form" method="post" action="<?php echo base_url(); ?>index.php/UMS/showWorkGroup/add">
										<div id="valWG-error" class="da-message error" style="display:none;"></div>
										<div class="da-form-inline">	
											<div class="da-form-row">
												<div class="da-form-col-5-10">
													<label>ระบบงานหลัก<span class="required">*</span></label>
													<img src="<?php echo base_url(); ?>/images/icons/Help.png" style="width:20px;height:20px;"alt=""  title="เลือกระบบงานหลัก" />
													<div class="da-form-item large">
														<select name="GpStID">
															<option value="">-- กรุณาเลือกระบบ --</option>	
														</select>
													</div>
												</div>	
											</div>
											<div class="da-form-row">
												<div class="da-form-col-5-10">
													<label>ระบบงานหลัก<span class="required">*</span></label>
													<img src="<?php echo base_url(); ?>/images/icons/Help.png" style="width:20px;height:20px;"alt=""  title="เลือกระบบงานหลัก" />
													<div class="da-form-item large">
														<select name="GpStID">
															<option value="">-- กรุณาเลือกระบบ --</option>	
														</select>
													</div>
												</div>	
											</div>												
											<div class="da-button-row">
												<input id="clear" class="da-button gray left" type="reset" value="เคลียร์ข้อมูล" name="clear"></input>
												<input id="submit" class="da-button green" type="submit" value="บันทึก" name="submit"></input>
												<input id="cancle" class="da-button red" type="button" onclick="window.location.href='<?php echo base_url(); ?>index.php/UMS/showWorkGroup/'" value="ยกเลิกการแก้ไข" name="cancle"></input>
											</div>
										</div>
									</form>								
                                </div>								
                            </div>
                        </div>         
                    </div>
                    
                </div>
