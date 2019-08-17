<!--
*
*show report service
*view report_service
*@author phattanan chawalitsuwan
*@Create Date 2562-05-21
*
-->
<html>
<head>
<script>
	function validate(){
		//alert("กรุณากรอกวันที่ต้อการจะค้นหา");
		
	}

	$(document).ready(function(){
		$('input:checkbox').change(function(){
			if ($(this).is(':checked')) {
				$(".rangeAge").removeAttr('disabled');
			}else{
				$(".rangeAge").attr("disabled", "disabled");
				$(".rangeAge").val("");
			}
		});
	})
</script>
</head>
<body>

<div class="panel panel-default">
		<div class="panel-heading panel_heading_iserl"> <!--// ดู Class เป็นหลัก-->
			<h2>ค้นหาข้อมูลการเข้าใช้บริการ</h2>
		</div>
		<form action="<?php echo site_url("swm/frontend/Swm_report_service/update_table_report"); ?>" onsubmit="return validate()" method="POST">
		<div class="panel-body">		        	       
			
			<div class="row">
				<div class="col-md-10 form-group">	
					<label class="col-md-3 control-label">ประเภท</label>
						<div class="input-daterange input-group col-md-8" id="datepicker-range">
									<select name="su_state" id="" class=" col-md-12">
										<option value = "2" selected>สมาชิก</option>
										<option value = "1">ไม่เป็นสมาชิก</option>
									</select><!--select Account-->
						</div>
				</div>

				<div class="col-md-10 form-group">	
					<div class="col-md-3">
						<label  class="control-label" align="center">
						<input type="checkbox" id="chkBox" value="Y" name="age_opt"> อายุระหว่าง</label>
					</div>
						<div class=" input-group col-md-8">
							<input type="text" class="input-small form-control rangeAge" name="startAge" disabled/>
								<p class="input-group-addon" >ถึง</p>
							<input type="text" class="input-small form-control rangeAge"  name="endAge" disabled/>
						</div>
				</div>

				<div class="col-md-10 form-group">	
					<div class="col-md-3">
						<label>วันที่เริ่ม</label>
					</div>
						<div class="input-daterange input-group col-md-8" id="datepicker-range" data-provide="datepicker" data-date-format="dd/mm/yyyy" data-date-language="th-th">
							<input type="text" class="input-small form-control" value="<?php echo getNowDateBuddishTH();?>" name="startDate" readonly/>
								<p class="input-group-addon">ถึง</p>
							<input type="text" class="input-small form-control" value="<?php echo getNowDateBuddishTH();?>" name="endDate" readonly/>
						</div>
				</div>

			</div>
		</div>
		<!--footer-->
			<div class="panel-footer"> 
				<button class="btn btn-social btn-google btn_iserl tooltips pull-right" id="search_button" title="คลิกปุ่มเพื่อค้นหาข้อมูล"><span> ค้นหา</span></button>
			</div>
			</form>
			<!--end footer-->
		</div>
	</div>
	<!--End div -->
	<div class="panel panel-default col-md-12">
	<div class="panel-heading panel_table_iserl ">
		<h2>รายงานการเข้าใช้บริการ </h2>
		<div class="panel-ctrls"></div>
	</div>
	
	<div class="panel-body">
		<table class="table table-striped table-bordered table_iserl no-footer table-hover dataTable-Export"> 
			<thead> 
				<tr>
					<th>ลำดับ</th>
					<th>วันที่เข้าใช้บริการ</th>
					<th>เวลาเข้าใช้บริการ</th>
					<th>สถานะ</th>
					<th>อายุ &nbsp;(ปี)</th>
				</tr>	
			</thead> 
			<tbody>
				<?php foreach($rs_service_data as $key => $row){?>
				<tr>
					<td><?php echo $key + 1; ?></td>
					<td><?php echo fullDate3($row->sa_create_date);?></td>
					<td><?php echo $row->sa_time; ?></td>
					<td><?php echo $row->ss_name; ?></td>
					<td><?php echo ($row->psd_birthdate != "")? calAge3($row->psd_birthdate) : "ไม่มีข้อมูล";?></td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
</div>
</body>
</html>