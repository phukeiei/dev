<style type="text/css"> 
.onmouse:hover{background-color:#f2efef;}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-teal panel-collapsed" data-widget='{"draggable": "false"}'>
			<div class="panel-heading">
				<h2><i class="ti ti-panel" style="font-size:26px"></i><?php echo nbs(1);?>จัดการ template ระบบ</h2>
			</div><br>
			<div class="col-md-12">
				<div class="panel panel-gray">
					<div class="panel-heading">
						<h2><i class="fa fa-cogs" style="font-size:26px"></i><?php echo nbs(2);?>Header</h2>
					</div><br>
					<?php 
						$ID = $this->encryption->encrypt($StID);
						$ID = str_replace("/","_",$ID);
						$ID = str_replace("+",":",$ID);
						$ID = str_replace("=","~",$ID);
					?>
					<div style="cursor:pointer;background:<?php if(isset($tem['ColorHeadTop'])){ echo $tem['ColorHeadTop'];}else{ echo "#75b5e0";}?>;" class="info-tile tile-success onmouse" onclick="window.location='<?php echo base_url();?>index.php/UMS/configSystem/EditHead/<?php echo $ID;?>'">
					<?php 
						$path = $this->config->item('uploads_url');
						if(isset($tem['HeadIcon'])){
							$pathString = $path."header&image=".$tem['HeadIcon'];
						}else{
							$tem['HeadIcon']="back_office_system.png";
							$pathString = $path."header&image=".$tem['HeadIcon'];
						}	
					?>
						<img src="<?php  echo $pathString; ?>" style="height:70px;"/>	
					</div>	
				</div>
			</div>
			<?php if($StID != 0){?>
			<div class="col-md-2">
				<div class="panel panel-gray">
					<div class="panel-heading">
						<h2><i class="fa fa-cogs" style="font-size:26px"></i><?php echo nbs(2);?>Gear</h2>
					</div><br>
					<?php 
						$ID = $this->encryption->encrypt($StID);
						$ID = str_replace("/","_",$ID);
						$ID = str_replace("+",":",$ID);
						$ID = str_replace("=","~",$ID);
					?>
					<div class="col-md-12">
						<div style="cursor:pointer" class="info-tile tile-success onmouse" onclick="window.location='<?php echo base_url();?>index.php/UMS/configSystem/EditGear/<?php echo $ID;?>'">
							<?php $path = $this->config->item('uploads_url');
								  $pathString = $path."gear&image=User-2.png"; ?>
							<img width="60px" height="60px" src="<?php echo $pathString; ?>">	
						</div>	
					</div>
				</div>
			</div>
			<?php }?>
		</div>
	</div>
</div>
