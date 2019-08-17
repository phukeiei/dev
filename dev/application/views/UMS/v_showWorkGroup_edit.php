<script>
function removegroup(StID)
{
	var web="<?php echo base_url()?>index.php/UMS/showWorkGroup/remove/"+StID;
	if(confirm("คุณต้องการลบหรือไม่?")==true){
     window.location.href=web;
   }
	else
	{
		return false;
	}
}
$(document).ready(function() {
	$(".select2").select2();
});
</script>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-teal panel-collapsed" data-widget='{"draggable": "false"}'>
			<div class="panel-heading">
				<h2><i class="fa fa-users" style="font-size:26px"></i><?php echo nbs(2);?>เพิ่มข้อมูลกลุ่มระบบงาน-กำหนดสิทธิ์ </h2>
				<div style="cursor:pointer" class="button-icon pull-right" data-actions-container=""  data-action-collapse='{"target": ".panel-body,.panel-footer"}'></div>
			</div>
			<?php foreach($edit as $row){
					$ID = $this->encryption->encrypt($row['GpID']);
					$ID = str_replace("/","_",$ID);
					$ID = str_replace("+",":",$ID);
					$ID = str_replace("=","~",$ID); 
			?>
			<form class="form-horizontal row-border" id="validate-form" data-parsley-validate method="post" action="<?php echo base_url(); ?>index.php/UMS/showWorkGroup/update/<?php echo $ID;?>">	
				<div class="panel-body">
					<div class="form-group">
						<label class="col-sm-1 control-label">ชื่อกลุ่มงาน(ท)</label>
						<div class="col-sm-5">
							<input type="text" placeholder="ชื่อกลุ่มงานภาษาไทย" name="GpNameT" required class="form-control" value="<?php echo $row['GpNameT'];?>"/>
						</div>
						<label class="col-sm-1 control-label">ชื่อกลุ่มงาน(E)</label>
						<div class="col-sm-5">
							<input type="text" placeholder="ชื่อกลุ่มงานภาษาอังกฤษ" name="GpNameE" class="form-control" value="<?php echo $row['GpNameE'];?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-1 control-label">คำอธิบาย</label>
						<div class="col-sm-5">
							<textarea style="resize:none" placeholder="คำอธิบายระบบ" name="GpDesc" cols="50" rows="4" class="form-control fullscreen"><?php echo $row['GpDesc'];?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-1 control-label">ระบบงานหลัก</label>
						<div class="col-sm-8">
							<select name="GpStID" class="select2" style="width:60%">
								<?php
									foreach ($opt->result_array() as $opt){
										if($opt['StNameT']!=$row['GpStID']){?>
											<option value="<?php echo $opt['StID'];?>"><?php echo $opt['StNameT'];?></option>
								<?php } } ?>	
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12 col-sm-offset-0">
							<div class="btn-toolbar">
								<input class="btn-inverse btn pull-left" type="reset" value="เคลียร์ข้อมูล">
								<input class="btn-danger btn pull-right" type="button" onclick="window.location.href='<?php echo base_url(); ?>index.php/UMS/showWorkGroup/'" value="ยกเลิกการแก้ไข" name="cancle"></input>
								<input class="btn-success btn pull-right" type="Submit" value="บันทึก">
							</div>
						</div>
					</div>
				</div>
			</form>
			<?php }?>
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
							<th width="25%">ชื่อระบบงาน</th>
							<th width="25%">ชื่อกลุ่มงาน</th>
							<th width="20%">WorkGroup Name</th>
							<th width="10%">คำอธิบาย</th>
							<th width="25%"><center>Option</center></th>
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
						<?php
						} ?>
					</tbody>
				</table>
			</div>
			<div class="panel-footer"></div>			
		</div>	
	</div>	
</div>	