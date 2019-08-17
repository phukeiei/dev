				<script type="text/javascript" src="<?php echo base_url(); ?>/js/ums/showwgroup.js"></script>

<script>
function removeshowwgroup(WgID)
{
	var web="https://se.buu.ac.th/~ums/index.php/UMS/showWGroup/remove/"+WgID;
	
	if(confirm("คุณต้องการลบหรือไม่?")==true){
     window.location.href=web;
   }
	else
	{
		return false;
	}
}

$(document).ready(
	function(){
		$("input[type=checkbox]").click(
			function(){
				var name=$(this).attr('id');
				var value=$(this).is(':checked') ? 1 : 0;
				$('input[name="hidden'+name+'"]').val(value);
			}
		);
	}
);
</script>
                <!-- Main Content Wrapper -->
                <div id="da-content-wrap" class="clearfix">
                
                	<!-- Content Area -->
                	<div id="da-content-area">
						<div class="grid_4_center">
                        	<div id="manage"class="da-panel collapsible">
                            	<div class="da-panel-header">
                                	<span class="da-panel-title">
                                        <img src="<?php echo base_url(); ?>/images/icons/black/16/pencil.png" alt="" /> <!-- แก้ -->
											จัดการข้อมูลกลุ่มผู้ใช้
                                    </span>
                                    
                                </div>
                                <div class="da-panel-content">
								<?php
											$ID = $this->encrypt->encode($edit['WgID']);
											$ID = str_replace("/","_",$ID);
											$ID = str_replace("+",":",$ID);
											$ID = str_replace("=","~",$ID);
								?>
								<form id="validate-WGSer" class="da-form" method="post"action ="<?php echo base_url(); ?>index.php/UMS/showWGroup/update/<?php echo $ID?>"> <!-- แก้ -->
                                    <div id="valWGSer-error" class="da-message error" style="display:none;"></div>
										<div class="da-form-inline">	
											<div class="da-form-row">
												<div class="da-form-col-6-10">
													ชื่อกลุ่มงาน(ท)
													<div class="da-form-item large">
														<input type="text" name="WgNameT" placeholder="ชื่อกลุ่มงานภาษาไทย" value="<?php echo $edit['WgNameT']?>" />
														<img src="<?php echo base_url(); ?>/images/icons/Help.png" style="width:20px;height:20px;"alt=""  title="แก้ไขชื่อกลุ่มงานภาษาไทย" />
													</div>
												</div>
											</div>
											<div class="da-form-row">
												<div class="da-form-col-6-10">
													ชื่อกลุ่มงาน(E)
													<div class="da-form-item large">
														<input type="text"name="WgNameE" placeholder="ชื่อกลุ่มงานภาษาอังกฤษ" value="<?php echo $edit['WgNameE']?>"/>
														<img src="<?php echo base_url(); ?>/images/icons/Help.png" style="width:20px;height:20px;"alt=""  title="แก้ไขชลุ่มงานภาษาอังกฤษ" />
													</div>
												</div>
											</div>
											<div class="da-form-row" style="display:none">
												<label>บริการที่ใช้ได้</label>
												<div class="da-form-item">
													<ul class="da-form-list">
														<li><input type="checkbox" name="sports[]" /> <label>อีเมล์</label></li>
														<li><input type="checkbox" name="sports[]" /> <label>ปฏิทินส่วนตัว</label></li>
													</ul>
												</div>
											</div>
											<div class="da-form-row">
												<label>สิทธิ์การใช้</label>
												<table class="da-table">
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
																<input type="checkbox" name = "<?php echo $sys['GpID'];?>" id="<?php echo $sys['GpID'];?>"<?php echo $check; ?>> 
																<input type="hidden" name = "hidden<?php echo $sys['GpID'];?>" value = "<?php echo $hdcheck;?>">
															</td>
															<td><?php echo $sys['StNameT']; ?>&nbsp; ( <?php echo $sys['GpNameT']; ?> )</td>
														</tr>
													<?php }?>
													</tbody>										
												</table>	
											</div>
											<div class="da-button-row">
												<input id="clear" class="da-button gray left" type="reset" value="เคลียร์ข้อมูล" name="clear"></input>
												<input id="submit" class="da-button green" type="submit" value="บันทึก" name="submit"></input>
												<input id="cancle" class="da-button red" type="button" onclick="window.location.href='<?php echo base_url(); ?>index.php/UMS/showWGroup/'" value="ยกเลิกการแก้ไข" name="cancle"></input>
											</div>
                                    </form>	

								</div>
                            </div>
                        </div>


                    	<div class="grid_4_center">
                        	<div class="da-panel">
                            	<div class="da-panel-header">
                                	<span class="da-panel-title">
                                        <img src="<?php echo base_url(); ?>images/icons/black/16/computer_imac.png" alt="" />
                                        ข้อมูลกลุ่มงาน
                                    </span>
                                    
                                </div>
                                <div class="da-panel-content">
                                    <table id="da-ex-datatable-numberpaging" class="da-table">
                                        <thead>
                                            <tr>
                                                <th width="5%">No.</th>
                                                <th width="25%">ชื่อกลุ่มงาน(ท)</th>
                                                <th width="25%">ชื่อกลุ่มงาน(E)</th>
												<th width="10%">Option</th>
                                            </tr>
                                        </thead>
                                         <tbody>
										<?php $i=1;
											foreach ($wgroup->result_array() as $wgroup) { 
											$ID = $this->encrypt->encode($wgroup['WgID']);
											$ID = str_replace("/","_",$ID);
											$ID = str_replace("+",":",$ID);
											$ID = str_replace("=","~",$ID);
											?>
											 <tr>
												<td><?php echo $i;?></td>
                                                <td><?php echo $wgroup['WgNameT'];//= $objResult->WgNameT; ?></td>
                                                <td><?php echo $wgroup['WgNameE'];//= $objResult->WgNameE; ?></td>
												<td>
													<input class="edit" type="image" src="<?php echo base_url(); ?>/images/icons/color/application_edit.png" onclick="window.location.href='<?php echo base_url(); ?>index.php/UMS/showWGroup/edit/<?php echo $ID?>'"/>
													<?php $web = $wgroup['WgID'];?>
													<input type="image" src="<?php echo base_url(); ?>/images/icons/color/cross.png" onclick='return removeshowwgroup(<?php echo $web ?>);' />
												</td>
											</tr>
											<?php
												$i+=1;
												
											}?>
                                        </tbody>
                                    </table>
                                  
                                </div>
                            </div>
                        </div>
                                                
                
					</div>
                </div>