<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>


                	<div id="da-content-area">					
						<div class="grid_1">
                        	<div class="da-panel" style="width:280px;height:450px;overflow:scroll;overflow-x: hidden;">
                            	<div class="da-panel-header">
                                	<span class="da-panel-title">
                                        <img src="<?php echo base_url(); ?>images/icons/black/16/computer_imac.png" alt="" />
										<?php foreach($system as $temp){ $sysname = $temp['StNameT']; }?>
											<b><?php echo $sysname;?></b>
                                    </span>
                                </div>
								<?php foreach($system as $sys){ ?>
									<div class="da-panel-content with-padding"> 
										<form class="da-form" style="padding-top:0px;">
										   <fieldset class="da-form-inline">
											
											<legend><b><?php echo $sys['GpNameT'];?></b></legend>
											<div class="Permission" onclick='window.location="<?php echo base_url();?>index.php/UMS/showReport/reportByGroup/<?php echo $sys['GpID'].'/'.$sys['StID'];?>"'>
												<div class="Gear">
												</div>
												<div class="Desc" >
												<img src="<?php echo base_url();?>images/1378991964_people - Copy.png" alt="" />
													 <b><?php echo $sys['num']." "."คน";?></b>
												</div>
											</div>
										 </fieldset>	
										</form>								
									</div> 
								<?php } ?>
							</div>
						</div>
					</div>	
				</div>
