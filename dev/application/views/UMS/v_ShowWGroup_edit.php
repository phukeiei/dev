<script>
function removeshowwgroup(WgID)
{
	var web="<?php echo base_url()?>index.php/UMS/showWGroup/remove/"+WgID;
	
	if(confirm("คุณต้องการลบหรือไม่?")==true){
     window.location.href=web;
   }
	else
	{
		return false;
	}
}

$(document).ready(
	function(){
		$("input[type=checkbox]").click(
			function(){
				var name=$(this).attr('id');
				var value=$(this).is(':checked') ? 1 : 0;
				$('input[name="hidden'+name+'"]').val(value);
			}
		);
	}
);
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>/js/ums/permission.js"></script>
<div class="row">
	<div class="col-md-12">	
		<div class="panel panel-teal panel-collapsed" data-widget='{"draggable": "false"}'>
			<div class="panel-heading">
				<h2><i class="fa fa-users" style="font-size:26px"></i><?php echo nbs(2); ?>จัดการข้อมูลกลุ่มผู้ใช้</h2>
				<div style="cursor:pointer" class="button-icon pull-right" data-actions-container="" data-action-collapse='{"target": ".panel-body,.panel-footer"}'>
				</div>
			</div>
			<?php 
				$ID = $this->encryption->encrypt($edit['WgID']);
				$ID = str_replace("/","_",$ID);
				$ID = str_replace("+",":",$ID);
				$ID = str_replace("=","~",$ID);
			?>
			<form class="form-horizontal row-border" method="post"action ="<?php echo base_url(); ?>index.php/UMS/showWGroup/update/<?php echo $ID?>" data-parsley-validate> <!-- แก้ -->
				<div class="panel-body">
					<div class="form-group">
						<label class="col-sm-1 control-label">ชื่อกลุ่มงาน(ท)</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="WgNameT" placeholder="ชื่อกลุ่มงานภาษาไทย" value="<?php echo $edit['WgNameT']?>"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-1 control-label">ชื่อกลุ่มงาน(E)</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="WgNameE" placeholder="ชื่อกลุ่มงานภาษาอังกฤษ" value="<?php echo $edit['WgNameE']?>"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-1 control-label">สิทธิ์การใช้</label>
						<table class="da-table">
							<tbody>
							<?php foreach($sysname as $sys) {
									$check = "";
									$hdcheck = 0;
									foreach($persys as $per){
										if($sys['GpID'] == $per['GpID']){
											$check = "checked";
											$hdcheck = 1;
										}
									}?>
								<tr>
									<td>
										<input type="checkbox" name = "<?php echo $sys['GpID'];?>" id="<?php echo $sys['GpID'];?>"<?php echo $check; ?>> 
										<input type="hidden" name = "hidden<?php echo $sys['GpID'];?>" value = "<?php echo $hdcheck;?>">
									</td>
									<td>&nbsp;<?php echo $sys['StNameT'];?>&nbsp;( <?php echo $sys['GpNameT']; ?> )</td>
								</tr>
							<?php }?>
							</tbody>										
						</table>
					</div>
					<div class="form-group">
						<div class="col-sm-12 col-sm-offset-0">
							<div class="btn-toolbar">
								<input class="btn-inverse btn pull-left" type="reset" value="เคลียร์ข้อมูล">
								<a class="btn-danger btn pull-right" onclick="window.location.href='<?php echo base_url(); ?>index.php/UMS/showWGroup/'" value="ยกเลิก" name="cancle">ยกเลิก</a>
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
				<h2><i class="fa fa-database" style="font-size:26px"></i>ข้อมูลกลุ่มงาน</h2>
				<div class="panel-ctrls"></div>
			</div>
			<div class="panel-body no-padding">
				<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th width="5%">No.</th>
							<th width="25%">ชื่อกลุ่มงาน(ท)</th>
							<th width="25%">ชื่อกลุ่มงาน(E)</th>
							<th width="10%">Option</th>
						</tr>
					</thead>
					 <tbody>
					<?php $i=1;
						foreach ($wgroup->result_array() as $wgroup) { 
						$ID = $this->encryption->encrypt($wgroup['WgID']);
						$ID = str_replace("/","_",$ID);
						$ID = str_replace("+",":",$ID);
						$ID = str_replace("=","~",$ID);
						?>
						 <tr>
							<td><center><?php echo $i;?></center></td>
							<td><?php echo $wgroup['WgNameT'];//= $objResult->WgNameT; ?></td>
							<td><?php echo $wgroup['WgNameE'];//= $objResult->WgNameE; ?></td>
							<td>
								<center>
									  <i class="fa fa-edit tooltips" title="แก้ไขข้อมูล" style="cursor:pointer;color:#ecb100;font-size:20px" onclick="window.location.href='<?php echo base_url(); ?>index.php/UMS/showWGroup/edit/<?php echo $ID?>'"></i>
								&nbsp;<i class="fa fa-times-circle tooltips" title="ลบข้อมูล" style="cursor:pointer;color:red;font-size:20px" onclick='return removeshowwgroup(<?php echo $web ?>);'></i>
								</center>
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
                
