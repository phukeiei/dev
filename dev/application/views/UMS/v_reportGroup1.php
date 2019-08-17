<div class="row">
	<div class="col-md-3">
		<div class="panel panel-teal panel-collapsed" data-widget='{"draggable": "false"}'>
			<div class="panel-heading">
				<h2><img src="<?php echo base_url(); ?>images/icons/black/16/computer_imac.png" alt="" /><?php echo nbs(2);?><?php foreach($system as $temp){ $sysname = $temp['StNameT']; }?>
											<b><?php echo $sysname;?></b></h2>
				<div style="cursor:pointer" class="button-icon pull-right" data-actions-container=""  data-action-collapse='{"target": ".panel-body,.form-group"}'></div>
			
			</div>
			<div class="panel-body">
				<?php foreach($system as $sys){ ?>
					<div class="col-md-12">
					<a href="<?php echo base_url();?>index.php/UMS/showReport/reportByGroup/<?php echo $sys['GpID'].'/'.$sys['StID'];?>"">
						<div class="info-tile tile-warning">
							<img width="35px" height="35px" src="<?php echo base_url();?>images/1378991964_people - Copy.png" alt="" />
							<?php echo nbs(2); ?><span class="value"><?php echo $sys['GpNameT']." ".$sys['num']." "."คน";?></span>
						</div>
					</a>	
				</div>
				<?php }?>
			</div>
	</div>
</div>	
<div class="col-md-9">
	<div class="panel panel-teal">
		<div class="panel-heading">
			<h2><img src="<?php echo base_url(); ?>/images/icons/black/16/computer_imac.png" alt="" /><?php echo nbs(2);?><?php echo $sysname;?>&nbsp;<i class="fa fa-chevron-right"></i><?php echo $sysGname[0]['GpNameT'];?></h2>
			<div class="panel-ctrls"></div>
		</div>
		<div class="panel-body no-padding">
			<table class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th width="35%">หน่วยงาน</th>
						<th width="30%">ตำแหน่ง</th>
						<th width="25%">ชื่อ - สกุล</th>
						<th width="10%">ชื่อเข้าสู่ระบบ</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($showgroup as $row){ ?>
					<tr>
						<td><?php echo $row['dpName'];?></td>
						<td><?php echo $row['adminposName'];?></td>
						<td><?php echo $row['UsName'];?></td>
						<td><?php echo $row['UsLogin'];?></td>
					</tr>
				<?php }?>
				</tbody>
			</table>
		</div>
		<div class="panel-footer"></div>
	</div>	   
</div>