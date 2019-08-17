<style type="text/css"> 
.onmouse:hover{background-color:#f2efef;}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-teal panel-collapsed" data-widget='{"draggable": "false"}'>
			<div class="panel-heading">
				<h2><i class="fa fa-gear" style="font-size:26px"></i><?php echo nbs(2);?>จัดการหน้าระบบ</h2>
			</div>
			<div class="panel-body">
				<?php
					$ID = 0;
					$ID = $this->encryption->encrypt($ID);
					$ID = str_replace("/","_",$ID);
					$ID = str_replace("+",":",$ID);
					$ID = str_replace("=","~",$ID);
				?>
				<div class="col-md-2">
					<div style="cursor:pointer" class="info-tile tile-success onmouse" onclick="window.location='<?php echo base_url();?>index.php/UMS/configSystem/Edit/<?php echo $ID;?>'">
						<img width="60" height="60" src="<?php  echo base_url(); ?>images/icons/ums/cog2_2.png" alt="" />
						<span class="col-md-7 pull-right">
							<p>PORTAL</p>
						</span>
					</div>	
				</div>
				<?php 
					foreach ($showsys->result_array() as $row){
					$ID = $this->encryption->encrypt($row['StID']);
					$ID = str_replace("/","_",$ID);
					$ID = str_replace("+",":",$ID);
					$ID = str_replace("=","~",$ID);
					?>
				<div class="col-md-2">
					<div style="cursor:pointer" class="info-tile tile-success onmouse" onclick="window.location='<?php echo base_url();?>index.php/UMS/configSystem/Edit/<?php echo $ID;?>'">
						<?php if($row['StIcon']==null || $row['StIcon'] =='-'){?>
						<img width="60" height="60" src="<?php  echo base_url(); ?>images/icons/ums/cog2_2.png" alt="" />
						<?php }else{
										$path = $this->config->item('uploads_url');
										$pathString = $path."system&image=".$row['StIcon'];
						?>
						<img width="60" height="60" src="<?php echo $pathString; ?>" alt="" />
						<?php }?>
						<span class="col-md-7 pull-right">
							<p><?php echo $row['StAbbrE'];?><?php echo "&nbsp";?></p>
						</span>
					</div>	
				</div>
					<?php }?>
			</div>
		</div>
	</div>
</div>
