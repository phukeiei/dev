<!-- 
*form_register
*view v_form_regis
*@author Chanikan Khamluang
@create Date 2562-05-17
*@author Update Atikom Wongwan
@Update Date 2562-05-17
-->
<html>
<head>
</head>
<body>
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
  margin-left: 50%;

}
p{
font-size: 18px; }
.lol{
  background-color: DodgerBlue;
  width: 1000px;
  border: 10px solid white;
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

<div class="col-md-12">
		<!-- Tabs with icons on Card -->
		<div class="card card-nav-tabs">
				<div class="card-header card-header-primary">
						<!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
						<p class="cen"><font size="6%">ข้อมูลส่วนตัว</font></p>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-6">      
								<div class="row">	
											<div class="col-md-12">
												<div class="form-group label-floating bmd-form-group">
													<p><font size="5%">ชื่อ</font></p>
													<label class="control-label">
													<p><font size="5%"><?php echo $rs_data_person[0]->full_name;?></font></p></label>
												</div>
											</div>
								</div>
											
								<div class="row">			
											<div class="col-md-6">
												<div class="form-group label-floating bmd-form-group ">
													<p><font size="5%">วันเกิด</font></p>
													<label class="control-label">
													<p><font size="5%"><?php echo fullDateTH3($rs_data_person[0]->psd_birthdate); ?></font></p></label>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group label-floating bmd-form-group ">
													<p><font size="5%">อายุ</font></p>
													<label class="control-label">
													<p><font size="5%"><?php echo calAge3($rs_data_person[0]->psd_birthdate);?>&nbsp ปี</font></p></label>
												</div>
											</div>	<br>
								</div>
								<div class="row">
										<div class="col-md-12 control-label">
											<div class="form-group label-floating">
												<p><font size="5%">ที่อยู่</font></p>
												<label class="control-label">
													<p><font size="4%">
														<?php echo $rs_data_person[0]->psd_addcur_no."&nbspต.".$rs_data_person[0]->dist_name."&nbspอ.".$rs_data_person[0]->amph_name."&nbspจ.".$rs_data_person[0]->pv_name; ?><br><br>
														<?php echo "รหัสไปรษนีย์&nbsp".$rs_data_person[0]->psd_addcur_zipcode?>
													</font></p>
												</label>
											</div>
										</div> 
								</div>
						</div>
						<div class="col-md-3"></div>
					</div>
				<div class="row">
					<div class="col-md-12" style = "text-align: right;">
						<a href="<?php echo site_url("/swm/frontend/Swm_register/show_form_register_input"); ?>" style="margin: 0% 3% 3% 0%;"> <button class="btn ">ถัดไป</button> </a>
					</div>
				</div>
		</div>
		<!-- End Tabs with icons on Card -->
</div>




