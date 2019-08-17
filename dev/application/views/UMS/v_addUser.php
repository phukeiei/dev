                            <!-- Main Content Wrapper -->
                <div id="da-content-wrap" class="clearfix">
                
                	<!-- Content Area -->
                	<div id="da-content-area">
                        
                    	
                    	
                        
                    	<div class="grid_3_center">
                        	<div class="da-panel">
                            	<div class="da-panel-header">
                                	<span class="da-panel-title">
                                        <img src="<?php echo base_url(); ?>/images/icons/color/wand.png" alt="" />
                                        Add User
                                    </span>
                                    
                                </div>
                                <div class="da-panel-content">
                                	<form id="da-ex-wizard-form" class="da-form" method="post" action="<?php echo base_url(); ?>index.php/UMS/AddTQF/add">
									<div id="da-ex-val1-error" class="da-message error" style="display:none;"></div>
                                    	<fieldset class="da-form-inline">
                                        	<legend>เลือกสิทธิ์</legend>
											
                                        	<div class="da-form-row">
                                            	<div class="da-form-item large">
                                                	<ul class="da-form-list">
														<li><input type="radio" name="GpID" value="500008"/> <img src="<?php echo base_url(); ?>/images/TQF/Admin.png" style="width:100px;height:80px;" alt="" /></li>
														
												
														<li><input type="radio" name="GpID" value="500009"/><img src="<?php echo base_url(); ?>/images/TQF/admin2.png" style="width:100px;height:80px;" alt="" /> </li>
														
													
														<li><input type="radio" name="GpID" value="500010"/> <img src="<?php echo base_url(); ?>/images/TQF/RFTC.png" style="width:100px;height:80px;" alt="" /> </li>
													
														<li><input type="radio" name="GpID" value="500011"/> <img src="<?php echo base_url(); ?>/images/TQF/teacher.png" style="width:100px;height:80px;" alt="" /></li>
														
													</ul>
													<label for="group" class="error" generated="true" style="display:none;"></label>
												</div>
                                            </div>
                                        </fieldset>
                                    	<fieldset class="da-form-inline">
										
                                        	<legend>ข้อมูลผู้ใช้</legend>
                                        	<div class="da-form-row">
                                            	<label>ID <span class="required">*</span></label>
                                                <div class="da-form-item large">
                                                	<input type="text" name="UsPsCode" class="required" />
                                                </div>
                                            </div>
                                        	<div class="da-form-row">
                                                <label>Password <span class="required">*</span></label>
                                                <div class="da-form-item large">
                                                    <input id="UsPassword" type="password" name="UsPassword" />
                                                </div>
                                            </div>
                                            <div class="da-form-row">
                                                <label>Confirm Password <span class="required">*</span></label>
                                                <div class="da-form-item large">
                                                    <input id="cpass" name="cpass" type="password" />
                                                </div>
                                            </div>
											<div class="da-form-row">
                                                <label>ชื่อ - นามสกุล<span class="required">*</span></label>
                                                <div class="da-form-item large">
                                                    <input type="text" name="UsName" />
                                                </div>
                                            </div>
                                            <div class="da-form-row">
                                                <label>Email<span class="required">*</span></label>
                                                <div class="da-form-item large">
                                                    <input type="text" name="UsEmail" />
                                                </div>
                                            </div>
                                        	<div class="da-form-row">
                                            	<label>เลือกกลุ่มผู้ใช้ <span class="required">*</span></label>
                                                <div class="da-form-item large">
                                                	<select name="UsWgID" class="required">
                                                    	<option value="6">นิสิต</option>
                                                    	<option value="5">อาจารย์</option>
                                                    	<option value="3">ผู้บริหาร</option>
                                                        <option value="4">พนักงานทั่วไป</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </fieldset>
                                    
                                    	<fieldset class="da-form-inline">
                                        	<legend>Report</legend>
                                        	<div class="da-form-row">
                                            	<label>ID : 12221 </label><br>
												</div>
												<div class="da-form-row">
												<label>Password : ****** </label><br>
												</div>
												<div class="da-form-row">
												<label>Description: ............... </label><br>
												</div>
												<div class="da-form-row">
												<label>Description: ............... </label><br>
												</div>
												<div class="da-form-row">
												<label>Description: ............... </label><br>
                                                
                                            </div>
                                        	<div class="da-form-row">
                                                <div class="da-form-item large">
                                                	
                                                    <label for="tos" class="error" generated="true" style="display:none"></label>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                                              
                    </div>
                    
                </div>