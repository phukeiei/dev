<div class="row">
	<div class="col-md-12">
		<div class="panel panel-teal">
			<div class="panel-heading">
				<h2><img src="<?php echo base_url(); ?>/images/icons/black/16/computer_imac.png" alt="" /><?php echo nbs(2);?>กรุณาเลือกระบบที่ต้องการ</h2>
				<div class="panel-ctrls"></div>
			</div>
			<div class="page-body">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th width="30%">หน้าที่</th>
							<th width="30%">System Name</th>
							<th width="30%">ชื่อระบบงาน</th>
							<th width="10%">แก้ไขสิทธิ์</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						foreach ($show as $row){//while($objResult = mysql_fetch_object($dbarr)){//foreach ( $dbrr as $row )
						?>
						<tr>
							<td><?php echo $row['GpNameT'];//= $objResult->GpNameT; ?></td>
							<td><?php echo $row['StNameE'];//= $objResult->StNameE; ?></td>
							<td><?php echo $row['StNameT'];//= $objResult->StNameT; ?></td>
							<td>
								<center>
								&nbsp;<i class="fa fa-list-alt tooltips" title="แก้ไขสิทธิ์" style="cursor:pointer;color:green;font-size:20px" onclick="window.location.href='<?php echo base_url(); ?>index.php/UMS/perMissionP/setPermission/?GpID=<?php echo $row['GpID'];?>&StID=<?php echo $row['StID'];?>&UsID=<?php echo $UsID;?>'"></i>
								</center>
							</td>
						</tr>
						<?php
							}
						?>
					</tbody>
                </table>
			</div>
		</div>	
	</div>	
</div>	