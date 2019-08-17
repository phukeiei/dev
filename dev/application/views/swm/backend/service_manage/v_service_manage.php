<!--/*
* v_edit_status
* Edit status  member 
* @input    status
* @output   id,name,lastname,age,status
* @author   Kanathip Phithaskilp
* @Update   Kanathip Phithaskilp
* @Update Date  2562-5-17
 */-->
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>บันทึกการเข้าใช้บริการ</title>
</head>

<body>

	<script>
		$().ready(() => {

			reset()

			$(".radio").click(() => {
				let value = $("input[name='age']:checked").val()
				if (!$("input[name='age']").attr('disabled')) {
					if (value == 0) {
						getCost(10, 1)
					} else {
						getCost(20, 1)
					}
				}
			})

			$('#insert_btn').attr('disabled', true)
		})

		function reset(){
			$("#mem_status").text("")
			$("#memid").val("")
			$('#scp_id').val("") 
			$('#su_id').val("")
			$('#cost').val(0)
		}

		function checkMember() {
			let memid = $("#memid").val()
			

			$.post(
				"<?php echo site_url('/swm/backend/Swm_service_manage/search_member'); ?>", {
					"memid": memid
				},
				(res) => {
					let data = JSON.parse(res)
					console.log(data)
					if (data != null) {
						$('#su_id').val(data.su_id)
						$("#mem_status").removeClass("text-danger")
						$("#mem_status").addClass("text-success")
						$("#mem_status").text("คุณเป็นสมาชิก")
						let ages = parseInt(data.age)
						if (ages > 18) {
							$("#ageBelow18").children().removeClass('checked')
							$("#ageMoreThan18").children().addClass('checked')
						} else {
							$("#ageMoreThan18").children().removeClass('checked')
							$("#ageBelow18").children().addClass('checked')
						}

						$("input[name='age']").attr("disabled", true)
						getCost(ages, 2)
					} else {
						$('#su_id').val("")
						$("#mem_status").removeClass("text-success")
						$("#mem_status").addClass("text-danger")
						$("#mem_status").text("คุณไม่ได้เป็นสมาชิก")
						$("input[name='age']").removeAttr("disabled")
					}
				}
			)
		}

		// 1 is not member , 2 is member
		function getCost(ages, isMember) {
			$.post(
				"<?php echo site_url('/swm/backend/Swm_service_manage/get_cost'); ?>", {
					"ages": ages,
					"isMember": isMember
				},
				(res) => {
					let data = JSON.parse(res)
					let cost = data.scp_cost
					console.log(data)
					$('#cost').val(cost)
					$('#scp_id').val(data.scp_id) 

					$('#insert_btn').removeAttr('disabled')
				}
			)
		}
	</script>

	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading panel_heading_iserl">
				<h2>การเข้าใช้บริการ</h2>
			</div>
			<div class="panel-body">
				<form method="post" action="<?php echo site_url('/swm/backend/Swm_service_manage/insert'); ?>">
					<input type="hidden" id="su_id" name="su_id">
					<input type="hidden" id="scp_id" name="scp_id">
					<div>
						<label class="col-sm-2 control-label">รหัสสมาชิก</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="memid" id="memid" onkeyup="checkMember()" placeholder="รหัสสมาชิก">
						</div>
						<!-- <input class="btn btn-danger btn_iserl tooltips" title="คลิกปุ่มเพื่อตรวจสอบข้อมูล" type="button" value="ตรวจสอบ"  /> -->
						<p>&emsp;<small id="mem_status" ></small></p>
					</div>

					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-heading panel_heading_sub_iserl">
								<h2>บันทึกวันที่ใช้บริการ</h2>
							</div>
							<div class="panel-body">
								<label class="col-sm-1 control-label">วันที่</label>
								<div class="col-sm-4">
									<input type="date" class="form-control" name="date" value="<?php echo getNowDate(); ?>" placeholder="วัน/เดือน/ปี">
								</div>

								<label class="col-sm-1 control-label">เวลา</label>
								<div class="col-sm-4"><input type="time" class="form-control" value="<?php echo date("H:i"); ?>" name="time"></div>
								<br><br>
								<div class="form-group">
									<label class="col-sm-1 control-label">อายุ</label>
									<div class="col-sm-8">
										<label class="radio icheck" id="ageBelow18">
											<input type="radio" name="age" checked="true" value="0">ต่ำกว่า 18 ปี
										</label>
										<label class="radio icheck" id="ageMoreThan18">
											<input type="radio" name="age" value="1">18 ปีขึ้นไป
										</label>
									</div>
								</div>
								<br><br><br>
								<label class="col-sm-1 control-label">ราคา</label>
								<div class="col-sm-4">
									<input type="number" class="form-control" name="cost" id="cost" placeholder="ราคา" >
								</div>


							</div>
						</div>
					</div>
					<br><br><br><br><br><br><br><br><br><br><br>
					<span class="text-gray demo-btns">
						<a class="btn btn-inverse btn_iserl tooltips" title="คลิกปุ่มเพื่อเคลียร์ข้อมูล" onclick="reset()">เคลียร์</a>
						<button class="btn btn-success btn_iserl tooltips pull-right" title="คลิกปุ่มเพื่อบันทึกข้อมูล" id="insert_btn" type="submit">บันทึก</button>
					</span>
				</form>
			</div>
		</div>
</body>

</html>