<!-- last edit 27/03/2557 10:40 by golf-->
<script>
function sync(){

	var wgroup = $('#wgroupselect').val();
	var jqxhr = $.get( "<?php echo base_url();?>index.php/UMS/groupassign/search/"+wgroup, function() {//alert( "success" );
	})
	.done(function(data) {
		
		$("#countgroup").html(data);
		$("#history_form").hide();
		$("#countgroup").fadeIn('slow');
	})
	.fail(function() { alert( "error" );
	})
	.always(function() {//alert( "finished" );
	});

}
function wgroup(){
	$("#wgroup_form").fadeIn('slow');
	$("#history_form").hide();
}
function history(){
	$("#history_form").fadeIn('slow');
	$("#wgroup_form").hide();
}
function checkboxselect(name){
	var temp = $('input[name="hidden'+name+'"]').val();
	if(temp == 0){
		$('input[name="hidden'+name+'"]').val(1);
	}else{
		$('input[name="hidden'+name+'"]').val(0);
	}
	
}
</script>
                <!-- Main Content Wrapper -->
                <div id="da-content-wrap" class="clearfix">
                	<!-- Content Area -->
                	<div id="da-content-area">
					<div class="grid_1" style="margin-left:250px">
						   <div class="da-panel-widget">
							  <ul class="da-summary-stat">
								 <li>
									<a href="#" onClick="wgroup()">
									<span class="da-summary-icon" style="background-color:#ea799b;">
									<img src="<?php echo base_url();?>images/icons/white/32/magnifying_glass.png" alt="ข้อมูลประวัติ" />
									</span>
									<span class="da-summary-text">
									<span class="value">Group Assign</span>
									</span></br>
									</a>
								 </li>
							  </ul>
						   </div>
						</div>
						<div class="grid_1">
						   <div class="da-panel-widget">
							  <ul class="da-summary-stat">
								 <li>
									<a href="#" onClick="history()">
									<span class="da-summary-icon" style="background-color:#ea799b;">
									<img src="<?php echo base_url();?>images/icons/white/32/magnifying_glass.png" />
									</span>
									<span class="da-summary-text">
									<span class="value">History</span>
									</span></br>
									</a>
								 </li>
							  </ul>
						   </div>
						</div>
						
                	<!-- Content Area -->
<div id="wgroup_form" style="display:none" >
						<div class="grid_4_center">
                        	<div class="da-panel">
                            	<div class="da-panel-header">
                                	<span class="da-panel-title">
                                        <img src="<?php echo base_url(); ?>/images/icons/black/16/computer_imac.png" alt="" />
                                        ข้อมูลกลุ่มงาน
                                    </span>
                                    
                                </div>
                                <div class="da-panel-content">
									<form class="da-form da-form-inline" method="post" action="<?php echo base_url().'index.php/UMS/groupassign/addgroup'; ?>">
										<div class="da-form-row">
											<label class="da-form-label">กลุ่มผู้ใช้</label>
											<div class="da-form-item">
												<select class="span12" id="wgroupselect">
													<?php foreach($wgroup->result_array() as $wgroup){ ?>
														<option value="<?php echo $wgroup['WgID'];?>"><?php echo $wgroup['WgNameT'];?></option>
													<?php } ?>
												</select>
												<a onclick="sync()" ><img src="<?php echo base_url(); ?>/images/icons/color/find.png" /></a>
											</div>
											
										</div>
										<div class="da-form-row" id="countgroup" style="display:none">
											
										</div>
										
									</form>
                                </div>
                            </div>
                        </div>
</div>
<div id="history_form" style="display:none" >
                    	<div class="grid_4_center">
                        	<div class="da-panel ">
                            	<div class="da-panel-header">
                                	<span class="da-panel-title">
                                        <img src="<?php echo base_url(); ?>/images/icons/black/32/users_2.png" alt="" />
                                        รายงานการเชื่อมต่อข้อมูล 
                                    </span>
                                    
                                </div>
								
                                <div class="da-panel-content">
									<form class="da-form" action="#" >
										
										  
									   
										<table id="da-ex-datatable" class="da-table">
											<thead>
												<tr>
													<th width="7%">No.</th>
													<th width="25%">Filename</th>
													<th width="15%">User</th>
													<th width="20%">Time</th>
													<th width="7%">ดำเนินการ</th>
												</tr>
											</thead>
											<tbody id="sync_table">
												<?php if($syncfile->num_rows() < 1){?>
													<tr><td colspan="5">Empty Data To Sync</td></tr>
												<?php }else{ $i=1;
														foreach($syncfile->result_array() as $file){?>
												<tr>
													<td><?php echo $i++;?></td>
													<td><?php echo $file['syncFilename'];?></td>
													<td><?php echo $file['UsLogin'];?></td>
													<td><?php echo $file['syncTime'];?></td>
													<td><a href="<?php echo base_url()."index.php/UMS/syncHR/filedownload/".$file['syncFilename'];?>"><img src="<?php echo base_url(); ?>/images/icons/color/disk.png" /></a>
														<!--a href="#"><img src="/images/icons/color/cross.png" /></a-->
													</td>
												</tr>
												<?php }}?>
											</tbody>										
										</table>		
									</form>
                                </div>								
                            </div>
                        </div>
						
</div>		                        
                    </div>
                    
                </div>
                
          