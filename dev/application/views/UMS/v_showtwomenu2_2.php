		
<script>
	function getname (name) {
		document.getElementById("da-ex-dialog-modal").value = name;
		$("#da-ex-dialog-div").dialog( "close" );
	}				
$(document).ready(function(){
// First Time Button Cancel will hide 
	$("#cancle").hide();
//If Button Edit have event will open form to edit
	$(".edit").click(function(){
	//Check button cancel status
		if($('#cancle').is(':hidden'))
		{
			$("#cancle").show();
		}
		else
		{
			$("#cancle").hide();
		}
	});
});
function removegroup(StID)
{
	var web="<?php echo base_url()?>index.php/UMS/showWorkGroup/remove/"+StID;
	if(confirm("คุณต้องการลบหรือไม่?")==true){
     window.location.href=web;
   }
	else
	{
		return false;
	}
}	
</script>


<?php
$status = isset($status);
$row = isset($rs_cms)?$rs_cms->row():null;

?>

				<div id="da-content-wrap" class="clearfix">
					
                	<!-- Content Area -->
                	<div id="da-content-area">

						<div class="grid_4">
									<div id="da-ex-tabs-plain">
										<!--<ul>
											<li><a href="#">จัดการข้อมูลระบบ</a></li>
											<li><a href="#tab-2">เพิ่มกลุ่มงานผู้ใช้</a></li>
										</ul>-->
				
											<div id="tabs-">
												</div>
											<div id="tabs-2">
												</div>
									</div>
				
				<div id="content-body">
					

						<tbody>
							<div id="da-content-area">
									<div class="grid_4_center">
										<?php	if(isset($Icon)){?>
											<div class="da-panel collapsible">
												<?php }else{?>
													<div class="da-panel ">
															<?php }?>	
															
																	<div class="da-panel-header">
																		<span class="da-panel-title">
																			<img src="<?php echo base_url(); ?>/images/icons/black/16/pencil.png" alt="" />
																				จัดการข้อมูลกลุ่มระบบงาน-กำหนดสิทธิ์
																		</span>
																	</div>
																	<div class="da-panel-content">
																		<form id="validate-WG" class="da-form" method="post" action="<?php echo base_url(); ?>index.php/UMS/showworkgroupsystem/add">
																				<div id="valWG-error" class="da-message error" style="display:none;"></div>
																				<div class="da-form-inline">	
																				<div class="demo">
																					 <script>
																						$(function() {
																						$( "#show-option" ).tooltip({
																						show: {
																						effect: "slideDown",
																						delay: 250
																						}
																						});
																						 });
																					</script>
																
																					<div class="da-form-row">
																							<div class="da-form-col-5-10">
																								<label>ชื่อกลุ่มงาน(ท)<span class="required">*</span></label>
																								<div class="da-form-item large">
																									<input type="text" name="GpNameT" placeholder="ชื่อกลุ่มงานภาษาไทย"/>
																									<img src="<?php echo base_url(); ?>/images/icons/Help.png" style="width:20px;height:20px;"alt=""  title="กรอกชื่อกลุ่มงานภาษาไทย" />
																								</div>
																							</div>
																					</div>
																					<div class="da-form-row">
																						<div class="da-form-col-5-10">
																								<label>ชื่อกลุ่มงาน(E)<span class="required">*</span></label>
																								<div class="da-form-item large">
																									<input type="text" name="GpNameE" placeholder="ชื่อกลุ่มงานภาษาอังกฤษ"/>
																									<img src="<?php echo base_url(); ?>/images/icons/Help.png" style="width:20px;height:20px;"alt=""  title="กรอกชื่อกลุ่มงานภาษาอังกฤษ" />
																								</div>
																							</div>	
																						</div>
																						<div class="da-form-row">
																							<div class="da-form-col-5-10">
																								<label>คำอธิบาย</label>
																								<div class="da-form-item large">
																									<textarea name="GpDesc" placeholder="คำอธิบาย"></textarea>
																									<img src="<?php echo base_url(); ?>/images/icons/Help.png" style="width:20px;height:20px;"alt=""  title="กรอกชคำอธิบาย" />
																								</div>
																							</div>	
																						</div>	
																						<div class="da-form-row">
																							<div class="da-form-col-6-10">
																								<label>ระบบงานหลัก<span class="required">*</span></label>
																								
																								<div class="da-form-item default">
																									<select name="GpStID">
																										<option value="">-- กรุณาเลือกระบบ --</option>
																									<?php foreach ($opt->result_array() as $opt){?>
																										<option value="<?php echo $opt['StID'];?>"><?php echo $opt['StNameT'];?></option>
																									<?php }?>	
																									</select>
																								</div>
																							</div>	
																						</div>	
																					</div>
																				<div class="da-button-row" align="right">									
																					<input id="submit" class="da-button green" type="submit" name="submit" value="บันทึก">
																				</div>	
																			</div>
																		</div>
											
										
											
																		<div class="grid_4">
																			<div class="da-panel">
																				<div class="da-panel-header">
																					<span class="da-panel-title">
																						<img src="<?php echo base_url(); ?>/images/icons/black/16/computer_imac.png" alt="" />
																						กำหนดกลุ่มระบบงาน-กำหนดสิทธิ์
																					</span>
																				</div>
																					<div class="da-panel-content">
																						<table id="da-ex-datatable-numberpaging" class="da-table">
																							<thead>
																								<tr>
																									<th width="5%">No.</th>
																									<th width="25%">ชื่อระบบงาน</th>
																									<th width="25%">ชื่อกลุ่มงาน</th>
																									<th width="20%">WorkGroup Name</th>
																									<th width="10%">คำอธิบาย</th>
																									<th width="25%">Option</th>
																								</tr>
																							</thead>
																							<tbody>
																								<?php $i=1;
																								foreach ($workgroup->result_array() as $workgroup) { 
																									$ID = $this->encrypt->encode($workgroup['GpID']);
																									$ID = str_replace("/","_",$ID);
																									$ID = str_replace("+",":",$ID);
																									$ID = str_replace("=","~",$ID);
																									?>
																										<tr>
																											<td><?php echo $i;?></td>
																											<td><?php echo $workgroup['StNameT'];?></td>
																											<td><?php echo $workgroup['GpNameT'];?></td>
																											<td><?php echo $workgroup['GpNameE'];?></td>
																											<td><?php echo $workgroup['GpDesc']?></td>
																											<td><input class="edit" type="image" src="<?php echo base_url(); ?>/images/icons/color/application_edit.png" onclick="window.location.href='<?php echo base_url(); ?>index.php/UMS/showWorkGroup/edit/<?php echo $ID?>'"/>
																												<input type="image" src="<?php echo base_url(); ?>/images/icons/color/application_side_list.png" onclick="window.location.href='<?php echo base_url(); ?>index.php/UMS/perMissionG/setPermission/<?php echo $ID?>'"/>
																												<input type="image" src="<?php echo base_url(); ?>/images/icons/color/cross.png" onclick='removegroup(<?php echo $workgroup['GpID'];?>)' />
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
				

				
							
																		</form>					
				
									</div>
							</div>		
						</tbody>
			</div>
	</div>
	</div>	
	</div>
									
	
					
				
	