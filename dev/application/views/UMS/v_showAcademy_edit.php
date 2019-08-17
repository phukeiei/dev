				<script>
				function removeacademy(AcademyID)
{
	var web="<?php echo base_url()?>index.php/SIAS/showAcademy/remove/"+AcademyID;
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
						<div class="grid_4_center">
                        	<div id="manage" class="da-panel collapsible ">
                            	<div class="da-panel-header">
                                	<span class="da-panel-title">
                                        <img src="<?php echo base_url(); ?>/images/icons/black/16/pencil.png" alt="" />
											ข้อมูลสถานศึกษา
                                    </span>
                                    
                                </div>
								<div class="da-panel-content">
								<?php foreach($edit->result_array() as $show){
												$ID = $this->encrypt->encode($show['AcademyID']);
												$ID = str_replace("/","_",$ID);
												$ID = str_replace("+",":",$ID);
												$ID = str_replace("=","~",$ID);
								
								?>
								<form id="validate-Academy" class="da-form" method="post"action ="<?php echo base_url(); ?>index.php/SIAS/showAcademy/update/<?php echo $ID?>"> <!-- แก้ -->
                                    <div id="valAcademy-error" class="da-message error" style="display:none;"></div>
										<div class="da-form-inline">	
											<div class="da-form-row">
												<div class="da-form-col-8-10">
													<label>ชื่อมหาวิทยาลัย<span class="required">*</span></label>
													<div class="da-form-item large">
														<input type="text" name="AcademyNameT" placeholder="ชื่อมหาวิทยาลัย" value="<?=$show['AcademyNameT'];?>"/>	
														<img src="<?php echo base_url(); ?>/images/icons/Help.png" style="width:20px;height:20px;"alt="" title= "กรอกข้อมูลมหาวิทยาลัยภาษาไทย"/>
													</div>
												</div>
											</div>	
											
											<div class="da-form-row">
												<div class="da-form-col-8-10">
													<label>Name of University<span class="required">*</span></label>
													<div class="da-form-item large">
														<input type="text" name="AcademyNameE" placeholder="Name of University" value="<?=$show['AcademyNameE']?>"/>
														<img src="<?php echo base_url(); ?>/images/icons/Help.png" style="width:20px;height:20px;"alt="" title= "กรอกข้อมูลมหาวิทยาลัยภาษาอังกฤษ"/>
													</div>
												</div>
											</div>		
											<div class="da-form-row">
												<div class="da-form-col-8-10">
													<label>อักษรย่อ(ไทย)<span class="required">*</span></label>
													<div class="da-form-item large">
														<input type="text" name="AcademyAbbrT" placeholder="Name of University" value="<?=$show['AcademyAbbrT']?>"/>
														<img src="<?php echo base_url(); ?>/images/icons/Help.png" style="width:20px;height:20px;"alt="" title= "กรอกอักษรย่อมหาวิทยาลัยภาษาไทย"/>
													</div>
												</div>
											</div>		
											<div class="da-form-row">
												<div class="da-form-col-8-10">
													<label>Abbreviation of University<span class="required">*</span></label>
													<div class="da-form-item large">
														<input type="text" name="AcademyAbbrE" placeholder="Abbreviation of University" value="<?=$show['AcademyAbbrE']?>"/>
														<img src="<?php echo base_url(); ?>/images/icons/Help.png" style="width:20px;height:20px;"alt="" title= "กรอกอักษรย่อมหาวิทยาลัยภาษาอังกฤษ"/>
													</div>
												</div>
											</div>		
																		
											<div class="da-button-row">
												<input id="clear" class="da-button gray left" type="reset" value="เคลียร์ข้อมูล" name="clear"></input>
												<input id="submit" class="da-button green" type="submit" value="บันทึก" name="submit"></input>
												<input id="cancle" class="da-button red" type="button" onclick="window.location.href='<?php echo base_url(); ?>index.php/SIAS/showAcademy/'" value="ยกเลิกการแก้ไข" name="cancle"></input>
											</div>
										</div>
                                    </form>	
								<?php } ?>	
								</div>
                            </div>
                        </div>


                    	<div class="grid_4_center">
                        	<div class="da-panel">
                            	<div class="da-panel-header">
                                	<span class="da-panel-title">
                                         <img src="<?php echo base_url(); ?>/images/icons/black/16/computer_imac.png" alt="" />
                                        ข้อมูลสถาบัน
                                    </span>
                                    
                                </div>
                                <div class="da-panel-content">
                                    <table id="da-ex-datatable-numberpaging" class="da-table">
                                        <thead>
                                            <tr>
                                                <th width="5%">รหัส</th>
                                                <th width="15%">ชื่อมหาวิทยาลัย</th>
												<th width="15%">Name  English  of University</th>
												<th width="10%">อักษรย่อ(ไทย)</th>
												<th width="10%">Abbreviation of University</th>
												<th width="10%">Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1;
											foreach ($academy->result_array() as $academy) { 
												$ID = $this->encrypt->encode($academy['AcademyID']);
												$ID = str_replace("/","_",$ID);
												$ID = str_replace("+",":",$ID);
												$ID = str_replace("=","~",$ID);
											?>
                                            <tr>
												
                                                <td><?php echo $i;?></td>
                                                <td><?php echo $academy['AcademyNameT'];?></td>
                                                <td><?php echo $academy['AcademyNameE'];?></td>
												<td><?php echo $academy['AcademyAbbrT'];?></td>
                                                <td><?php echo $academy['AcademyAbbrE'];?></td>
                                                
												<td>
													<input class="edit" type="image" src="<?php echo base_url(); ?>/images/icons/color/application_edit.png" onclick="window.location.href='<?php echo base_url(); ?>index.php/UMS/showacademy/edit/<?php echo $ID?>'"/>
													<input type="image" src="<?php echo base_url(); ?>/images/icons/color/cross.png" onclick='return removeacademy(<?php echo $academy['AcademyID'] ?>);' />
												</td>
											</tr>
											<?php
												$i+=1;
											} ?>
										</tbody>
                                    </table>
								</div>
                            </div>
                        </div>                            
                    </div>
                </div>