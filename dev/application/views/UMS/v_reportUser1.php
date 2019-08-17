<style type="text/css"> .onmouse:hover{background-color:#f2efef;}</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<?php  
		foreach($system as $systemp){
			$lastarray = $systemp['StNameT'];
			
			}
		  ?>

<script src="<?php echo base_url();?>js/ums/highcharts.js"></script>
<script src="<?php echo base_url();?>js/exporting.js"></script>
		   <!-- Main Content Wrapper -->
                <div id="da-content-wrap" class="clearfix">
                
                	<!-- Content Area -->
                	<div id="da-content-area" >
						
						
                    	<div class="grid_4_center">
                        	<div class="da-panel-widget">
                                <h1>รายงานผู้ใช้ในระบบ</h1>
								<hr />
                                <ul class="da-summary-stat">
                                	
									<?php foreach ($system as $sys) { 
												if($sys['ColorHeadTop']){
													$bgcl = $sys['ColorHeadTop'];
												}
												else{
													$bgcl = "#656565";
												}
												if($sys['StIcon']){
													$hic = $sys['StIcon'];
												}
												else{
													$hic = "cog.png";
												}
													
												$path = $this->config->item('uploads_url');
												$pathString = $path."system&image=".$hic;
									?>
                                    <li>
                                    	<a href="<?php echo base_url();?>index.php/UMS/showReport/reportSystem/<?php echo $sys['StID'];?>">
                                            <span class="da-summary-icon" style="background-color:<?php echo $bgcl; ?>;">
                                                <img src="<?php echo $pathString; ?>" alt="" />
                                            </span>
                                            <span class="da-summary-text">
                                                
                                                <span class="value"><?php echo $sys['StNameT'];?></span>
												<span class="label"><?php echo $sys['num']."ผู้ใช้";?></span>
                                            </span>
                                        </a>
                                    </li>
									<?php }?>
                                </ul>
								
                            </div>
                        </div>
						
					</div>
				</div>	
