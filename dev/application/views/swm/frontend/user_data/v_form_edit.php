<!-- 
*form_register
*view v_form_regis
*@author Chanikan Khamluan ,phattanan chawalitsuwan
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
<script>
function validateForm() {
	var su_work = $("#su_work").val();
	var su_workplace = $("#su_workplace").val();
	var su_contact_fname = $("#su_contact_fname").val();
	var su_contact_lname = $("#su_contact_lname").val();
	var su_tel_contact = $("#su_tel_contact").val();
	var validate_bool = true;
	console.log(su_work);
	if (su_work == "") {
		$("#input_work").addClass("has-danger");
		$('#su_work').focus();
		validate_bool = false;
		//return false;
	}else{
		$("#input_work").removeClass("has-danger");
	}
	if (su_workplace == "") {
		$("#input_workplace").addClass("has-danger");
		$('#su_workplace').focus();
		// alert("กรุณากรอกสถานที่ทำงาน /สถานศึกษาของผู้ใช้บริการ");
		validate_bool = false;
	}else{
		$("#input_workplace").removeClass("has-danger");
	} 
	if (su_contact_fname == "") {
		$("#input_su_contact_fname").addClass("has-danger");
		$('#su_contact_fname').focus();
		// alert("กรุณากรอกสถานที่ทำงาน /สถานศึกษาของผู้ใช้บริการ");
		validate_bool = false;
	}else{
		$("#input_su_contact_fname").removeClass("has-danger");
	} 
	if (su_contact_lname == "") {
		$("#input_su_contact_lname").addClass("has-danger");
		$('#su_contact_lname').focus();
		// alert("กรุณากรอกสถานที่ทำงาน /สถานศึกษาของผู้ใช้บริการ");
		validate_bool = false;
	}else{
		$("#input_su_contact_lname").removeClass("has-danger");
	} 
	if (su_tel_contact == "") {
		$("#input_su_tel_contact").addClass("has-danger");
		$('#su_tel_contact').focus();
		// alert("กรุณากรอกสถานที่ทำงาน /สถานศึกษาของผู้ใช้บริการ");
		validate_bool = false;
	}else{
		$("#input_su_tel_contact").removeClass("has-danger");
	}
	
	console.error(su_work );
	console.error( su_workplace );
	console.error( su_contact_fname );
	console.error( su_contact_lname );
	console.error( su_tel_contact );
	
	return validate_bool;
}
</script>
</head>
<body>
<?php $rs_user = ($rs_user_data) ? $rs_user_data->row() : NULL;?>
<div class="card" >
	<div class="cen" >
		<div class="card-header card-header-primary" >
			<h3><font color="white">แก้ไขข้อมูลส่วนตัว</font></h3> 
		</div>
	</div>
	
	<div class="container" ><br>
	<form method="POST" id="form_register_edit" name="register_edit"  action="<?php echo site_url()."/".$this->config->item('swm_folder').$this->config->item('swm_folder_front')."Swm_manage_su_data/edit_data_register"; ?>">
	<input type="hidden" name="su_id" value="<?php echo ($rs_user) ? $rs_user->su_id : ''; ?>">
		<div class = "mymargin">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group label-floating">
						<h5><b>ชื่อ : </b><?php echo $full_name; ?></h5>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group label-floating">
						<h5><b>วันเกิด : </b><?php echo $birthdate; ?></h5>
						
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group label-floating ">
						<h5><b>อายุ : </b><?php echo $age; ?> ปี</h5>
						
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 control-label">
					<div class="form-group label-floating">
						<h5><b>ที่อยู่ : </b><?php echo $address.$district.$ampn.$province.$zipcode; ?></h5>
					</div>
				</div> 
			</div>	
		</div><br>
		<h4> ● ข้อมูลการติดต่อ </h4>

		<div class="row">
			<div class="col-sm-6 control-label">
						<div class="form-group label-floating bmd-form-group" id="input_work">
							<label for='su_work' class="bmd-label-floating"><p>อาชีพ<font color="red"> *</font></p></label>
							<input type="text" class="form-control" name = "su_work" id="su_work" value="<?php echo ($rs_user) ? $rs_user->su_work : ''; ?>">
						</div>
			</div>  
			<div class="col-md-6 control-label">
				<div class="form-group label-floating bmd-form-group " id = "input_workplace">
							<label for='su_workplace' class="bmd-label-floating"><p>สถานที่ทำงาน / สถานที่ศึกษา<font color="red">*</font></p></label>
					<input type="text" class="form-control" name="su_workplace" id="su_workplace" value="<?php echo ($rs_user) ? $rs_user->su_workplace : ''; ?>">
				</div>
			</div>
		</div>
		<!--<div class="row">
			<div class="col-md-6 control-label">
				<div class="form-group label-floating bmd-form-group ">
						<label class="bmd-label-floating"><p>เบอร์โทรศัพท์</p></label>
					<input type="text" class="form-control" name = "su_tel" id="su_tel" >
				</div>
			</div>
		</div>--><br>
		<h4> ● ข้อมูลบุคคลที่สามารถติดต่อได้ </h4>
			<!-- <div class="row">
				<div class="col-md-6 control-label">
					<div class="form-group label-floating">
						<label class="control-label"><p>บุคคลที่สามารถติดต่อได้ เกี่ยวข้องเป็น</p></label>
						<input type="text" class="form-control" name="su_relation_ref" id="su_relation_ref">
					</div>
				</div>
			</div>	-->
		<div class="row">
			<div class="col-sm-6 control-label ">
						<div class="form-group bmd-form-group">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<label class='pad'><p>คำนำหน้าชื่อ<font color="red"> *</font></p></label>
									</span>
								</div>
								<div class="btn-group bootstrap-select">
									<select class="selectpicker" data-style="select-with-transition" title="" data-size="7" tabindex="-98" name = "su_contact_pf_id" id='su_contact_pf_id'>
										<option value='0' selected >กรุณาเลือกคำนำหน้าชื่อ</option>
										<?php $round = 0; 
											foreach($opt_prefix->result() as $value){
											?>
												<option  value="<?php echo $value->pf_id; ?>"><?php echo $value->pf_name;?></option>
											<?php } ?>	
									</select>
								</div>
							</div>
						</div>
            </div>
		</div>
		<div class="row">
			<div class="col-sm-6 control-label">		
				<div class="form-group label-floating bmd-form-group" id="input_su_contact_fname">
						<label for='su_contact_fname'class="bmd-label-floating"><p>ชื่อ<font color="red"> *</font></p></label>
					<input type="text" class="form-control" name = "su_contact_fname" id="su_contact_fname" value="<?php echo ($rs_user) ? $rs_user->su_contact_fname : ''; ?>">
				</div>
			</div>
					
			<div class="col-sm-6 control-label" >
				<div class="form-group label-floating bmd-form-group "id="input_su_contact_lname">
						<label class="bmd-label-floating"><p>นามสกุล<font color="red"> *</font></p></label>
					<input type="text" class="form-control" name = "su_contact_lname" id="su_contact_lname" value="<?php echo ($rs_user) ? $rs_user->su_contact_lname : ''; ?>">
				</div>
			</div>	
		</div>	
		<div class="row">
			<div class="col-sm-6 control-label">
				<div class="form-group label-floating bmd-form-group " id = "input_su_tel_contact">
					<label class="bmd-label-floating"><p>เบอร์โทรศัพท์<font color="red"> *</font></p></label>
					<input type="text" class="form-control" name = "su_tel_contact" id="su_tel_contact" value="<?php echo ($rs_user) ? $rs_user->su_tel_contact : ''; ?>">
				</div>
			</div>
		</div><br>															
		
		<div class="col-auto align-middle,panel-footer" >
		<div class="row">
			<div class="col-md-6"><a class="btn btn-inverse"  href="<?php echo site_url('/swm/frontend/Swm_show_service'); ?>">ย้อนกลับ</a></div>
			<div class="col-md-6" style = "text-align:right;">
				<button type="submit" class="btn btn-success" onclick="return validateForm()"> ยืนยัน</button> 
			</div>
		</div>
		<div class="row">
			<!--<div class="col-md-12 control-label" align ="right">
				<button type="submit" class="btn btn-warning">ยืนยัน</button>
			</div>-->
		</div>
	</form>
</div>	

<br>						
</div>						

	</body>
</html>	
