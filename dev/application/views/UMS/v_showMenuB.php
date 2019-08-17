<script>
	function getname (name) {
		document.getElementById("da-ex-dialog-modal").value = name;
		$("#da-ex-dialog-div").dialog( "close" );
	}					
</script>	
				<!-- Main Content Wrapper -->
                	<!-- Content Area -->
    <div class="row">
		<div class="col-md-12">
			<div class="panel panel-teal panel-collapsed" data-widget='{"draggable": "false"}'>
				<div class="panel-heading">
					<h2><img src="<?php echo base_url(); ?>/images/icons/black/16/computer_imac.png" alt="" /><?php echo nbs(2);?> กำหนดเมนูระบบ</h2>
					<div style="cursor:pointer" class="button-icon pull-right" data-actions-container=""  data-action-collapse='{"target": ".panel-body,.form-group"}'></div>
				</div>
				<div class="panel-body">
				<?php  
					$MnStID = $this->encryption->encrypt($MnStID);
					$ID = str_replace("/","_",$MnStID);
					$ID = str_replace("+",":",$ID);
					$MnStID = str_replace("=","~",$ID);
				?>
					<i class="fa fa-plus tooltips pull-right" title="เพิ่มข้อมูล" style="cursor:pointer;color:green;font-size:20px" onclick="window.location.href='<?php echo base_url(); ?>index.php/UMS/showSystem/addMain/<?php echo $MnStID;?>'"></i>
				</div>
            </div>   
		</div>
	</div>