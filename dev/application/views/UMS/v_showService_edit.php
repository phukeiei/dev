				
<script>
	function getname (name) {
		document.getElementById("da-ex-dialog-modal").value = name;
		$("#da-ex-dialog-div").dialog( "close" );
	}					
	function removeservice(SvID)
{
	var web="<?php echo base_url()?>index.php/UMS/showService/remove/"+SvID;
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
						<div class="grid_3_center">
                        	<div id="manage" class="da-panel collapsible">
                            	<div class="da-panel-header">
                                	<span class="da-panel-title">
                                        <img src="<?php echo base_url(); ?>/images/icons/black/16/pencil.png" alt="" />
											จัดการข้อมูลข้อมูลบริการ
                                    </span>
                                    
                                </div>
                                <div class="da-panel-content">
								<form id="validate-Service" class="da-form" method="post" action="<?php  echo base_url(); ?>index.php/UMS/showService/update/<?php echo $show['SvID']?>">
									<div id="valS-error" class="da-message error" style="display:none;"></div>
										<div class="da-form-inline">	
											<div class="da-form-row">
												<div class="da-form-col-6-10">
													<label>ชื่อบริการ(ท)<span class="required">*</span></label>
													<div class="da-form-item large">
														<input type="text" name="SvNameT" value="<?php echo $show['SvNameT']?>"  placeholder="ชื่อบริการภาษาไทย"/>	
														<img src="<?php  echo base_url(); ?>/images/icons/Help.png" style="width:20px;height:20px;"alt=""  title="แก้ไขชื่อบริการภาษาไทย" />
													</div>
												</div>		
											</div>		
												
											<div class="da-form-row">
												<div class="da-form-col-6-10">
													<label>ชื่อบริการ(E)<span class="required">*</span></label>
													<div class="da-form-item large">
														<input type="text" name="SvNameE" value="<?php echo $show['SvNameE']?>" placeholder="ชื่อบริการภาษาอังกฤษ"/>
														<img src="<?php  echo base_url(); ?>/images/icons/Help.png" style="width:20px;height:20px;"alt="" title="แก้ไขชื่อบริการภาษาอังกฤษ"/>
													</div>
												</div>
											</div>
											<div class="da-form-row">
												<div class="da-form-col-6-10">
													<label>URL<span class="required">*</span></label>
													<div class="da-form-item large">
														<input type="text" name="SvURL" value="<?php echo $show['SvURL']?>" placeholder="URL"/>
														<img src="<?php  echo base_url(); ?>/images/icons/Help.png" style="width:20px;height:20px;"alt=""  title="แก้ไข  URL" />
													</div>
												</div>		
											</div>		
											<div class="da-form-row">
												<div class="da-form-col-6-10">
													<label>Icon<span class="required">*</span></label>
													<div class="da-form-item large">
														<input type="text" name="SvIcon" value="<?php echo $show['SvIcon']?>" id="da-ex-dialog-modal" placeholder="ไอคอนบริการ"/>
														<img src="<?php  echo base_url(); ?>/images/icons/Help.png" style="width:20px;height:20px;"alt=""  title="เลือก ICON" />
														<div id="da-ex-dialog-div" class="no-padding">
															<form>
																<div class="da-form-inline">
																	<?php  foreach($showicon->result_array() as $icon){
																				$path = $this->config->item('uploads_url');
																				$pathString = $path.$icon['IcType']."&image=".$icon['IcName'];?>
																		<input type="image" value="submit" src="<?php $pathString;?>" onclick="getname('<?php echo $icon['IcName'];?>')">
																	<?php }?>
																</div>
															</form>
														</div>
													</div>
												</div>			
											</div>			

											<div class="da-button-row">
												<input id="clear" class="da-button gray left" type="reset" value="เคลียร์ข้อมูล" name="clear"></input>
												<input id="submit" class="da-button green" type="submit" value="บันทึก" name="submit"></input>
												<input id="cancle" class="da-button red" type="button" onclick="window.location.href='<?php  echo base_url(); ?>index.php/UMS/showService/'" value="ยกเลิกการแก้ไข" name="cancle"></input>
											</div>
										</div>
                                    </form>	

								</div>
                            </div>
                        </div>


                    	<div class="grid_3_center">
                        	<div class="da-panel">
                            	<div class="da-panel-header">
                                	<span class="da-panel-title">
                                        <img src="<?php  echo base_url(); ?>/images/icons/black/32/computer_imac.png" alt="" />
                                       ข้อมูลบริการ
                                    </span>
                                    
                                </div>
                                <div class="da-panel-content">
                                    <table id="da-ex-datatable-numberpaging" class="da-table">
                                        <thead>
                                            <tr>
                                                <th width="5%">No.</th>
                                                <th width="10%">ชื่อบริการ(ท)</th>
                                                <th width="15%">ชื่อบริการ(อ)</th>
                                                <th width="10%">URL</th>
                                                <th width="5%">Icon</th>
												<th width="10%">Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  $i=1;
											foreach ($service->result_array() as $service) { ?>
                                            <tr>
												<td><?php  echo $service['SvID'];?></td>
                                                <td><?php echo $service['SvNameT'];?></td>
                                                <td><?php echo $service['SvNameE'];?></td>
                                                <td><?php echo $service['SvURL'];?></td>
                                                <td><?php echo $service['SvIcon']?></td>
												<td>
													<input class="edit" type="image" src="<?php  echo base_url(); ?>/images/icons/color/application_edit.png" onclick="window.location.href='<?php  echo base_url(); ?>index.php/UMS/showService/edit/<?php echo $service['SvID']?>'"/>
													<input type="image" src="<?php  echo base_url(); ?>/images/icons/color/cross.png" onclick='return removeservice(<?php  echo $service['SvID'] ?>);' />
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