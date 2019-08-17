<script>
function removequestion(QsID)
{
	var web="<?php echo base_url()?>index.php/UMS/showQuestion/remove/"+QsID;
	bootbox.confirm("คุณต้องการลบหรือไม่?", function(result) {
		  if(result==true){
			  window.location.href=web;
		  }
		});
};
$(document).ready(function(){
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
		text: 'คำถามนี้มีอยู่แล้ว กรุณาสร้างใหม่',
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
					<h2><i class="fa fa-question-circle" style="font-size:26px"></i><?php echo nbs(1);?>เพิ่มข้อมูลคำถาม </h2>
					<div style="cursor:pointer" class="button-icon pull-right" data-actions-container=""  data-action-collapse='{"target": ".panel-body,.panel-footer"}'></div>
				</div>
				<form class="form-horizontal row-border" id="validate-form" data-parsley-validate method="post" action="<?php echo base_url(); ?>index.php/UMS/showQuestion/add">	
					<div class="panel-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">คำถามภาษาไทย</label>
							<div class="col-sm-7">
								<input type="text" name="QsDescT" placeholder="คำถามภาษาไทย" required class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">question in English</label>
							<div class="col-sm-7">
								<input type="text" name="QsDescE" placeholder="question in English" required class="form-control"/>
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
					<h2><i class="fa fa-database" style="font-size:26px"></i><?php echo nbs(2);?>ข้อมูลคำถาม</h2>
					<div class="panel-ctrls"></div>
				</div>
				<div class="panel-body no-padding">
					<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>รหัส</th>
								<th>คำถามภาษาไทย</th>
								<th>Question English language</th>
								<th><center>Option</center></th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1;
							foreach ($question->result_array() as $question) { 
								$ID = $this->encryption->encrypt($question['QsID']);
								$ID = str_replace("/","_",$ID);
								$ID = str_replace("+",":",$ID);
								$ID = str_replace("=","~",$ID);
							?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $question['QsDescT'];?></td>
								<td><?php echo $question['QsDescE'];?></td>
								
								<td>
									<center>
										  <i class="fa fa-edit  tooltips" title="แก้ไขข้อมูล" style="cursor:pointer;color:#ecb100;font-size:20px" onclick="window.location.href='<?php echo base_url(); ?>index.php/UMS/showQuestion/edit/<?php echo $ID;?>'"></i>
									&nbsp;<i class="fa fa-times-circle tooltips" title="ลบข้อมูล" style="cursor:pointer;color:red;font-size:20px" onclick='return removequestion(<?php echo $question['QsID'] ?>);'></i>
									</center>
								</td>
							</tr>
							<?php 
							$i+=1;
							} ?>
						</tbody>
					</table>
				</div>
				<div class="panel-footer"></div>
			</div>
		</div>
	</div>
