<!--
*
*
*v_form_regis_input
*view v_form_regis_input
*@author Manita Doungrassamee , Tiwakorn Hedmuin
*@Create Date 2562-05-17
*
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
.mymarginn {
  margin-left: 40px;
  margin-right: 30px;
}
.mymarginn2 {
  margin-right: 30px;
}
.pad{
	padding-top: 35px;
}
</style>

<script>
// function check_validate(){

// 	var validate = validate_form($("#form_register"),false);
// 	if(validate){
// 		alert("Please full fill");
// 	}
// 	return validate;
// }
function validateForm() {
  var su_work = $("#su_work").val();
	var su_workplace = $("#su_workplace").val();
	var su_tel = $("#su_tel").val(); 
	var su_contact_pf_id = $(su_contact_pf_id).val(); 
	var su_contact_fname = $("#su_contact_fname").val(); 
	var su_contact_lname = $("#su_contact_lname").val(); 
	var su_tel_contact = $("#su_tel_contact").val(); 

	if (su_work == "") {
		$("#input_work").a   ddClass("has-danger");
		$('#su_work').focus();
		// alert("กรุณากรอกอาชีพของผู้ใช้บริการ");
		return false;
	}else if (su_workplace == "") {
		$("#input_work").addClass("has-danger");
		$('#su_work').focus();
		// alert("กรุณากรอกสถานที่ทำงาน /สถานศึกษาของผู้ใช้บริการ");
		return false;
	}else if (su_tel == "") {
		$("#input_work").addClass("has-danger");
		$('#su_work').focus();
		// alert("กรุณากรอกเบอร์โทรศัพท์ของผู้ใช้บริการ");
		return false;
	}
	if (su_contact_pf_id != 0) {
		
		$("#input_con_pf").addClass("has-danger");
		document.getElementById("input_con_pf").focus();
		// alert("กรุณากรอกความเกี่ยวข้องระหว่างผู้ใช้บริการและบุคคลอ้างอิง");
		return false;
	}else if (su_contact_fname == "") {
		// alert("กรุณากรอกชื่อของบุคคลอ้างอิง");
		return false;
	}else if (su_contact_lname == "") {
		// alert("กรุณากรอกนามสกุลของบุคคลอ้างอิง");
		return false;
	}else if (su_tel_contact == "") {
		// alert("กรุณากรอกเบอร์โทรศัพท์ของบุคคลอ้างอิง");
		return false;
	}
}
	// $(document).on("click", ".btn_delete", function () {
		// var deleteId = $(this).data('id');
		// $(".modal-body #delete_id").val( deleteId );
	// });

</script>

</head>
<body> 
<div class="card" >
	<div class="cen" >
		<div class="card-header card-header-primary">
				<h3><font color="white">แบบฟอร์มการสมัครสมาชิก</font></h3>
		</div>
	</div>
	<!-- <br>"  onsubmit="return validateForm()"-->
	<form  method="POST" id="form_register" name="myForm"  action="<?php echo site_url("swm/frontend/Swm_register/insert_su_data"); ?>" >
	<div class="container" >
		<br><br>
		<font size="5"color="red"> * </font><font size="5" >กรุณากรอกข้อมูลให้ครบถ้วน</font>
			<div class="mymarginn2">
				<ul><br>
				<h4><li>ข้อมูลการติดต่อ </h4>
				<div class="row"> 
					<div class="col-sm-6 control-label">
						<div class="form-group label-floating bmd-form-group" id="input_work">
							<label for='su_work' class="bmd-label-floating"><p>อาชีพ<font color="red"> *</font></p></label>
							<input type="text" class="form-control" name = "su_work" id="su_work" >
						</div>
					</div> 
					<div class="col-sm-6 control-label" >
						<div class="form-group label-floating bmd-form-group">
							<label class="bmd-label-floating"><p>สถานที่ทำงาน / สถานที่ศึกษา<font color="red"> *</font></p></label>
							<input type="text" class="form-control" name = "su_workplace" id="su_workplace">
						</div>
					</div>
				</div>
				<!-- <div class="row">
					<div class="col-sm-6 control-label">
						<div class="form-group label-floating bmd-form-group">
							<label  class="bmd-label-floating"><p>เบอร์โทรศัพท์<font color="red"> *</font></p></label>
							<input type="text" class="form-control" name = "su_tel" id="su_tel">
						</div>
					</div>
				</div> -->
				<br>
				
		 <!-- <div class="row">
			<div class="col-sm-6 control-label">
				<div class="form-group label-floating bmd-form-group">
					<label  class="bmd-label-floating"><p>บุคคลที่สามารถติดต่อได้ เกี่ยวข้องเป็น<font color="red"> *</font></p></label>
					<input type="text" class="form-control" name="su_relation_ref" id="su_relation_ref">
				</div>
			</div>
		</div>	-->
				</ul>
			</div>
			<div class = "mymarginn">
				<h4><li>ข้อมูลบุคคลที่สามารถติดต่อได้ </h4><br>
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
						<div class="form-group label-floating bmd-form-group">
							<label  class="bmd-label-floating"><p>ชื่อ<font color="red"> *</font></p></label>
							<input type="text" class="form-control" name = "su_contact_fname" id="su_contact_fname">
						</div>
					</div>				
					<div class="col-sm-6 control-label" >
						<div class="form-group label-floating bmd-form-group">
							<label  class="bmd-label-floating"><p>นามสกุล<font color="red"> *</font></p></label>
							<input type="text" class="form-control" name = "su_contact_lname" id="su_contact_lname">
						</div>
					</div>	
				</div>			
				<div class="row">
					<div class="col-sm-6 control-label">
						<div class="form-group label-floating bmd-form-group">
						<label  class="bmd-label-floating"><p>เบอร์โทรศัพท์<font color="red"> *</font></p></label>
							<input type="text" class="form-control" name = "su_tel_contact" id="su_tel_contact">
						</div>
					</div>
				</div>
					<br>
			</div>			 
	</div>	
	<div class="row">
		<div class="col-md-12 control-label" align ="right">
			<button type="submit" class="btn btn-success" value="Submit" onclick="return validateForm()">ตกลง</button>
		</div>
	</div>
</form>
<br>			
</div>	
</body>
</html>	