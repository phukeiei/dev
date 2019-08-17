<script>
	function getname (name) {
		document.getElementById("da-ex-dialog-modal").value = name;
		$('#myModal').modal('hide');
	}

	function removesystem(StID)
	{
		var web="<?php echo base_url()?>index.php/UMS/showSystem/remove/"+StID;
		swal({
		    title: "คุณต้องการลบหรือไม่",
		    type: "warning",
		    showCancelButton: true,
				cancelButtonText: "ยกเลิก",
		    confirmButtonText: "ตกลง",
		    confirmButtonColor: "#4caf50",
		    closeOnConfirm: false
		},function(isConfirm) {
				if (isConfirm == true) {
					window.location.href=web;
				}
		});
	}

$(document).ready(function(){
	<?php
		if($this->session->flashdata('OK') == 1){?>
			notics_succuess();
	<?php	}
		if($this->session->flashdata('OK') == 2){?>
			notics_error();
	<?php }?>

	$(".widget-toggle").click(function(){
			$("#toggle").toggle();
			$("i", this).toggleClass("zmdi zmdi-minus-circle-outline zmdi zmdi-plus-circle-o");
	});
});

function notics_succuess(){
	swal({
			title: "บันทึกข้อมูลเสร็จสมบูรณ์",
			type: "success",
			confirmButtonColor: "#4caf50",
			closeOnConfirm: false,
			timer: 1500
	});
}

function notics_error(){
	swal({
			title: "ชื่อระบบมีอยู่แล้ว กรุณาสร้างใหม่",
			type: "error",
			confirmButtonColor: "#DD6B55",
			closeOnConfirm: false,
			timer: 1500
	});
}
</script>


	<!-- Modal dialog-->
	<div class="modal fade" id="myModal">
		<div class="modal-dialog" role="document" >
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
<!-- End Modal dialog-->


<div class="row">
	<div class="col-md-12">
		<div class="panel panel-blue">
			<div class="panel-heading">
				<h2><i class="fa fa-database" style="font-size:26px"></i><?php echo nbs(2);?>ข้อมูลระบบ</h2>
				<div class="panel-ctrls"></div>
			</div>
			<div class="panel-body no-padding" >
				<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>No.</th>
								<th>ชื่อระบบงาน</th>
								<th>System Name</th>
								<th>ตัวย่อ</th>
								<th>Icon</th>
								<th><center>คัดลอกบางเมนู</center></th>
								<th><center>คัดลอกเมนูทั้งหมด</center></th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$i=1;
							foreach ($showsys->result_array() as $row){//while($objResult = mysql_fetch_object($dbarr)){//foreach ( $dbrr as $row )
							$ID = $this->encryption->encrypt($row['StID']);
							$ID = str_replace("/","_",$ID);
							$ID = str_replace("+",":",$ID);
							$ID = str_replace("=","~",$ID);
							?>
							<tr>
								<td><?php echo $i++;//= $objResult->StID; ?></td>
								<td><?php echo $row['StNameT'];//= $objResult->StNameT; ?></td>
								<td><?php echo $row['StNameE'];//= $objResult->StNameE; ?></td>
								<td><?php echo $row['StAbbrE'];//= $objResult->StAbbrE; ?></td>
								<td><?php echo $row['StIcon'];//= $objResult->StIcon; ?></td>
								<td>
									<center>
										<button class="btn btn-info fa fa-copy" data-toggle="tooltip" title="คัดลอกบางเมนู" onclick="window.location.href='<?php echo base_url(); ?>index.php/UMS/CopySystemmenu/showCopyMenu/<?php echo $row['StID']?>'"></button>
							
									</center>
								</td>
								<td>
									<center>
										<button class="btn btn-warning fa fa-clipboard" data-toggle="tooltip" title="คัดลอกเมนูทั้งหมด"  onclick="window.location.href='<?php echo base_url(); ?>index.php/UMS/CopySystemmenu/export_excel/<?php echo $row['StID']?>'"></button>
									</center>
								</td>
							</tr>
							<?php 
								}
							?>
						</tbody>
					</table>
			</div>
			<div class="panel-footer">
				
			</div>
		</div>
	</div>
</div>
