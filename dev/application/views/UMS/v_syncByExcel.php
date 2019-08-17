	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-teal panel-collapsed" data-widget='{"draggable": "false"}'>
				<div class="panel-heading">
					<h2><i class="fa fa-search" style="font-size:26px"></i><?php echo nbs(2); ?>นำเข้ารายชื่อผู้ใช้</h2>
					<div style="cursor:pointer" class="button-icon pull-right" data-actions-container=""  data-action-collapse='{"target": ".panel-body,.panel-footer"}'></div>
				</div>
				
					<div class="panel-body">
					
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-teal" >
								<div class="panel-heading">
									<h2>1. ดาวน์โหลดแฟ้มข้อมูล เพื่อกรอกข้อมูล</h2>
									
								</div>
								<div class="panel-body">
								
									<img src="<?php echo base_url("images/ex_import_excel.PNG");?>" border="1"></img>
									<hr>
									<h2 class="text-danger"> ดาวน์โหลดแฟ้มตัวอย่าง  <button class="btn btn-primary btn-lg">คลิกที่นี่</button></h2>
								</div>
							</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-teal" >
								<div class="panel-heading">
									<h2>2. อัพโหลดแฟ้มข้อมูล</h2>
								</div>
								<div class="panel-body">
								<form class="form-horizontal row-border" id="validate-form" data-parsley-validate method="post" enctype="multipart/form-data" action="<?php echo base_url()?>index.php/UMS/syncByExcel/ImportFile">
								<div class="form-group">
									<label class="col-sm-2 control-label">นำเข้าข้อมูล</label>
									<div class="col-sm-6">
										<div class="fileinput fileinput-new" data-provides="fileinput">
											<div class="input-group">
												<div class="form-control uneditable-input" data-trigger="fileinput">
													<i class="fa fa-file fileinput-exists"></i>&nbsp;<span class="fileinput-filename"></span>
												</div>
												<span class="input-group-btn">
													<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
													<span class="btn btn-default btn-file">
														<span class="fileinput-new">Select file</span>
														<span class="fileinput-exists">Change</span>
														<input type="file" name="DataExcel">
													</span>
		
												</span>
											</div>
										</div>
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
								</form>
								</div>
							</div>
						</div>
					</div>
				
			</div>
		</div>
	</div>
	<div class="row" id="history_form" <?php if($headingsArray == null){ echo "style='display:none'";}else{ echo "style='display:'";}?> >
		<div class="col-md-12">
			<div class="panel panel-teal" data-widget='{"draggable": "false"}'>
				<div class="panel-heading">
					<h2><img src="<?php echo base_url(); ?>images/icons/black/16/users_2.png" alt="" /><?php echo nbs(2); ?>รายงานการนำเข้าข้อมูล </h2>
					<div class="panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body"}'></div>
				</div>
				<div class="panel-body no-padding">
					<form class="da-form" method="post" action="<?php echo base_url()?>index.php/UMS/syncByExcel/InsertDataFromExcel" >
						<table class="table table-bordered m-n" cellspacing="0">
							<thead>
								<tr>
									<?php
									 foreach($headingsArray as $key => $val){?>
										<th style="text-align:center" width="5%">ลำดับ</th>
										<th style="text-align:center" width="10%"><?php echo $val['A']?></th>
										<th style="text-align:center" width="20%"><?php echo $val['B']?></th>
										<th style="text-align:center" width="10%"><?php echo $val['C']?></th>
										<th style="text-align:center" width="5%"><?php echo $val['D']?></th>
										<th style="text-align:center" width="15%">หน่วยงาน<?php //echo $val['E']?></th>
									<?php }?>
								</tr>
							</thead>
							<tbody id="sync_table">
							
								<?php 
									$select_val = "";
									$disable = "";
									$i=1;
									foreach($namedDataArray as $key => $val){?>
									<tr>
										<td style="text-align:center"><?php echo $i;?></td>
										<td><?php echo $val['A']?><input type="hidden" name="UsLogIn[]" value="<?php echo $val['A']?>"></td>
										<td><?php echo $val['B']?><input type="hidden" name="UsName[]" value="<?php echo $val['B']?>"></td>
										<td><?php echo $val['C']?><input type="hidden" name="UsEmail[]" value="<?php echo $val['C']?>"></td>
										<td><?php echo $val['D']?><input type="hidden" name="UsStatus[]" value="<?php echo $val['D']?>"></td>
										<td>
											
											<?php //echo $this->session->userdata('UsWgID');//echo $val['E']?>
											<?php if($this->session->userdata('UsWgID')!=1 && $this->session->userdata('UsWgID')!=14 ){ 
												$select_val = 2;
												$disable = "disabled";
											?>
												
											<?php }?>
											<select name="UsDpID[]" class="form-control" <?php echo $disable;?>>
												<option value="0">เลือกหน่วยงาน</option>
												<?php foreach($rs_dp as $row_dp){ ?>
													<option value="<?php echo $row_dp->dpID;?>" <?php if($row_dp->dpID == $select_val){echo "SELECTED";}?> ><?php echo $row_dp->dpName;?></option>
												<?php }?>
												<!--<option>Lorem ipsum dolor sit amet.</option>
												<option>Dolore, ab unde modi est!</option>
												<option>Illum, fuga minus sit eaque.</option>
												<option>Consequatur ducimus maiores voluptatum minima.</option>-->
											</select>
											<!--<input type="hidden" name="UsDpID[]" value="<?php //echo $val['E']?>">-->
										</td>
									</tr>
								<?php $i++;}?>
							</tbody>
							<tfoot>
								<td colspan="<?php echo count($headingsArray[1])+2;?>" >
									<button style="float: right;" id="search" class="btn btn-success" value="บันทึก" name="submit">บันทึก</button>
								</td>
							</tfoot>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>
