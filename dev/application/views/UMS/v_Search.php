				<meta charset="UTF-8" />
	<link type="text/css" href="theme/jquery.ui.all.css" rel="stylesheet" />
	<script type="text/javascript" src="jquery-1.4.2.js"></script>
	<script type="text/javascript" src="ui/jquery.ui.core.js"></script>
	<script type="text/javascript" src="ui/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="ui/jquery.ui.tabs.js"></script>
	<script type="text/javascript"> $(function() { $("#tabs").tabs(); }); </script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/js/ums/permission.js"></script>
                
             
                	<!-- Content Area -->
                	<div id="da-content-area">
                    	<div class="grid_3_center">
                        	<div class="da-panel">
                            	<div class="da-panel-header">
                                	<span class="da-panel-title">
                                        <img src="<?php echo base_url(); ?>/images/icons/black/16/cog2.png" alt="" />
										ค้นหา
                            <br />
                                    </span>
                                    
                                </div>
								

						<div class="demo">
						
							<div id="tabs">
							<form class="da-form" method="post" action="<?php echo base_url(); ?>index.php/UMS/search" >
								<ul>
									<li><a href="#tabs-1">A</a></li>
									<li><a href="#tabs-2">B</a></li>
									
								</ul>
									<div id="tabs-1">
										<div class="da-panel-content">
										
									<!--<form class="da-form">-->
										<form id="da-ex-validate1" class="da-form">
                                    	<div id="da-ex-val1-error" class="da-message error" style="display:none;"></div>
                                        <div class="da-form-inline">
										
										     
										</div>
										
								
									<div class="da-form-row">
									<label>
									<div align="center">ระบบผู้ใช้งาน</div>
									</label>
									<div class="da-form-col-2-8">
									
									<select name="Search2">
									<option >..เลือกระบบผู้ใช้งาน..</option>
									 <option value="Application Management System"  <?php if($Search2=="Application Management System"){?>selected<?php }?>>ระบบจัดการระบบงาน</option>
									 <option value="graduate"  <?php if($Search2=="graduate"){?>selected<?php }?>>ระบบบัณฑิตศึกษา</option>
									 <option value="e-Registration"  <?php if($Search2=="e-Registration"){?>selected<?php }?>>ระบบทะเบียนและประมวลผลการศึกษา</option>
									 <option value="E-ASSESS"  <?php if($Search2=="E-ASESS"){?>selected<?php }?>>ระบบการจัดการการศึกษา</option>
									 <option value="E-meeting"  <?php if($Search2=="E-meeting"){?>selected<?php }?>>ระบบจัดการประชุม</option>
									 <option value="Student Activity System"  <?php if($Search2=="Student Activity System"){?>selected<?php }?>>ระบบกิจการนักศึกษา</option>
									 <option value="e-person"  <?php if($Search2=="e-person"){?>selected<?php }?>>ระบบบุคลากร</option>
										
									 
								</select></div>
								
								
								
								
								<br></br>
								<br></br>
									
									<label>
										<div align="center">กลุ่มผู้ใช้งาน</div>
									</label>
									<div class="da-form-col-2-8">
									
									<select name="Search2">
									<option >..เลือกกลุ่มผู้ใช้งาน..</option>
									 <option value="Administrator" <?php if($Search2=="Administrator"){?>selected<?php }?>>ผู้ดูแลระบบ</option>
									 <option value="CEO"  <?php if($Search2=="CEO"){?>selected<?php }?>>ผู้บริหารระดับสูง</option>
									 <option value="Manager"  <?php if($Search2=="Manager"){?>selected<?php }?>>ผู้บริหาร</option>
									 <option value="Officer"  <?php if($Search2=="Officer"){?>selected<?php }?>>เจ้าหน้าที่</option>
									 <option value="Teacher"  <?php if($Search2=="Teacher"){?>selected<?php }?>>อาจารย์ </option>
									 <option value="Student"  <?php if($Search2=="Student"){?>selected<?php }?>>นักศึกษา</option>
									 <option value="Leader"  <?php if($Search2=="Leader"){?>selected<?php }?>>หัวหน้าหน่วยงาน</option>
									 <option value="pesonstaff"  <?php if($Search2=="pesonstaff"){?>selected<?php }?>>เจ้าหน้าที่บุคลากร</option>
									 <option value="Outside"  <?php if($Search2=="Outside"){?>selected<?php }?>>บุคคลนอกองค์กร</option>
										
										  
										  
									 
										
									 
								</select></div>
								
								<br></br>
								<div class="da-button-row">
								<input id="clear" class="da-button gray left" type="reset" value="เคลียร์ข้อมูล" name="clear"></input>
								
								<input   type="submit" name="submit" class="da-button green"   value="Search" ></input>
									
								</div>
								</div>
							</div>
						</div>
									
									<div id="tabs-2">
										<div class="da-panel-content">
							
											<form id="da-ex-validate1" class="da-form" action="<?php echo base_url(); ?>index.php/UMS/search/search >
												<div id="da-ex-val1-error" class="da-message error" style="display:none;"></div>
													<div class="da-form-inline">
									
								
									<div class="da-form-row">
									
									<label>
										<div align="center">กลุ่มผู้ใช้งาน</div>
									</label>
									<div class="da-form-col-2-8">
									
									<select name="Search2">
									<option >..เลือกกลุ่มผู้ใช้งาน..</option>
									 <option value="Administrator"  if($Search2=="Administrator")>ผู้ดูแลระบบ</option>
									 <option value="CEO"  if($Search2=="CEO")>ผู้บริหารระดับสูง</option>
									 <option value="Manager"  if($Search2=="Manager")>ผู้บริหาร</option>
									 <option value="Officer"  if($Search2=="Officer")>เจ้าหน้าที่</option>
									 <option value="Teacher"  if($Search2=="Teacher")>อาจารย์ </option>
									 <option value="Student"  if($Search2=="Student")>นักศึกษา</option>
									 <option value="Leader"  if($Search2=="Leader")>หัวหน้าหน่วยงาน</option>
									 <option value="pesonstaff"  if($Search2=="pesonstaff")>เจ้าหน้าที่บุคลากร</option>
									 <option value="Outside"  if($Search2=="Outside")>บุคคลนอกองค์กร</option>
									
									 
								</select></div>
								<br></br>
											<label>
											<div align="center">Username</div>
										   </label>
										   
                                            <div class="da-form-col-2-8">
                                            	<input name ="Search" type="Search"     placeholder="กรอก Username" />
                                            </div>
								
								<br></br>
										<label>
											<div align="center">ชื่อ-นามสกุล</div>
										</label>
                                            <div class="da-form-col-2-8">
                                            	<input name = "Search" type="Search"    placeholder="กรอกชื่อ-นามสกุล"/>
                                            </div>
								<br></br>					
										<div class="da-button-row">
											<input id="clear" class="da-button gray left" type="reset" value="เคลียร์ข้อมูล" name="clear"></input>
											<input   type="submit" name="submit" class="da-button green"   value="Search" ></input>
										</div>
								</div>
							</div>
						</div>
                        </div> 
						</form>		
				</div>
                            </div>
                        </div>         
                    </div>