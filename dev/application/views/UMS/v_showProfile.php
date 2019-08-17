                
				
				<!-- Main Content Wrapper -->
                <div id="da-content-wrap" class="clearfix">
                
                	<!-- Content Area -->
                	<div id="da-content-area">
						<div class="grid_3_center">
                        	<div class="da-panel collapsible ">
                            	<div class="da-panel-header">
                                	<span class="da-panel-title">
                                   <img src="<?php echo base_url(); ?>/images/icons/black/32/users_2.png" alt="" />
							Profile
                                    </span>
                                    
                                </div>
                                <div class="da-panel-content">
								<form id="validate-Q" class="da-form">
									<div id="valQ-error" class="da-message error" style="display:none;"></div>
                                        <div class="da-form-row">
										
                                            <div class="da-form-col-3-10">
											
										<?php
											foreach ($user->result_array() as $usr){
											?>
											
											<tr>
											<img src="<?php echo base_url(); ?>/images/User.png" ALIGN="left">
										
												<font size=5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชื่อเข้าใช้งานระบบ   :</font><td> <?php echo $usr['UsLogin']; ?></td><br> 
                                           

												<font size=5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชื่อ - นามสกุล : </font><td><?php echo $usr['UsName']; ?></td><br> 
                                          

												<font size=5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รหัสผู้ใช้  :</font> <td><?php echo $usr['UsID']; ?></td><br> 
                                          

											<font size=5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;E-mail :</font>	<td><?php echo $usr['UsEmail']; ?></td><br> 
                                            <br> 
											</tr>
											<?php
											break;	}
											?>
											</div>
                                           
										</div>	
																		
									
                                    </form>	

								</div>
								
                            </div>
                        </div>


                    
                                                
                    </div>
                    <div id="da-content-area">
                    	<div class="grid_3_center">
                        	<div class="da-panel ">
                            	<div class="da-panel-header">
                                	<span class="da-panel-title">
                                        <img src="<?php echo base_url(); ?>/images/icons/black/32/users_2.png" alt="" />
                                        ข้อมูลกลุ่มงานผู้ใช้ 
                                    </span>
                                    
                                </div>
								
                                <div class="da-panel-content">
                                    <table id="da-ex-datatable-numberpaging" class="da-table">
                                        <thead>
                                            <tr>
                                                <th width="15%">รหัสกลุ่มผู้ใช้</th>
                                                <th width="25%">กลุ่มผู้ใช้งาน(ท)</th>
                                                <th width="25%">กลุ่มผู้ใช้งาน(E)</th>
												<th width="45%">ชื่อระบบ</th>
												
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
											foreach ($usergroup->result_array() as $Ug){
											?>
											<tr>
                                                <td><?php echo $Ug['GpID']; ?></td>
                                                <td><?php echo $Ug['GpNameT']; ?></td>
                                                <td><?php echo $Ug['GpNameE']; ?></td>
												<td><?php echo $Ug['StAbbrE']; ?></td>	
											</tr>
											<?php
												}
											?>
                                        </tbody>										
                                    </table>									
                                </div>								
                            </div>
                        </div>         
                    </div>
                </div>