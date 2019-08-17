<style>
th{
	font-weight:bold;

}
</style>
<script>
	$(document).ready(function(){
		$(".select2").select2();
	});
</script>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-teal panel-collapsed" data-widget='{"draggable": "false"}'>
			<div class="panel-heading">
				<h2><i class="fa fa-search" style="font-size:26px"></i><?php echo nbs(2); ?>นำเข้าเมนูระบบ</h2>
				<div style="cursor:pointer" class="button-icon pull-right" data-actions-container=""  data-action-collapse='{"target": ".panel-body,.panel-footer"}'></div>
			</div>
			<form class="form-horizontal row-border" id="validate-form" data-parsley-validate method="post" enctype="multipart/form-data" action="<?php echo base_url()?>index.php/UMS/CopySystemmenu/ImportCopyfile">
				<div class="panel-body" style="<?php if(isset($show) && $show==1){ echo "display:none";}?>">
					
					<div class="form-group">
						<label class="col-sm-2 control-label">นำเข้าข้อมูล</label>
						<div class="col-sm-6">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="input-group">
									
									<span class="input-group-btn">
										<span class="btn btn-default btn-file">
											<span class="fileinput-new">Select file</span>
											<span class="fileinput-exists">Change</span>
											<input type="file" name="DataExcel" value="">
										</span>
									</span>
								</div>
							</div>
							<?php 
								$data = explode('/',site_url());
								list($http,,$ip,,) = $data;	
								// echo base_url();	
							?>
							<div style="margin-top:-5px">ตัวอย่าง Template ในการนำเข้าเมนูระบบแบบ Excel &nbsp;<i class="fa fa-arrow-right fa-lg"></i>&nbsp;<a href="<?php echo base_url()."uploads/template.xlsx";?>" download="template.xlsx" target="_blank"><i class="fa fa-file-excel-o fa-2x"></i></a></div>
						</div>
					</div>
					<div class="panel-footer">
						<div class="col-sm-12 col-sm-offset-0">
							<div class="btn-toolbar">
								<input class="btn-inverse btn pull-left" type="reset" value="เคลียร์ข้อมูล">
								<input class="btn-success btn pull-right" type="Submit" value="Import">
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="row" id="history_form" <?php if($headingsArray == null){ echo "style='display:none'";}else{ echo "style='display:'";}?> >
	<div class="col-md-12">
		<div class="panel panel-teal" data-widget='{"draggable": "false"}'>
			<div class="panel-heading">
				<h2><?php echo nbs(2); ?>ตัวอย่างการนำเข้าเมนูระบบ </h2>
				<div class="panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body"}'></div>
			</div>
			<div class="panel-body no-padding">
				<form class="da-form" method="post" action="<?php echo base_url()?>index.php/UMS/CopySystemmenu/Importnewmenu" >
				<table class="table table-bordered m-n" cellspacing="0" style="width:100%">
				<tr>
					<td>

					<table class="table table-bordered m-n" cellspacing="0" style="width:100%">

						<thead>
							<tr bgcolor = "#80ccff">
									<th style="text-align:center" width="15%">เมนูระบบที่มีอยู่แล้ว</th >
							</tr>
						</thead>
						<tbody id="sync_table">
							<?php $i=1;
								foreach($rs_ummenu as $key2 => $val){?>
								<tr>

									<td><?php echo $val->MnNameT;?><input type="hidden" name="UsStatus[]" value="<?php echo $val->MnNameT;?>"></td>

								</tr>
							<?php $i++;}?>
						</tbody>
						<input type="hidden" value="" name="UsWgID">
						<tfoot>
							
						</tfoot>
					</table>
					</td>
					<td>
					<table class="table table-bordered m-n" cellspacing="0" style="width:100%">
						<thead>
							<tr bgcolor = "#00e6e6">
									<th style="text-align:center;" width="15%"><span style = "font-weight:bold;" >เมนูระบบที่จะนำเข้า</span></th>
							</tr>
						</thead>
						<tbody id="sync_table">
						
							<?php $n=0;
								foreach($rs_umsystem as $row_sys){
									$StID = $row_sys->StID;
								}
								foreach($namedDataArray as $key => $val){
									if($rs_ummenu){
										foreach($rs_ummenu as $key2 => $val2){
											if($val['D']!=$val2->MnNameT || $val['G']!=$val2->MnURL){
												$i=0;
													
											}else{
												$i=1;
												break;
											}
										}
									}else{
										$i=0;
									}
									if($i==0){
										?>
										
										<tr>
											<td>
												<input type = "hidden" name = "MnStID[]" value ="<?php echo $StID; ?>">
												<input type = "hidden" name = "MnID[]" value ="<?php echo $val['B']; ?>">
												<input type = "hidden" name = "MnSeq[]" value ="<?php echo $val['C']; ?>">
												<input type = "hidden" name = "MnNameT[]" value ="<?php echo $val['D']; ?>">
												<input type = "hidden" name = "MnNameE[]" value ="<?php echo $val['E'];?>">
												<input type = "hidden" name = "MnIcon[]" value ="<?php echo $val['F']; ?>">
												<input type = "hidden" name = "MnURL[]" value ="<?php echo $val['G']; ?>">
												<input type = "hidden" name = "MnDesc[]" value ="<?php echo $val['H']; ?>">
												<input type = "hidden" name = "MnToolbar[]" value ="<?php echo $val['I']; ?>">
												<input type = "hidden" name = "MnToolbarSeq[]" value ="<?php echo $val['J']; ?>">
												<input type = "hidden" name = "MnToolbarIcon[]" value ="<?php echo $val['K']; ?>">
												<input type = "hidden" name = "MnParentMnID[]" value ="<?php echo $val['L']; ?>">
												<input type = "hidden" name = "MnLevel[]" value ="<?php echo $val['M']; ?>">
												<?php echo $val['D']?><input type="hidden" name="UsStatus[]" value="<?php echo $val['D'];?>">  (ไม่มีในระบบ)
											</td>
										</tr>
									<?php 
									}else{
										?>
											<tr bgcolor = "#cccccc">
			
												<td><?php echo $val['D']?><input type="hidden" name="UsStatus[]" value="<?php echo $val['D']?>">  (มีในระบบ)</td>
											
											</tr>
										<?php
									}
									$n++;							
								}
							?>
						</tbody>
						<input type="hidden" value="" name="UsWgID">
						<tfoot>
							
						</tfoot>
					</table>
					</td>
					</tr>
					</table>
					<button style="float: right;" type = "submit" class="btn btn-success" value="บันทึก" name="submit">บันทึก</button>
				</form>
			</div>
		</div>
	</div>
</div>
