           <script>
		   function removeIcon(sid)
{
	var web="<?php echo base_url()?>index.php/UMS/showIcon/remove/"+sid;
	if(confirm("คุณต้องการลบหรือไม่?")==true){
     window.location.href=web;
   }
	else
	{
		return false;
	}
}
		   </script>

		   <!-- Main Content Wrapper -->
                <div id="da-content-wrap" class="clearfix">
                
                	<!-- Content Area -->
                	<div id="da-content-area">
						<div class="grid_2_center">
                        	<div class="da-panel collapsible ">
                            	<div class="da-panel-header">
                                	<span class="da-panel-title">
                                        <img src="<?php echo base_url(); ?>/images/icons/black/16/pencil.png" alt="" />
											ข้อมูลไอคอน
                                    </span>
                                </div>
                                <div class="da-panel-content">
								<form id="validate-Icon" method = "post" class="da-form" <?php echo form_open_multipart('UMS/showIcon/submit_edit'); ?>
								
									<div id="valIcon-error" class="da-message error" style="display:none;"></div>
										<?php foreach($temp as $icon){ ?>
                                        <div class="da-form-row">
                                            <div class="da-form-col-3-10">
												<label>File <span class="required"></span></label>
                                            </div>
											<div class="da-form-col-5-10">
                                                <img align = "left" src="<?php echo base_url(); ?>/uploads/<?php echo $icon['IcType']; ?>/<?php echo $icon['IcName']; ?>" alt="" />
                                            </div>
										</div>
										<div class="da-form-row">
                                            <div class="da-form-col-3-10">
												<label>ชื่อไอคอน<span class="required">*</span></label>
                                            </div>
                                            <div class="da-form-col-5-10">
                                            	<input type="text" name="IcName" value="<?php echo $icon['IcName']; ?>" />
                                            </div>
										</div>
										<div class="da-form-row">
											<div class="da-form-col-3-10">
												<label>ระบุชนิดไอคอน<span class="required">*</span></label>
											</div>
                                            <div class="da-form-col-5-10">
                                            	<select name="IcType">
													<?php if($icon['IcType'] == "menu"){ ?>
                                                	<option value="menu">Menu</option>
                                                	<option value="header">Header</option>
                                                	<option value="gear">Gear</option>
													<option value="system">System</option>
													<?php }
															if($icon['IcType'] == "header"){ ?>
													<option value="header">Header</option>
                                                	<option value="menu">Menu</option>
                                                	<option value="gear">Gear</option>
													<option value="system">System</option>
													<?php }
															if($icon['IcType'] == "gear"){ ?>
													<option value="gear">Gear</option>
													<option value="menu">Menu</option>
													<option value="header">Header</option>
													<option value="system">System</option>
													<?php }
															if($icon['IcType'] == "system"){ ?>
													<option value="system">System</option>
													<option value="menu">Menu</option>
													<option value="header">Header</option>
													<option value="gear">Gear</option>
													<?php } ?>
                                                </select>
												<input type="hidden" name ="IcID" value = "<?php echo $icon['IcID']; ?>">
                                            </div>
                                        </div>
										<?php } ?>
																		
										<div class="da-button-row">
											<input id="clear" class="da-button gray left" type="reset" value="เคลียร์ข้อมูล" name="clear"></input>
											<input id="submit" class="da-button green" type="submit" value="บันทึก" name="submit"></input>
											<input id="cancle" class="da-button red" type="button" onclick="window.location.href='<?php echo base_url(); ?>index.php/showService/'" value="ยกเลิกการแก้ไข" name="cancle"></input>
										</div>
                                    </form>	

								</div>
                            </div>
                        </div>                                        
                    </div>
					</div>
					<!--<a  onclick = 'removeicon( //echo $iconsystem['IcID'];)'>-->

                    


                    	 
                    	
                    