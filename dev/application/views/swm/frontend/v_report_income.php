<html>
<head>
<script>
$(function () {
        $("#chkPassport").click(function () {
            if ($(this).is(":checked")) {
                $("#dvPassport").show();
                $("#AddPassport").hide();
            } else {
                $("#dvPassport").hide();
                $("#AddPassport").show();
            }
        });
    });
</script>
</head>
<body>

<div class="panel panel-default">
		<div class="panel-heading panel_heading_iserl"> <!--// ดู Class เป็นหลัก-->
			<h2>ค้นหาข้อมูลรายได้</h2>
		</div>
		<div class="panel-body">		        	       
			
			<div class="row">
				<div class="col-md-10 form-group">	
					<label class="col-md-3 control-label">ประเภท</label>
						<div class="input-daterange input-group col-md-2" id="datepicker-range">
									<select name="inc_bac_id" id="inc_bac_id" class="inc_bac_id col-md-12">
											<?php foreach($opt_status as $key => $result){ ?>
											<option value="<?php echo $key+1;?>"><?php echo $result->ss_name;?></option>
										<?php }?> 
									</select><!--select Account-->
						</div>
				</div>

				<div class="col-md-10 form-group">	
					<div class="col-md-3">
						<label  class="control-label" align="center">
						<input type="checkbox" id="inlinecheckbox1" value="Y" name="age_opt"> อายุระหว่าง</label>
					</div>
						<div class="input-daterange input-group col-md-8" id="datepicker-range ">
							<input type="text" class="input-small form-control" name="start" />
								<p class="input-group-addon">ถึง</p>
							<input type="text" class="input-small form-control" name="end" />
						</div>
				</div>

				<div class="col-md-10 form-group">	
					<div class="col-md-3">
						<label>วันที่เริ่ม</label>
					</div>
						<div class="input-daterange input-group col-md-8" id="datepicker-range" data-provide="datepicker" data-date-format="dd/mm/yyyy" data-date-language="th-th">
							<input type="text" class="input-small form-control" value="<?php echo getNowDateBuddishTH();?>" name="start" readonly/>
								<p class="input-group-addon">ถึง</p>
							<input type="text" class="input-small form-control" value="<?php echo getNowDateBuddishTH();?>" name="end" readonly/>
						</div>
				</div>

			</div>
		</div>
		<!--footer-->
			<div class="panel-footer"> 
				<button class="btn btn-social btn-google btn_iserl tooltips pull-right" id="search_button" onclick="validate()" title="คลิกปุ่มเพื่อค้นหาข้อมูล"><span> ค้นหา</span></button>
			</div>
			<!--end footer-->
		</div>
	
	
	
	<!--End div -->
	<div class="panel panel-default">
	<div class="panel-heading panel_table_iserl">
		<h2>รายงานการเข้าใช้บริการ </h2>
		<div class="panel-ctrls"></div>
	</div>
	
	<div class="panel-body">
		<table class="table table-striped table-bordered table_iserl no-footer table-hover dataTable-Export"> 
			<thead> 
				<tr>
					<th>วัน เดือน ปี</th>
					<th>ประเภทรายได้</th>
					<th>รายรับ&nbsp;(ปี)</th>
				</tr>	
			</thead> 
			<tbody>
				<tr>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>


</body>
</html>