<script>
function removedepartment(dpID)
{
	var web="<?php echo base_url()?>index.php/UMS/department/remove/"+dpID;
	
	bootbox.confirm("คุณต้องการลบหรือไม่?", function(result) {
		if(result==true){
			window.location.href=web;
		}
	});
}

$(document).ready(function() {
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
		title: 'สำเร็จ',
		text: 'บันทึกข้อมูลเสร็จสมบูรณ์',
		type: 'success',
		icon: 'ti ti-check',
		styling: 'fontawesome'
	});
}

function notics_error(){
	new PNotify({title: 'New Thing',
		title: 'เกิดข้อผิดพลาด!',
		text: 'ไม่สามารถอัพโหลดไฟล์ดังกล่าวได้ เนื่องจากไฟล์อาจมีขนาดใหญ่เกินไปหรือเป็นชนิดของไฟล์ที่ไม่ถูกต้อง',
		type: 'error',
		icon: 'ti ti-close',
		styling: 'fontawesome'
	});
}
</script>
<div class="row">
	<div class="col-md-12">	
		<div class="panel panel-primary panel-collapsed" data-widget='{"draggable": "false"}'>
			<div class="panel-heading">
				<h2>
					<img src="<?php echo base_url(); ?>/images/icons/black/16/pencil.png" alt="" /><?php echo nbs(2);?>เพิ่มข้อมูลหน่วยงาน
				</h2>
				<div style="cursor:pointer" class="button-icon pull-right" data-actions-container="" data-action-collapse='{"target": ".panel-body"}'>
				</div>
			</div>
			<?php
				$ID = $this->encrypt->encode($edit['dpID']);
				$ID = str_replace("/","_",$ID);
				$ID = str_replace("+",":",$ID);
				$ID = str_replace("=","~",$ID);
			?>
			<form id="validate-WGSer" class="da-form" method="post" action ="<?php echo base_url(); ?>/index.php/UMS/department/update/<?php echo $ID;?>">
				<div class="panel-body">
					<div class="form-group">
						<label class="col-sm-1 control-label">ชื่อหน่วยงาน</label>
						<div class="col-sm-5">
							<input type="text" required name="dpName" class="form-control tooltips" data-trigger="hover" data-original-title="ชื่อหน่วยงาน"  value="<?php echo $edit['dpName']?>"/>
						</div>
					</div><br>
					<div class="form-group">
						<div class="col-sm-12 col-sm-offset-0">
							<div class="btn-toolbar">
								<input class="btn-inverse btn pull-left" type="reset" value="เคลียร์ข้อมูล">
								<input class="btn-danger btn pull-right" type="button" onclick="window.location.href='<?php echo base_url(); ?>index.php/UMS/department/'" value="ยกเลิกการแก้ไข" name="cancle"></input>
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
				<h2><img src="<?php echo base_url(); ?>/images/icons/black/16/computer_imac.png" alt="" /><?php echo nbs(2);?>ข้อมูลระบบ</h2>
				<div class="panel-ctrls"></div>
			</div>
			<div class="panel-body no-padding">
				<table id="example" class="table table-striped table-bordered" width="100%">
					<thead>
						<tr>
							<th width="5%">No.</th>
							<th width="25%">ชื่อหน่วยงาน</th>
							
							<th width="10%">Option</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1;
							foreach ($department->result_array() as $department) { 
							$ID = $this->encrypt->encode($department['dpID']);
							$ID = str_replace("/","_",$ID);
							$ID = str_replace("+",":",$ID);
							$ID = str_replace("=","~",$ID);
							?>
							 <tr>
								<td><?php echo $i;?></td>
								<td><?php echo $department['dpName'];//= $objResult->dpName; ?></td>
							   
								<td>
									<input class="edit" type="image" src="<?php echo base_url(); ?>/images/icons/color/application_edit.png" onclick="window.location.href='<?php echo base_url(); ?>index.php/UMS/department/edit/<?php echo $ID?>'"/>
									<?php $web = $department['dpID'];?>
									<input type="image" src="<?php echo base_url(); ?>/images/icons/color/cross.png" onclick='return removedepartment(<?php echo $department['dpID'] ?>);' />
								</td>
							</tr>
							<?php
								$i+=1;
								
							}?>
					</tbody>
				</table>
			</div>
			<div class="panel-footer"></div>
		</div>
	</div>
</div>		
                
          