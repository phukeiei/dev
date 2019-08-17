<!-- 
*form_register
*view v_form_regis
*@author Chanikan Khamluan
@create Date 2562-05-18
-->

<html>
<head>
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 80%;
  border-radius: 5px;
  margin: 36px 0;
margin-left: 129px;
margin-right: -120px;

}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  margin: 36px 0;
margin-left: 129px;
margin-right: -120px;
}

img {
  border-radius: 5px 5px 0 0;
}

.container {
  padding: 2px 16px;
}
.mymargin {
  margin-left: 16px;

}
.mymarginn {
  margin-left: 25px;

}
p{
font-size: 18px; }
.lol{
  background-color: DodgerBlue;
  width: 1010px;
  border: 6 px solid white;
  padding: 10px;
  margin: 0px;
  
}
.checkbox{
	padding: 20px;
  margin: 0px;
}
.cen{
	text-align :center;
}
</style>
</head>
<body>

	<div class="panel panel-default">
		<div class="panel-heading panel_heading_iserl"> <!--// ดู Class เป็นหลัก-->
			<h2>ค้นหาข้อมูลการสมัครสมาชิก</h2>
		</div>
		<div class="panel-body">		        	       
			
			<div class="row">

					<div class="col-md- ">	
						<label class="col-md-3 control-label" >วันที่เริ่ม</label>
							<div class="input-daterange input-group" id="datepicker-range">
								<input type="text" class="input-small form-control" name="start" />
									<p class="input-group-addon" >ถึง</p>
								<input type="text" class="input-small form-control" name="end" />
							</div>
					</div>

				<div class="row">
					<div class="col-md-6 ">	
						<div class="form-group">
							<div class="col-md-3">
								<label class="checkbox-inline icheck">
									<input type="checkbox" id="inlinecheckbox1" value="option1">
								อายุระหว่าง</label>
							
							</div>
									
							<div class="row">
								<div class="col-md-2">
									<input type="text"class="input-small form-control" >
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">ถึง</label>
									<div class="col-md-2">	
									<input type="text"class="input-small form-control" >
									</div>
								</div>
								
							</div>
						</div>
					</div>  
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-6 control-label">
                  <div class="btn-group bootstrap-select">
						<label class="col-sm-2 control-label">สถานะ</label>
						<select class="selectpicker" data-style="select-with-transition" title="" data-size="7" tabindex="-98">
							
						</select>
					</div>
                </div>
			</div><br>
		</div>		
	</div><!--end mymargin-->

	<!-- Panel Search -->
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default" data-widget='{"draggable": "false"}'>
			<!--heading-->
			<div class="panel-heading">
				<h2>ค้นหาข้อมูลรายรับ</h2>
			</div>
			<!--end heading-->
			
				<div class="panel-body"> 
				<form id="search_form_income">
          		<div class="form-group row">
						<label class="col-md-4" style="text-align:right"><b>ประเภท</b></label>
							<div class="">
									<select  style="width:300px;" name="inc_bac_id" id="inc_bac_id" class="inc_bac_id">
										<!-- <?php foreach($bankaccount as $key_bac => $val_bac){ ?>
											<option value="<?php echo $key_bac;?>"><?php echo $val_bac;?></option>
										<?php }?> -->
									</select><!--select Account-->
							</div>
					</div><!--form group row select-->	
					<div class="form-group row">
							<div class="col-md-4" style="text-align:right;">
								<label class="checkbox-inline icheck">
									<input type="checkbox" id="inlinecheckbox1" value="Y" name="age_opt">
									<b>อายุระหว่าง</b>
								</label>
							</div>
							<div class="col-md-6">
								<div class="col-md-3"><input type="number"class="form-control" ></div>
								<label class="col-sm-3 control-label" style="text-align:center;">ถึง</label>	
								<div class="col-md-3"><input type="number"class="form-control" ></div>
							</div>
					</div>							
					<div class="form-group row">
						<label class="col-md-4" style="text-align:right"><b>วันที่</b></label>
								<div class="input-daterange input-group col-sm-5" id="datepicker-range" data-provide="datepicker" data-date-format="dd/mm/yyyy" data-date-language="th-th">
									<input type="text" class="input-small form-control hand_cursor" name="date_start" id="date_start" value="<?php echo getNowDateBuddishTH();?>" validate readonly/>
									<span class="input-group-addon" style = "padding: 2px 4px; font-size: 17px;">ถึง</span>
									<input type="text" class="input-small form-control hand_cursor" name="date_end" id="date_end" value="<?php echo getNowDateBuddishTH();?>" validate readonly/>
								</div><!--date range-->
					</div><!--form group row date-->
				</div><!--panel body-->
			</form>
			
			<!--footer-->
			<div class="panel-footer"> 
				<button class="btn btn-social btn-google btn_iserl tooltips pull-right" id="search_button" onclick="check_validate_date_search()" title="คลิกปุ่มเพื่อค้นหาข้อมูล" ><span> ค้นหา</span></button>
			</div>
			<!--end footer-->
		</div><!--div panel-->
	</div><!--div col-xs-12-->
</div><!--div row-->

<div class="panel panel-default">
		<div class="panel-heading panel_heading_iserl"> <!--// ดู Class เป็นหลัก-->
			<h2>ค้นหาข้อมูลการสมัครสมาชิก</h2>
		</div>
		<div class="panel-body">		        	       
			
			<div class="row">
				<div class="col-md-10 form-group">	
					<label class="col-md-3 control-label">ประเภท</label>
						<div class="input-daterange input-group col-md-8" id="datepicker-range">
									<select name="inc_bac_id" id="inc_bac_id" class="inc_bac_id col-md-12">
										<!-- <?php foreach($bankaccount as $key_bac => $val_bac){ ?>
											<option value="<?php echo $key_bac;?>"><?php echo $val_bac;?></option>
										<?php }?> -->
									</select><!--select Account-->
						</div>
				</div>

				<div class="col-md-10 form-group">	
					<div class="col-md-3">
						<label  class="control-label" align="center">
						<input type="checkbox" id="inlinecheckbox1" value="Y" name="age_opt"> อายุระหว่าง</label>
					</div>
						<div class="input-daterange input-group col-md-8" id="datepicker-range">
							<input type="text" class="input-small form-control" name="start" />
								<p class="input-group-addon" >ถึง</p>
							<input type="text" class="input-small form-control" name="end" />
						</div>
				</div>

				<div class="col-md-10 form-group">	
					<div class="col-md-3">
						<label>วันที่เริ่ม</label>
					</div>
						<div class="input-daterange input-group col-md-8" id="datepicker-range">
							<input type="text" class="input-small form-control" name="start" />
								<p class="input-group-addon" >ถึง</p>
							<input type="text" class="input-small form-control" name="end" />
						</div>
				</div>

			</div>
		</div>
	</div>
</div>


	

