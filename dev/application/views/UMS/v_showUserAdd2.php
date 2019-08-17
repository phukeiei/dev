	<script type="text/javascript"> $(function() { $("#tabs").tabs(); }); </script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/ums/showUserAdd.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/ums/permission.js"></script>
	<!--<script>
		var keylist="ABCDEFGHIJKLNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&?"
		var temp=''
			function generatepass(plength){
				temp=''
				for (i=0;i<plength;i++)
					temp+=keylist.charAt(Math.floor(Math.random()*keylist.length))
				return temp
			}
			function populateform(enterlength=8){
				document.pgenerate.UsPassword.value=generatepass(enterlength=8)
			}
	</script>-->
                
                <!-- Main Content Wrapper -->
				<div id="da-content-wrap" class="clearfix">
                
                	<!-- Content Area -->
                	<div id="da-content-area">
                
				<div id="sync_form" style="display:none" >
                    	<div class="grid_3_center">
                        	<div class="da-panel ">
                            	<div class="da-panel-header">
                                	<span class="da-panel-title">
                                        <img src="<?php echo base_url(); ?>/images/icons/black/32/users_2.png" alt="" />
                                        รายชื่อผู้ใช้ 
                                    </span>
                                    
                                </div>
								
                                <div class="da-panel-content">
									<form class="da-form" method="post" action="<?php echo base_url(); ?>index.php/UMS/syncHR/syncing" >
										
										  
									   
										<table id="da-ex-datatable" class="da-table">
											<thead>
												<tr>
													<th width="25%">ชื่อ-นามสกุล</th>
													<th width="25%">E-Mail</th>
													<th width="20%">ชื่อเข้าใช้ระบบ</th>
													<th width="7%">ดำเนินการ</th>
												</tr>
											</thead>
											<tbody id="sync_table">
												<tr><td colspan="4">Empty Data To Sync</td>
												</tr>

											</tbody>										
										</table>	
										<div class="da-button-row">
											<input id="clear" class="da-button gray left" type="reset" value="เคลียร์ข้อมูล" name="clear" onclick="clear_data()"></input>
											<input id="submit" class="da-button green" type="submit" value="บันทึก" name="submit"></input>
											<input id="cancel" class="da-button red" type="button" onclick="window.location.href=''" value="ยกเลิก" name="cancle"></input>
										</div>
									</form>
                                </div>								
                            </div>
                        </div>
						
</div>
                            </div>
                        </div>         
                    
                    
                         
