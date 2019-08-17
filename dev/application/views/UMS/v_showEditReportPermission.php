<div class="row">
	<div class="col-md-12">
		<div class="panel panel-teal">
			<div class="panel-heading">
				<h2><i class="fa fa-database" style="font-size:26px"></i><?php echo nbs(2);?>ประวัติการเข้าใช้ระบบ</h2>
				<div class="panel-ctrls"></div>
			</div>
			<div class="panel-body no-padding">
				<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">                <!-- Main Content Wrapper -->
					<thead>
						<tr>
							<th width="10%">ผู้ใช้</th>
							<th width="15%">หน้าที่</th>
							<th width="10%">ได้รับ - ลด</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($log as $Log){ ?>
						
						<?php if($Log['UsName'] && $Log['StNameT'] && $Log['GpNameT'] != NULL){ ?> 
						<tr>	
							<td><?php echo $Log['UsName'];?></td>
							<td><?php echo $Log['StNameT']." กลุ่ม".$Log['GpNameT'];?></td>
							<td><?php if ($Log['status'] == 1){echo "ได้รับสิทธิ์เมื่อ ".$Log['start_time'];} else{echo "โดนถอดสิทธิ์เมื่อ ".$Log['end_time'];}?></td>
						</tr>	
						<?php }?>
						
					<?php }?>
					</tbody>
				</table>
			</div>
			<div class="panel-footer"></div>			
		</div>	
	</div>	
</div>