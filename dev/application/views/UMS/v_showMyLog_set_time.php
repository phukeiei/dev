<script>
$(document).ready(function(){
	$('#TimeFrom').datepicker({
		format: 'yyyy/mm/dd',
		todayHighlight: true,
		autoclose: true
	});

	$('#TimeTo').datepicker({
		maxDate: 0,
		format: 'yyyy/mm/dd',
		todayHighlight: true,
		autoclose: true
	});

});
</script>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-teal panel-collapsed" data-widget='{"draggable": "false"}'>
			<div class="panel-heading">
				<h2><i class="fa fa-search" style="font-size:26px"></i><?php echo nbs(2);?>กำหนดช่วงเวลาในการค้นหา</h2>
				<div style="cursor:pointer" class="button-icon pull-right" data-actions-container=""  data-action-collapse='{"target": ".panel-body,.form-group"}'></div>
			</div>
			<form class="form-horizontal row-border" id="validate-form" data-parsley-validate method="post" action="<?php echo base_url(); ?>index.php/UMS/showLog/setTime">	
				<div class="panel-body">
					<div class="form-group">
						<label class="col-sm-1 control-label">ระหว่าง วันที่</label>
						<div class="col-lg-11">
							<div class="input-daterange input-group">
								<input type="text" class="form-control" name="TimeFrom" id="TimeFrom" value="<?php echo $TimeFrom;?>"/>
								<span class="input-group-addon">ถึง</span>
								<input type="text" class="form-control" name="TimeTo" id="TimeTo" value="<?php echo $TimeTo;?>" />
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12 col-sm-offset-0">
							<div class="btn-toolbar">
								<input class="btn-inverse btn pull-left" type="reset" value="เคลียร์ข้อมูล">
								<input class="btn-primary btn pull-right" type="Submit" value="ค้นหา">
							</div>
						</div>
					</div>
				</div>
			</form>		
		</div>
	</div>
</div>
<?php if(isset($log)){?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-teal">
			<div class="panel-heading">
				<h2><i class="fa fa-history" style="font-size:26px"></i><?php echo nbs(2);?>ประวัติการเข้าใช้ระบบ</h2>
				<div class="panel-ctrls"></div>
			</div>
			<div class="panel-body no-padding">
				<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">                <!-- Main Content Wrapper -->
					<thead>
						<tr>
							<th width="10%">วัน/เดือน/ปี เวลา </th>
							<th width="25%">กิจกรรมที่ทำ</th>
							<th width="10%">IP Address</th>

						</tr>
					</thead>
					<tbody>
					<?php foreach($log->result_array() as $Log)
					{
					?>
						<tr>
							<td><?php echo $Log['LogTime'];?></td>
							<td><?php echo $Log['LogAction'];?></td>
							<td><?php echo $Log['LogIP'];?></td>
						</tr>
					<?php }?>
					</tbody>
				</table>
			</div>
			<div class="panel-footer"></div>			
		</div>	
	</div>	
</div>
<?php }?>