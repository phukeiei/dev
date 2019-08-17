<script>
function mailbox(){$('#mailbox').fadeIn('slow');document.getElementById('trash').style.display ='none';};
function trash(){$('#trash').fadeIn('slow');document.getElementById('mailbox').style.display ='none';};
function removenotice(ID)
{
	var web="<?php echo base_url()?>index.php/notification/removeNotice/"+ID;
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
					<!-- don't complete by golf
						<div class="grid_1">
						   <div class="da-panel-widget">
							  <ul class="da-summary-stat">
								 <li>
									<a href="#" onClick="mailbox()">
									<span class="da-summary-icon" style="background-color:#ea799b;">
									<img src="<?php echo base_url()?>images/icons/white/32/magnifying_glass.png" alt="รายการแจ้งเตือน" />
									</span>
									<span class="da-summary-text">
									<span class="value">รายการแจ้งเตือน</span>
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
									<a href="#" onClick="trash()">
									<span class="da-summary-icon" style="background-color:#ea799b;">
									<img src="<?php echo base_url()?>images/icons/white/32/magnifying_glass.png" alt="ถังขยะ" />
									</span>
									<span class="da-summary-text">
									<span class="value">ถังขยะ</span>
									</span></br>
									</a>
								 </li>
							  </ul>
						   </div>
						</div>
						-->
<div id="mailbox">
                    	<div class="grid_3_center">
                        	<div class="da-panel">
                            	<div class="da-panel-header">
                                	<span class="da-panel-title">
                                        <img src="<?php echo base_url() ?>images/icons/black/16/mail.png" alt="" />
                                        Notification
                                    </span>
                                    
                                </div>
                                <div class="da-panel-content">
                                    <table id="da-ex-datatable-numberpaging" class="da-table2">
                                        <thead>
                                            <tr>
                                                <th style="width:5%"><!--input type="checkbox"--></th>
                                                <th>ระบบงาน</th>
                                                <th>รายละเอียด</th>
                                                <th style="width:10%">วันที่</th>
												<th>Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php  foreach($notice as $notice){ 
											$ID = $this->encrypt->encode($notice['id']);
													$ID = str_replace("/","_",$ID);
													$ID = str_replace("+",":",$ID);
													$ID = str_replace("=","~",$ID);
												 if($notice['state_id']==2){
													
												 ?>
                                            <tr>
                                                <th style="width:5%"><!--input type="checkbox"--></th>
                                                <td>
													<?php echo $notice['StNameT'] ?>
												</td>
                                                <td>
													<a href="<?php echo base_url().'index.php/notification/sendURL/'.$ID ?>" style="text-decoration:none;color:#000;">
														<?php echo $notice['messsage'] ?>
													</a>
												</td>
                                                <td>
													<?php echo $notice['checkindate'];?>
												</td>
												<td>
													<input type="image" src="<?php echo base_url(); ?>/images/icons/color/cross.png" onclick='removenotice(<?php echo $notice['id'];?>)' />
												</td>
                                            </tr>
											<?php  }
												 else{ ?>
                                            <tr>
                                                <th style="width:5%"><!--input type="checkbox"--></th>
                                                <td>
													<span style="color:#bfbfbf;">
														<?php echo $notice['StNameT'] ?>
													</span>
												</td>
                                                <td>
													<a href="<?php echo base_url().'index.php/notification/sendURL/'.$ID ?>" style="text-decoration:none;color:#000;"> 
														<span style="color:#bfbfbf;">
															<?php echo $notice['messsage'] ?>
														</span>
													</a>
												</td>
                                                <td>
													<?php echo $notice['checkindate'];?>
												</td>
												<td>
													<input type="image" src="<?php echo base_url(); ?>/images/icons/color/cross.png" onclick='removenotice(<?php echo $notice['id'];?>)' />
												</td>
                                            </tr>
                                            <?php  } }	?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
</div>
<div id="trash" style="display:none">
						<div class="grid_3_center">
                        	<div class="da-panel">
                            	<div class="da-panel-header">
                                	<span class="da-panel-title">
                                        <img src="images/icons/black/16/mail.png" alt="" />
                                        ถังขยะ
                                    </span>
                                    
                                </div>
                                <div class="da-panel-content">
                                    <table id="da-ex-datatable-numberpaging" class="da-table2">
                                        <thead>
                                            <tr>
                                                <th style="width:5%"><input type="checkbox"></th>
                                                <th>ระบบงาน</th>
                                                <th>รายละเอียด</th>
                                                <th style="width:10%">วันที่</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="checkbox"></td>
                                                <td>
													ระบบกิจการนิสิต
												</td>
                                                <td>
													<a href="www.google.com" style="text-decoration:none;color:#000;">
														เพิ่มข้อมูลการขอทุน  
														<span style="color:#bfbfbf;">
															- นายเขมรัฐ ยื่นขอทุน
														</span>
													</a>
												</td>
                                                <td>
													31/12/56
												</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox"></td>
                                                <td>
													<span style="color:#bfbfbf;">
														ระบบกิจการนิสิต
													</span>
												</td>
                                                <td>
													<a href="www.google.com" style="text-decoration:none;color:#000;"> 
														<span style="color:#bfbfbf;">
															เพิ่มข้อมูลการขอทุน- นายเขมรัฐ ยื่นขอทุน
														</span>
													</a>
												</td>
                                                <td>
													<span style="color:#bfbfbf;">
														31/12/56
													</span>
												</td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
</div>                           
                    </div>
                    
                </div>
