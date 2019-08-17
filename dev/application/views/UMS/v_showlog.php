<div class="row">
	<div class="col-md-12">
		<div class="panel panel-teal panel-collapsed" data-widget='{"draggable": "false"}'>
			<div class="panel-heading">
				<h2><img src="<?php echo base_url(); ?>/images/icons/black/16/pencil.png" alt="" /><?php echo nbs(2);?>เพิ่มข้อมูลระบบ</h2>
				<div style="cursor:pointer" class="button-icon pull-right" data-actions-container=""  data-action-collapse='{"target": ".panel-body,.form-group"}'></div>
			</div>
		</div>
	</div>
</div>
                <!-- Main Content Wrapper -->
                <div id="da-content-wrap" class="clearfix">
                	<!-- Content Area -->
                	<div id="da-content-area">
                    	<div class="grid_4_center">
                        	<div id="manage" class="da-panel collapsible collapsed">
                            	<div class="da-panel-header">
                                	<span class="da-panel-title">
                                        <img src="<?php echo base_url(); ?>/images/icons/black/16/pencil.png" alt="" />
											กำหนดช่วงเวลาในการค้นหา
                                    </span>
                                </div>
                                <div class="da-panel-content">
									<form id="validate-WG" class="da-form" method="post" action="<?php echo base_url(); ?>index.php/UMS/showWorkGroup/add">
										<div id="valWG-error" class="da-message error" style="display:none;"></div>
										<div class="da-form-inline">	
											<div class="da-form-row">
												<div class="da-form-col-5-10">
													<label>ระหว่าง วันที่<span class="required">*</span></label>
													<div class="da-form-item large">
														<input type="text" name="GpNameT" placeholder="ชื่อกลุ่มงานภาษาไทย"/>
													</div>
												</div>
												<div class="da-form-col-5-10">
													<label>ถึง<span class="required">*</span></label>
													<div class="da-form-item large">
														<input type="text" name="GpNameE" placeholder="ชื่อกลุ่มงานภาษาอังกฤษ"/>
													</div>
												</div>		
											</div>		
											<div class="da-button-row">
												<input id="submit" class="da-button blue" type="submit" value="ค้นหา" name="search"></input>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="grid_4_center">
							<div class="da-panel">
								<div class="da-panel-header">
									<span class="da-panel-title">
										<img src="<?php echo base_url(); ?>/images/icons/black/16/computer_imac.png" alt="" />
                                        ประวัติการเข้าใช้ระบบ
									</span>
								</div>
								<div class="da-panel-content">
									<table id="da-ex-datatable-log" class="da-table">
										<thead>
											<tr>
												<th width="25%">วัน/เดือน/ปี เวลา </th>
												<th width="25%">ผู้ใช้</th>
												<th width="25%">กิจกรรมที่ทำ</th>
												<th width="25%">IP Address</th>

											</tr>
										</thead>
										<tbody>
										<?php foreach($log->result_array() as $Log)
										{
										?>
											<tr>
												<td><?php echo $Log['LogTime'];?></td>
												<td><?php ?></td>
												<td><?php echo $Log['LogAction'];?></td>
												<td><?php echo $Log['LogIP'];?></td>
											</tr>
										<?php }?>
										</tbody>
									</table>  
								</div>
							</div>
						</div>                 
					</div>
				</div>
		