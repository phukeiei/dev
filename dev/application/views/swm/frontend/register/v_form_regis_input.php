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
		.shift p,
		div label.pad p {
			display: inline-flex;
		}

		#input_work {
			width: 10rem;
		}

		.d-flex.justify-content-start.flex-row div:nth-child(2) {
			/* background:red; */

		}

		font {
			margin-left: 1rem;
		}

		.shift div {
			margin-right: 2rem;
			display: flex;
			flex-wrap: wrap;
		}

		.card {
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
			transition: 0.3s;
			max-width: 80%;
			border-radius: 5px;
			margin: 36px 0;
			margin-left: 129px;
			margin-right: -120px;
			padding-bottom: 1rem;

		}

		.card:hover {
			box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);

			grid-gap: 1rem;
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

		p {
			font-size: 1rem;
		}

		.lol {
			background-color: DodgerBlue;
			width: 1010px;
			border: 6 px solid white;
			padding: 10px;
			margin: 0px;

		}

		.checkbox {
			padding: 20px;
			margin: 0px;
		}

		.cen {
			text-align: center;
		}

		.mymarginn {
			margin-left: 40px;
			margin-right: 30px;
		}

		.mymarginn2 {
			margin-right: 30px;
		}

		.pad {
			padding-top: 35px;
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
			if (su_work == "") {
				$("#input_work").addClass("has-danger");
				$('#su_work').focus();
				validate_bool = false;
				//return false;
			} else {
				$("#input_work").removeClass("has-danger");
			}
			if (su_workplace == "") {
				$("#input_workplace").addClass("has-danger");
				$('#su_workplace').focus();
				// alert("กรุณากรอกสถานที่ทำงาน /สถานศึกษาของผู้ใช้บริการ");
				validate_bool = false;
			} else {
				$("#input_workplace").removeClass("has-danger");
			}
			if (su_contact_fname == "") {
				$("#input_su_contact_fname").addClass("has-danger");
				$('#su_contact_fname').focus();
				// alert("กรุณากรอกสถานที่ทำงาน /สถานศึกษาของผู้ใช้บริการ");
				validate_bool = false;
			} else {
				$("#input_su_contact_fname").removeClass("has-danger");
			}
			if (su_contact_lname == "") {
				$("#input_su_contact_lname").addClass("has-danger");
				$('#su_contact_lname').focus();
				// alert("กรุณากรอกสถานที่ทำงาน /สถานศึกษาของผู้ใช้บริการ");
				validate_bool = false;
			} else {
				$("#input_su_contact_lname").removeClass("has-danger");
			}
			if (su_tel_contact == "") {
				$("#input_su_tel_contact").addClass("has-danger");
				$('#su_tel_contact').focus();
				// alert("กรุณากรอกสถานที่ทำงาน /สถานศึกษาของผู้ใช้บริการ");
				validate_bool = false;
			} else {
				$("#input_su_tel_contact").removeClass("has-danger");
			}

			console.error(su_work);
			console.error(su_workplace);
			console.error(su_contact_fname);
			console.error(su_contact_lname);
			console.error(su_tel_contact);

			return validate_bool;
		}
		$('#su_tel_contact').inputmask({
            mask: "999-999-9999"
        });
	</script>

</head>

