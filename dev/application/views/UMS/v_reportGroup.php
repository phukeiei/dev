
		   <!-- Main Content Wrapper -->
                <div id="da-content-wrap" class="clearfix">
                	<!-- Content Area -->
                	<div id="da-content-area">					
						<div class="grid_4">
                        	<div class="da-panel">
                            	<div class="da-panel-header">
                                	<span class="da-panel-title">
                                        <img src="<?php echo base_url(); ?>images/icons/black/16/computer_imac.png" alt="" />
										<?php foreach($group as $temp){ $sysname = $temp['StNameT']; $groupname = $temp['GpNameT'];}?>
											<b><?php echo $sysname;?></b>
                                    </span>
                                </div>
							 <div class="da-panel-content with-padding" > 
								<form class="da-form" style="padding-top:0px;">
								   <fieldset class="da-form-inline">
									<legend><b><?php echo $groupname;?></b></legend>
									<?php $no = 0; foreach($group as $user){ $no = $no+1;?>
									<div class="Permission" href = "#">
										<div class="Gear">
											<?php echo $no.".) ".$user['UsName']."<br />";?>
										</div>
										<div class="Desc" >
										<img src="<?php echo base_url();?>images/1378991964_people - Copy.png" alt="" />
										</div>
									</div>
									<?php } ?>
								 </fieldset>	
								</form>								
							  </div> 
							
							</div>
						</div>
					</div>
				</div>	
				</div>
