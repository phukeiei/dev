<script>
	function getname (name) {
		document.getElementById("da-ex-dialog-modal").value = name;
		$('#myModal').modal('hide');
	}					
	function removesystem(StID)
	{
		
		var web="<?php echo base_url()?>index.php/UMS/showSystem/remove/"+StID;
		if(confirm("คุณต้องการลบหรือไม่?")==true){
		 window.location.href=web;
	   }
		else
		{
			return false;
		}
	}	
</script>
<!-- Main Content Wrapper -->
<div id="da-content-wrap" class="clearfix">
	<?php //if(isset($ok)){ echo $ok;}else{ echo "No return";} ?>
	<?php if($OK == 2){?>
		<div id="showpopupdup">ชื่อระบบมีอยู่แล้ว กรุณาเลือกชื่อใหม่</div>
	<?php }
		if($OK == 1){?>
		<div id="showpopup">บันทึกข้อมูลเสร็จสมบูรณ์</div>
	<?php }?>
	<!-- Content Area -->
<div id="da-content-area">
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-teal panel-collapsed" data-widget='{"draggable": "false"}'>
			<div class="panel-heading">
				<h2><i class="fa fa-cubes" style="font-size:26px"></i><?php echo nbs(2);?>เพิ่มข้อมูลระบบ</h2>
				<div style="cursor:pointer" class="button-icon pull-right" data-actions-container=""  data-action-collapse='{"target": ".panel-body,.form-group"}'></div>
			</div>
			<?php foreach ($edit as $edit){
					$ID = $this->encryption->encrypt($edit['StID']);
					$ID = str_replace("/","_",$ID);
					$ID = str_replace("+",":",$ID);
					$ID = str_replace("=","~",$ID);
			?>
			<form id="validate-System" class="form-horizontal row-border" method="post" action="<?php echo base_url(); ?>index.php/UMS/showSystem/update/<?php echo $ID;?>">
				<div class="panel-body">
					<div class="form-group">
						<label class="col-sm-1 control-label">ชื่อระบบ(ท)</label>
						<div class="col-sm-5">
							<input type="text" name="StNameT" placeholder="ชื่อระบบภาษาไทย" required class="form-control" value="<?php echo $edit['StNameT'];?>"/>
						</div>
						<label class="col-sm-1 control-label">ชื่อย่อระบบ(ท)</label>
						<div class="col-sm-5">
							<input type="text" name="StAbbrT" placeholder="ชื่อย่อระบบภาษาไทย" class="form-control" value="<?php echo $edit['StAbbrT'];?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-1 control-label">ชื่อระบบ(E)</label>
						<div class="col-sm-5">
							<input type="text" name="StNameE" placeholder="ชื่อระบบภาษาอังกฤษ" required class="form-control" value="<?php echo $edit['StNameE'];?>">
						</div>
						<label class="col-sm-1 control-label">ชื่อย่อระบบ(E)</label>
						<div class="col-sm-5">
							<input type="text" name="StAbbrE" placeholder="ชื่อย่อระบบภาษาอังกฤษ" class="form-control" value="<?php echo $edit['StAbbrE'];?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-1 control-label">คำอธิบาย</label>
						<div class="col-sm-5">
							<textarea style="resize:none" placeholder="คำอธิบายระบบ" name="StDesc" id="txtarea1" cols="50" rows="4" class="form-control"><?php echo $edit['StDesc'];?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">หน้าแรกของระบบ</label>
						<div class="col-sm-5">
							<input type="text" name="StURL" placeholder="URL หน้าแรกของระบบ" required class="form-control" value="<?php echo $edit['StURL'];?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">ไอคอนของระบบ</label>
						<div class="col-sm-5">
							<input type="text" name="StIcon" placeholder="ไอคอนของระบบ" id="da-ex-dialog-modal" data-toggle="modal" required class="form-control" data-target="#myModal" data-toggle="modal" value="<?php echo $edit['StIcon'];?>">
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
			<?php } ?>
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
							<th width="30%">ชื่อระบบงาน</th>
							<th width="30%">System Name</th>
							<th width="10%">ตัวย่อ</th>
							<th width="5%">Icon</th>
							<th width="25%"><center>Option</center></th>
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
								<center><i class="fa fa-edit tooltips" title="แก้ไขข้อมูล" style="cursor:pointer;color:#ecb100;font-size:20px" onclick="window.location.href='<?php echo base_url(); ?>index.php/UMS/showSystem/edit/<?php echo $ID;?>'"></i>
								&nbsp;<i class="fa fa-list-alt tooltips" title="จัดการเมนู" style="cursor:pointer;color:green;font-size:20px" onclick="window.location.href='<?php echo base_url(); ?>index.php/UMS/showSystem/showMenu/<?php echo $ID;?>'"></i>
								&nbsp;<i class="fa fa-times-circle tooltips" title="ลบข้อมูล" style="cursor:pointer;color:red;font-size:20px" onclick='return removesystem(<?php echo $row['StID'];?>);'></i>
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
