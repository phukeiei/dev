<style type="text/css"> 
.onmouse:hover{background-color:#f2efef;}
.modal-xl {
     width: 85%;
  }
</style>
<script>
	
	function getname (name,src) {
		document.getElementById("HeadIcon").value =name;
		document.getElementById("da-ex-dialog-modal").src =src;
		document.getElementById("da-header-logo2").src =src;
		$('#myModal').modal('hide');
	};
	$(document).ready( function() {
	$('#ColorHeadTop').change( function() {
			var ColorTop = document.getElementById("ColorHeadTop").value;
			$("#da-header-top2").css("background",ColorTop);
		});
	});
</script>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-teal panel-collapsed" data-widget='{"draggable": "false"}'>
			<div class="panel-heading">
				<h2><img src="<?php echo base_url(); ?>/images/icons/black/16/computer_imac.png" alt="" /><?php echo nbs(2);?>ระบบ....</h2>
			</div><br>
			<div class="page-body">
				<div class="col-md-12">
					<?php 
						$ID = $this->encryption->encrypt($StID);
						$ID = str_replace("/","_",$ID);
						$ID = str_replace("+",":",$ID);
						$ID = str_replace("=","~",$ID);
					?>
					<div class="col-md-12">
						<div id="da-header-top2" style="background:<?php echo $tem['ColorHeadTop']?>;" class="info-tile tile-success">
						<?php 
							$path = $this->config->item('uploads_url');
							$pathString = $path."header&image=".$tem['HeadIcon'];
						?>
							<img id="da-header-logo2" src="<?php  echo $pathString; ?>" style="height:70px;"/>	
						</div>	
					</div>
				</div>
				<div class="col-md-12">
					<div class="panel-heading">
						<h2><?php echo nbs(2);?>Console</h2>
					</div>
					<form action="<?php  echo base_url(); ?>index.php/UMS/configSystem/updateHead/<?php echo $ID?>" method="POST" >
					<div class="page-body">
						<div style="cursor:pointer" class="info-tile tile-success">
							<table>				
								<tr>
									<th style="width:230px;">  ICON</th>
									<th>  TOP BG COLOR </th>
								</tr>
								<tr>
									<td>
										<?php 
											$path = $this->config->item('uploads_url');
											$pathString = $path."header&image=".$tem['HeadIcon'];
										?>
										<img src="<?php echo $pathString; ?>" id="da-ex-dialog-modal" data-target="#myModal" data-toggle="modal" style="max-width: 230px;max-height: 55px;">
										<input type="hidden" id="HeadIcon" name="HeadIcon" value="<?php echo $tem['HeadIcon']; ?>" >
									</td>
									<td>
										<input type="text" class="form-control cpicker" data-color-format="hex" id="ColorHeadTop" name="ColorHeadTop" value="<?php echo $tem['ColorHeadTop']?>">
									</td>
								</tr>
							</table><br>
							<?php if($StID == 0){ ?>
							<div class="form-group">
								<div class="col-sm-12 col-sm-offset-0">
									<div class="btn-toolbar">
										<input class="btn-success btn pull-right" type="submit" value="submit" name="submit" style="margin-left:30%;" />
										<input class="btn btn-danger pull-left" type="button" value="cancel" name="Cancel" onclick="window.location.href='<?php echo base_url(); ?>index.php/UMS/configSystem/edit/<?php echo $ID?>'"/>
									</div>
								</div>
							</div>
							<?php }else{?>
							<div class="form-group">
								<div class="col-sm-12 col-sm-offset-0">
									<div class="btn-toolbar">
										<input class="btn btn-primary" value="default" name="default" onclick="window.location.href='<?php echo base_url(); ?>index.php/UMS/configSystem/SetDefault/<?php echo $ID?>'" style="margin-left:30%;">
										<input class="btn-success btn pull-right" type="submit" value="submit" name="submit" />
										<input class="btn btn-danger pull-left" type="button" value="cancel" name="Cancel" onclick="window.location.href='<?php echo base_url(); ?>index.php/UMS/configSystem/edit/<?php echo $ID?>'"/>
									</div>
								</div>
							</div>
							<?php }?>
						</div>
						</form>
					</div>	
				</div>	
			</div>	
		</div>
	</div>
</div>
<!-- Modal dialog-->
	<div class="modal fade" id="myModal">
		<div class="modal-dialog modal-xl" role="document" >
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title" id="myModalLabel">เลือกไอคอน</h3>
				</div>
				<div class="modal-body">
					<?php 
						foreach($icon as $show){ 
								$path = $this->config->item('uploads_url');
								$pathString = $path."header&image=".$show['IcName'];
								$name = $show['IcName'];
						?>
						<input type="image" style="max-width:200px;max-height:150px;" value="submit" src="<?php  echo $pathString; ?>" onclick="getname('<?php echo $name; ?>','<?php echo $pathString; ?>')">
						
					<?php }?>
				</div>
			</div>
		</div>
	</div>	
