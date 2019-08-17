<script>
	function getname (name) {
		document.getElementById("da-ex-dialog-modal").value = name;
		$('#myModal').modal('hide');
	};		
	function removesystem(StID)
	{
		var web="<?php echo base_url()?>index.php/UMS/showSystem/remove/"+StID;
		bootbox.confirm("คุณต้องการลบหรือไม่?", function(result) {
		  if(result==true){
			  window.location.href=web;
		  }
		});
	}	
	$(document).ready(function(){
// First Time Button Cancel will hide 
	$("#cancle").hide();
// If Button Edit have event will open form to edit
	$(".edit").click(function(){
	// Check button cancel status
		if($('#cancle').is(':hidden'))
		{
			$("#cancle").show();
		}
		else
		{
			$("#cancle").hide();
		}
	});
	<?php 
		if($OK == 1){?>
			notics_succuess();
	<?php	} 
		if($OK == 2){?>
			notics_error();
	<?php }?>
});
function notics_succuess(){
	new PNotify({title: 'New Thing',
		title: 'Regular Success',
		text: 'บันทึกข้อมูลเสร็จสมบูรณ์',
		type: 'success',
		icon: 'ti ti-check',
		styling: 'fontawesome'
	});
}

function notics_error(){
	new PNotify({title: 'New Thing',
		title: 'Oh No!',
		text: 'ชื่อระบบมีอยู่แล้ว กรุณาสร้างใหม่',
		type: 'error',
		icon: 'ti ti-close',
		styling: 'fontawesome'
	});
}

</script>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-teal panel-collapsed" data-widget='{"draggable": "false"}'>
				<div class="panel-heading">
					<h2><i class="fa fa-cubes" style="font-size:26px"></i><?php echo nbs(2);?>เพิ่มข้อมูลระบบ</h2>
					<div style="cursor:pointer" class="button-icon pull-right" data-actions-container=""  data-action-collapse='{"target": ".panel-body,.form-group"}'></div>
				</div>
				<form class="form-horizontal row-border" id="validate-form" data-parsley-validate method="post" action="<?php echo base_url(); ?>index.php/UMS/showSystem/add">	
					<div class="panel-body">
						<div class="form-group">
							<label class="col-sm-1 control-label">ชื่อระบบ(ท)</label>
							<div class="col-sm-4">
								<input type="text" placeholder="ชื่อระบบภาษาไทย" name="StNameT" required class="form-control"/>
							</div>
							<label class="col-sm-2 control-label">ชื่อย่อระบบ(ท)</label>
							<div class="col-sm-4">
								<input type="text" placeholder="ชื่อย่อระบบภาษาไทย" name="StAbbrT" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-1 control-label">ชื่อระบบ(E)</label>
							<div class="col-sm-4">
								<input type="text" placeholder="ชื่อระบบภาษาอังกฤษ" name="StNameE" required class="form-control">
							</div>
							<label class="col-sm-2 control-label">ชื่อย่อระบบ(E)</label>
							<div class="col-sm-4">
								<input type="text"  placeholder="ชื่อย่อระบบภาษาอังกฤษ" name="StAbbrE" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-1 control-label">คำอธิบาย</label>
							<div class="col-sm-4">
								<textarea style="resize:none" placeholder="คำอธิบายระบบ" name="StDesc" cols="50" rows="4" class="form-control"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">หน้าแรกของระบบ</label>
							<div class="col-sm-5">
								<input type="text" placeholder="URL หน้าแรกของระบบ" name="StURL" required class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">ไอคอนของระบบ</label>
							<div class="col-sm-5">
								<input type="text" name="StIcon" placeholder="ไอคอนของระบบ" id="da-ex-dialog-modal" data-target="#myModal" data-toggle="modal" required class="form-control">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12 col-sm-offset-0">
								<div class="btn-toolbar">
									<input class="btn-inverse btn pull-left" type="reset" value="เคลียร์ข้อมูล">
									<input class="btn-success btn pull-right" type="Submit" value="บันทึก">
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
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
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-teal">
				<div class="panel-heading">
					<h2><i class="fa fa-database" style="font-size:26px"></i><?php echo nbs(2);?>ข้อมูลระบบ</h2>
					<div class="panel-ctrls"></div>
				</div>
				<div class="panel-body no-padding">
					<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>No.</th>
								<th>ชื่อระบบงาน</th>
								<th>System Name</th>
								<th>ตัวย่อ</th>
								<th>Icon</th>
								<th><center>Option</center></th>
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
								<td><center>
									<i class="fa fa-edit tooltips" title="แก้ไขข้อมูล" style="cursor:pointer;color:#ecb100;font-size:20px" onclick="window.location.href='<?php echo base_url(); ?>index.php/UMS/showSystem/edit/<?php echo $ID?>'"></i>
								&nbsp;<i class="fa fa-list-alt tooltips" title="จัดการเมนู" style="cursor:pointer;color:green;font-size:20px" onclick="window.location.href='<?php echo base_url(); ?>index.php/UMS/showSystem/showMenu/<?php echo $ID?>'"></i>
								&nbsp;<i class="fa fa-times-circle tooltips" title="ลบข้อมูล" style="cursor:pointer;color:red;font-size:20px" onclick='return removesystem(<?php echo $row['StID'] ?>);'></i>
									</center>
								</td>
							</tr>
							<?php 
								}
							?>
						</tbody>
					</table>
				</div>
				<div class="panel-footer"></div>
			</div>
		</div>
	</div>