<body>
	<div class="card">
		<div class="cen">
			<div class="card-header card-header-primary">
				<h3>
					<font color="white">แบบฟอร์มการสมัครสมาชิก</font>
				</h3>
			</div>
		</div>
		<!-- <br>"  onsubmit="return validateForm()"-->
		<!--<form method="POST" id="form_register" name="myForm" action="<?php echo site_url("swm/frontend/Swm_register/insert_su_data"); ?>">-->
		<?php echo form_open_multipart('swm/frontend/Swm_register/insert_su_data'); ?>
		<div class="container">
			<br><br>
			<div class="d-flex justify-content-center flex-row mb-5">
				<font size="5" color="red"> * </font>
				<font size="5">กรุณากรอกข้อมูลให้ครบถ้วน</font>
			</div>
			<div class="mymarginn2">
				<ul><br>
					<div class="row">
						<div class="col-sm-4 control-label">
							<div class="col-md-8 col-sm-8">
								<h4>อัปโหลดรูปโปรไฟล์
								</h4>
								<div class="fileinput fileinput-new text-center" data-provides="fileinput">
									<div class="fileinput-new thumbnail img-raised">
										<img src="http://style.anu.edu.au/_anu/4/images/placeholders/person_8x10.png" alt="...">
									</div>
									<div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
									<div>
										<span class="btn btn-raised btn-round btn-default btn-file">
											<span class="fileinput-new">Select image</span>
											<span class="fileinput-exists">Change</span>
											<input id="file_input" type="file" name="profile_img"/>
										</span>
										<a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-8 control-label">
							<div class="d-flex justify-content-center flex-column">
								<h4>
									<li>ข้อมูลการติดต่อ
								</h4>
								<!--<div class="d-flex justify-content-start flex-row shift d-sm-none">
										<div class="form-group label-floating bmd-form-group" id="input_work">
											<label for='su_work' class="bmd-label-floating">
												<p>อาชีพ<font color="red"> *</font>
												</p>
											</label>
											<input type="text" class="form-control" name="su_work" id="su_work">
										</div>
										<div class="form-group label-floating bmd-form-group" id='input_workplace'>
											<label class="bmd-label-floating">
												<p>สถานที่ทำงาน / สถานที่ศึกษา<font color="red"> *</font>
												</p>
											</label>
											<input type="text" class="form-control" name="su_workplace" id="su_workplace">
										</div>
									</div>-->
								<div class="d-flex justify-content-start flex-column shift">
									<div class="form-group label-floating bmd-form-group" id="input_work">
										<label for='su_work' class="bmd-label-floating">
											<p>อาชีพ<font color="red"> *</font>
											</p>
										</label>
										<input type="text" class="form-control" name="su_work" id="su_work">
									</div>
									<div class="form-group label-floating bmd-form-group" id='input_workplace'>
										<label class="bmd-label-floating">
											<p>สถานที่ทำงาน / สถานที่ศึกษา<font color="red"> *</font>
											</p>
										</label>
										<input type="text" class="form-control" name="su_workplace" id="su_workplace">
									</div>
								</div>
								<h4>
									<li>ข้อมูลบุคคลที่สามารถติดต่อได้
								</h4>
								<div class="row">
									<div class="col-sm-7 control-label ">
										<div class="form-group bmd-form-group">
											<div class="input-group">
												<div class="input-group-prepend">
													<!-- <span class="input-group-text"> -->
													<label class='pad'>
														<p>คำนำหน้าชื่อ <font color="red">*</font>
														</p>
													</label>
													<div class="btn-group bootstrap-select">
														<select class="selectpicker" data-style="select-with-transition" title="" data-size="7" tabindex="-98" name="su_contact_pf_id" id='su_contact_pf_id'>
															<option value='0' selected>กรุณาเลือกคำนำหน้าชื่อ</option>
															<?php $round = 0;
															foreach ($opt_prefix->result() as $value) {
																?>
															<option value="<?php echo $value->pf_id; ?>"><?php echo $value->pf_name; ?></option>
															<?php } ?>
														</select>
													</div>
													<!-- </span> -->
												</div>

											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6 control-label">
										<div class="form-group label-floating bmd-form-group" id='input_su_contact_fname'>
											<label class="bmd-label-floating">
												<p>ชื่อ<font color="red"> *</font>
												</p>
											</label>
											<input type="text" class="form-control" name="su_contact_fname" id="su_contact_fname">
										</div>
									</div>
									<div class="col-sm-6 control-label">
										<div class="form-group label-floating bmd-form-group" id='input_su_contact_lname'>
											<label class="bmd-label-floating">
												<p>นามสกุล<font color="red"> *</font>
												</p>
											</label>
											<input type="text" class="form-control" name="su_contact_lname" id="su_contact_lname">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6 control-label">
										<div class="form-group label-floating bmd-form-group" id='input_su_tel_contact'>
											<label class="bmd-label-floating">
												<p>เบอร์โทรศัพท์<font color="red"> *</font>
												</p>
											</label>
											<input type="text" class="form-control" name="su_tel_contact" id="su_tel_contact">
										</div>
									</div>
								</div>
								<br>
							</div>
						</div>
						<br>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12 control-label" align="right">
					<button type="submit" class="btn btn-success" value="Submit" onclick="return validateForm()">ตกลง</button>
				</div>
			</div>
		</div>

	</div>

	</form>
	<br>
	</div>
</body>

</html>