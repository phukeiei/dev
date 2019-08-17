<script>
	function getname (name) {
		document.getElementById("da-ex-dialog-modal").value = name;
		$("#myModal").modal("hide");
	}
	// $(document).ready(function(){
		// $("#myModal").modal-dialog{width:75%;}
		
	// });	
</script>
<style>
	.modal-xl {
     width: 85%;
  }
</style>
<div class="row">
	<div class="col-md-12">	
		<div class="panel panel-teal panel-collapsed" data-widget='{"draggable": "false"}'>
			<div class="panel-heading"><h2><i class="fa fa-bars" style="font-size:24px"></i><?php echo nbs(2); ?>จัดการข้อมูลเมนู</h2>
				<div class="button-icon panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body,.panel-footer"}'>
				</div>
			</div>
			<?php foreach($edit as $show){
				$MnStID = $this->encryption->encrypt($show['MnStID']);
				$ID = str_replace("/","_",$MnStID);
				$ID = str_replace("+",":",$ID);
				$MnStID = str_replace("=","~",$ID);
			?>
			<form class="form-horizontal row-border" id="validate-form" data-parsley-validate method="post" action="<?php  echo base_url(); ?>index.php/UMS/showSystem/addMenu1">	
				<div class="panel-body">
					<input type="hidden" name="MnStID" value="<?php echo $show['MnStID']?>"/>
					<div class="form-group">
						<label class="col-sm-1 control-label">ชื่อเมนู(ท)</label>
						<div class="col-sm-5">
							<input type="text" name="MnNameT" placeholder="ชื่อเมนูภาษาไทย" required class="form-control"/>
						</div>
						<label class="col-sm-1 control-label">ชื่อเมนู(E)</label>
						<div class="col-sm-5">
							<input type="text" name="MnNameE" placeholder="ชื่อย่อระบบภาษาไทย" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-1 control-label">URL</label>
						<div class="col-sm-5">
							<input type="text" name="MnURL" placeholder="ชื่อย่อระบบภาษาไทย" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-1 control-label">คำอธิบาย</label>
						<div class="col-sm-5">
							<textarea style="resize:none" placeholder="คำอธิบายระบบ" name="MnDesc" cols="50" rows="4" class="form-control"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">ไอคอนของระบบ</label>
						<div class="col-sm-5">
							<input type="text" name="MnIcon" placeholder="ไอคอนของระบบ" id="da-ex-dialog-modal" data-target="#myModal" data-toggle="modal" required class="form-control" data-toggle="modal">
						</div>
					</div>
				</div>
				<input type="hidden" name="MnParentMnID" value="<?php echo $show['MnID']?>"/>
				<input type="hidden" name="MnLevel" value="<?php echo $show['MnLevel']+1?>"/>
				<?php }?>
				<div class="panel-footer">
					<div class="col-sm-12 col-sm-offset-0">
						<div class="btn-toolbar">
							<input class="btn-inverse btn pull-left" type="reset" value="เคลียร์ข้อมูล">
							<a class="btn-danger btn pull-right" href='<?php  echo base_url(); ?>index.php/UMS/showSystem/showMenu/<?php echo $MnStID ?>' value="ยกเลิก" name="cancle">ยกเลิก</a>
							<input class="btn-success btn pull-right" type="Submit" value="บันทึก">
						</div>
					</div>
				</div>
			</form>	
		</div>	
	</div>	
</div>
<!-- Modal dialog-->
	<div class="modal fade" id="myModal">
		<div class="modal-dialog modal-xl" role="document" >
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title" id="myModalLabel">เลือกไอคอนของระบบ</h3>
				</div>
				<div class="modal-body">
					<?php foreach($showicon->result_array() as $icon){?>
						<input type="image" style="max-width:200px;max-height:100px;" placeholder="ไอคอนของระบบ" <?php $path = $this->config->item('uploads_url'); $pathString = $path.$icon['IcType']."&image=".$icon['IcName']; ?>src="<?php echo $pathString; ?>" onclick="getname('<?php echo $icon['IcName'];?>')">
					<?php }?>
				</div>
			</div>
		</div>
	</div>