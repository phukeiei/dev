<script>
function removegroup(StID)
{
	var web="<?php echo base_url()?>index.php/UMS/showWorkGroup/remove/"+StID;
	bootbox.confirm("คุณต้องการลบหรือไม่?", function(result) {
		  if(result==true){
			  window.location.href=web;
		  }
		});
}
$(document).ready(function(){
// First Time Button Cancel will hide 
	$("#cancle").hide();
//If Button Edit have event will open form to edit
	$(".edit").click(function(){
	//Check button cancel status
		if($('#cancle').is(':hidden'))
		{
			$("#cancle").show();
		}
		else
		{
			$("#cancle").hide();
		}
	});
	
	$(".select2").select2();
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
		text: 'ชื่อกลุ่มงานนี้มีอยู่แล้ว กรุณาเลือกชื่อใหม่',
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
					<h2><i class="fa fa-users" style="font-size:26px"></i><?php echo nbs(2);?>เพิ่มข้อมูลกลุ่มระบบงาน-กำหนดสิทธิ์ </h2>
					<div style="cursor:pointer" class="button-icon pull-right" data-actions-container=""  data-action-collapse='{"target": ".panel-body,.panel-footer"}'></div>
				</div>
				<form class="form-horizontal row-border" id="validate-form" data-parsley-validate method="post" action="<?php echo base_url(); ?>index.php/UMS/showWorkGroup/add">	
					<div class="panel-body">
						<div class="form-group">
							<label class="col-sm-1 control-label">ชื่อกลุ่มงาน(ท)</label>
							<div class="col-sm-5">
								<input type="text" placeholder="ชื่อกลุ่มงานภาษาไทย" name="GpNameT" required class="form-control"/>
							</div>
							<label class="col-sm-1 control-label">ชื่อกลุ่มงาน(E)</label>
							<div class="col-sm-5">
								<input type="text" placeholder="ชื่อกลุ่มงานภาษาอังกฤษ" name="GpNameE" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-1 control-label">คำอธิบาย</label>
							<div class="col-sm-5">
								<textarea style="resize:none" placeholder="คำอธิบายระบบ" name="GpDesc" cols="50" rows="4" class="form-control fullscreen"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-1 control-label">ระบบงานหลัก</label>
							<div class="col-sm-8">
								<select id="select2" class="select2" name="GpStID" style="width: 60%" >
										<option value="">-- กรุณาเลือกระบบ --</option>
									<?php foreach ($opt->result_array() as $opt){?>
										<option value="<?php echo $opt['StID'];?>"><?php echo $opt['StNameT'];?></option>
									<?php }?>
								</select>
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
								<th width="5%">No.</th>
								<th>ชื่อระบบงาน</th>
								<th>ชื่อกลุ่มงาน</th>
								<th>WorkGroup Name</th>
								<th>คำอธิบาย</th>
								<th width="10%"><center>Option</center></th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1;
								foreach ($workgroup->result_array() as $workgroup) { 
									$ID = $this->encryption->encrypt($workgroup['GpID']);
									$ID = str_replace("/","_",$ID);
									$ID = str_replace("+",":",$ID);
									$ID = str_replace("=","~",$ID);
									?>
										<tr>
											<td><?php echo $i++;?></td>
											<td><?php echo $workgroup['StNameT'];?></td>
											<td><?php echo $workgroup['GpNameT'];?></td>
											<td><?php echo $workgroup['GpNameE'];?></td>
											<td><?php echo $workgroup['GpDesc']?></td>
											<td><center>
													  <i class="fa fa-edit tooltips" title="แก้ไขข้อมูล" style="cursor:pointer;color:#ecb100;font-size:20px" onclick="window.location.href='<?php echo base_url(); ?>index.php/UMS/showWorkGroup/edit/<?php echo $ID;?>'"></i>
												&nbsp;<i class="fa fa-list-alt tooltips" title="กำหนดสิทธิ์" style="cursor:pointer;color:green;font-size:20px" onclick="window.location.href='<?php echo base_url(); ?>index.php/UMS/perMissionG/setPermission/<?php echo $ID;?>'"></i>
												&nbsp;<i class="fa fa-times-circle tooltips" title="ลบข้อมูล" style="cursor:pointer;color:red;font-size:20px" onclick='removegroup(<?php echo $workgroup['GpID'];?>)'></i>
												</center>
											</td>
										</tr>
								<?php } ?>
						</tbody>
					</table>
				</div>
				<div class="panel-footer"></div>
			</div>
		</div>
	</div>