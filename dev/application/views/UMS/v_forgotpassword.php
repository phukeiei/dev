 
 <!-- Main Content Wrapper -->
		 
                <div id="da-content-wrap" class="clearfix">
                
                	<!-- Content Area -->
                	<div id="da-content-area">
					
					
						<div class="grid_3_center">
                        	<div class="da-panel ">
                            	<div class="da-panel-header">
                                	<span class="da-panel-title">
                                       <img src="<?php echo base_url(); ?>/images/icons/black/16/pencil.png" alt="" />
											ลืมรหัสผ่าน
                                    </span>
                                    
								</div>
								
						<div class="da-panel-content">
							<br>
								
                                	<form id="validate-forgotpassword" class="da-form"  name="form1">
                                    	<div id="valforgotpass-error" class="da-message error" style="display:none;"></div>
                                        <div class="da-form-inline">
											<div class="da-form-row">
												<label>
												<div align="left">Username</div>
											   </label>
												
												<div class="da-form-col-2-8">
													<input name="txtUsername" type="text"  placeholder=".....  Username  ......"/>
												
												</div>
												
											   <label>
											   
												<div align="left">E-mail</div>
											   </label>
											   
												<div class="da-form-col-2-8">
													<input name="txtEmail" type="email" id="txtEmail" placeholder=".....  E-mail ของท่าน  ......"/>
													
												</div>
											</div>
											<div class="da-button-row">
												<input id="clear" class="da-button gray left" type="reset" value="เคลียร์ข้อมูล" name="clear"></input>
												<input id="submit" class="da-button green" type="submit" value="send" name="submit" name="submit" method="post" action="<?php echo base_url(); ?>index.php/UMS/forgotpassword/forgotpassword" />
											</div>
										</div>
						</div>
							</br>
							<br></br>
						</div>
                                    </form>
                                
                            </div>
                        </div>


                    
                </div>