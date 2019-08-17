<style type="text/css"> 
.onmouse:hover{background-color:#f2efef;}
.modal-xl {
     width: 85%;
  }
</style>
<script>
	$(document).on("click", ".onmouse", function () {
     var GpID = $(this).data('id');
	 $(".modal-body #GpID").val(GpID);
	});
</script>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-teal panel-collapsed">
			<div class="panel-heading">
				<h2><i class="fa fa-pencil-square-o" style="font-size:25px"></i><?php echo nbs(2);?>จัดการ icon Gear</h2>
			</div>
			<div class="panel-body">
				<?php  
					$i=1;
					// echo "<pre>";
					// print_r($permission);
					// echo "</pre>";
					foreach($permission as $gear )
					{
							$ID = $this->encryption->encrypt($gear['GpID']);
							$ID = str_replace("/","_",$ID);
							$ID = str_replace("+",":",$ID);
							$GpID = str_replace("=","~",$ID);
							$ID = $this->encryption->encrypt($gear['GpStID']);
							$ID = str_replace("/","_",$ID);
							$ID = str_replace("+",":",$ID);
							$GpStID = str_replace("=","~",$ID);
				?>
				<div class="col-md-4">
					<div style="cursor:pointer" class="info-tile tile-success onmouse" data-id="<?php echo $GpID;?>" data-target="#myModal" data-toggle="modal" >
						<?php if($gear['GpIcon']!=Null){
							$path = $this->config->item('uploads_url');
							$pathString = $path."gear&image=".$gear['GpIcon'];
						?>
							<img width="60px" height="60px" src="<?php echo $pathString; ?>">
						<?php }else{ 
							$path = $this->config->item('uploads_url');
							$pathString = $path."gear&image=User-2.png";
						?>
							<img width="60px" height="60px" src="<?php echo $pathString; ?>">
						<?php }?>
						<span class="col-md-10 pull-right">
							<p><?php echo $gear['GpNameT'];?></p>
						</span>
					</div>	
				</div>
					<?php $i++; }?>
			</div>
		</div>
	</div>
</div>
<!-- Modal dialog-->
<?php //foreach($permission as $gear ){ ?>
	<div class="modal fade" id="myModal">
		<div class="modal-dialog" >
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title">เลือกไอคอนของระบบ</h3>
				</div>
				<div class="row">
					<div class="modal-body">
						<?php foreach($icon as $show){ ?>
							<form class="form-horizontal row-border" action="<?php echo base_url(); ?>index.php/UMS/configSystem/updateGear/<?php echo $GpStID;?>" method="POST">
								<div class="col-md-4 col-sm-4">
									<input type="hidden" name="GpID" id="GpID" value="">
									<input type="hidden" name="Icon" value="<?php echo $show['IcName'];?>">
									<?php 
										$path = $this->config->item('uploads_url');
										$pathString = $path."gear&image=".$show['IcName'];
									?>
									<input style="max-width:100px;max-height:100px;" type="image" value="submit" src="<?php echo $pathString;?>">
								</div>
							</form>
						<?php }?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php //} ?>