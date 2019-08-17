	<div class="row"> 
		<div class="col-xs-12">
			<div class="panel panel-teal" data-widget='{"draggable": "false"}'>
				<div class="panel-heading">
					<h2><i class="fa fa-desktop"></i>เมนูระบบ</h2>
				</div>
				<div class="panel-body">
					<?php if(get_cookie('gear'.$this->session->userdata('UsID')) and (count($save) == count($system)))
						{
							foreach($save as $sys) {?>
						<div class="col-xs-12">
							<div class="panel panel-bluegray" data-widget='{"draggable": "false"}'>
								<div class="panel-heading">
									<h2><?php echo $sys;?></h2>
									<div class="button-icon panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body"}'></div>
								</div>
								<div class="panel-body">
									<!--  -->
									<?php print_r($permission); ?>
									<?php foreach($permission as $gear ){
											if($gear['StNameT'] == $sys){?>
										<div class="col-md-4">
											<div class="panel panel-info" style="cursor:pointer" onclick='window.location="<?php echo base_url()."index.php/gear/setGear/".$gear['GpStID']."/".$gear['GpID']."/".str_replace("/",".",$gear['StURL']);?>"'>
												<div class="panel-heading">
													<h2><?php echo $gear['GpNameT'];?></h2>			
												</div>
												<div class="panel-body" >
													<?php if(isset($gear['GpIcon'])){ $path = $this->config->item('uploads_url'); $pathString = $path."gear&image=".$gear['GpIcon'];?> <img class="img-circle" src="<?php echo $pathString;?>" height="42" width="42">
													<?php }else{?><img class="img-circle" src="<?php  echo base_url(); ?>backend/images/icons/ums/cog2_2.png" height="42" width="42"> <?php }?>
													<?php echo nbs(3);if(isset($gear['GpDesc']) && $gear['GpDesc']!=NULL){ echo $gear['GpDesc']; }else{ echo $gear['GpNameT'];}?>
												</div>
											</div>
										</div>
									<?php }}?>	
								</div>		
							</div>		
						</div>
						<?php } 
						}else { 
						// echo "IN";
						foreach($system as $sys) {?>
					<div class="row"> 
						<div class="col-xs-12">
							<div class="panel panel-default" data-widget='{"draggable": "false"}'>
								<div class="panel-heading">
									<h2><?php echo $sys['StNameT'];?></h2>
									<div class="panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body"}'></div>
								</div>
								<div class="panel-body">
									<!--  -->
									<?php foreach($permission as $gear ){
											if($gear['StNameT'] == $sys['StNameT']){?>
									<a href='<?php echo base_url();?>index.php/gear/setGear/<?php echo $sys['StID']."/".$gear['GpID']."/".str_replace("/",".",$gear['StURL']);?>'>		
										<div class="col-md-4">
											<div class="panel panel-default">
												<div class="panel-heading">
													<h2><?php echo $gear['GpNameT'];?></h2>						
												</div>
												<div class="panel-body" href='<?php echo base_url();?>index.php/gear/setGear/<?php echo $sys['StID']."/".$gear['GpID']."/".str_replace("/",".",$gear['StURL']);?>'>
													<?php if(isset($gear['GpIcon'])){ $path = $this->config->item('uploads_url'); $pathString = $path."gear&image=".$gear['GpIcon'];?> <img class="img-circle" src="<?php echo $pathString;?>" height="42" width="42">
													<?php }else{?><img class="img-circle" src="<?php  echo base_url(); ?>backend/images/icons/ums/cog2_2.png" height="42" width="42"> <?php }?>
													<?php if(isset($gear['GpDesc']) && $gear['GpDesc']!=NULL){ echo $gear['GpDesc'];}else{echo $gear['GpNameT'];} ?>
												</div>
											</div>
										</div>
									</a>
									<?php }}?>	
								</div>		
							</div>		
						</div>		
					</div>
						<?php }}?>
				</div>		
			</div>
		</div>
	</div>
	

