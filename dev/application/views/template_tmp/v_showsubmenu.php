<div class="row">
	<div class="col-md-12">	
		<div class="panel panel-teal panel-collapsed" data-widget='{"draggable": "false"}'>
			<div class="panel-heading"><h2><?php echo nbs(2); ?><?php echo $this->session->userdata('MnNameT');?></h2>
				<div class="button-icon panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body"}'>
				</div>
			</div>
			<div class="panel-body">
				<?php foreach($MnSub->result_array() as $MnSub){?>
				<div class="col-md-4">
					<div class="panel panel-green" style="cursor:pointer" onclick='window.location="<?php echo base_url();?>index.php/UMS_Controller/setMenu/<?php echo $MnSub['MnID'];?>"'>
						<div class="panel-heading"><h2><?php echo nbs(2); ?><?php echo $MnSub['MnNameT'];?></h2>
							
						</div>
						<div class="panel-body">
							<?php 	$path = $this->config->item('uploads_url');
									$pathString = $path."menu&image=".$MnSub['MnIcon'];
							?>
							<img width="42" height="42" src="<?php echo $pathString; ?>" alt="" />
							<?php echo nbs(3);?><?php echo $MnSub['MnNameT'];?>
						</div>
					</div>
				</div>
				<?php }?>
			</div>
		</div>
	</div>
</div>