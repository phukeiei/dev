<!---
* v_download_data
* view v_download_data
*@author Khwanchai Nontawichit
*@Create Date 2562-05-17
--->
<style>
<!--- border --->
p.round1{
	border: 1px solid black;
	border-radius: 2px;
	background-color:white;
	width:200px;
}	
i.lol{
	border: 2px solid black;
	border-radius: 2px;
	background-color:white;
	width:200px;
}
div#border_1{
	display:block;
	width:400px;
	height:200px;
	border:1px solid;
	background-color:white;
	word-wrap:break-word;
	float:left;
}
div#border_2{
	display:block;
	width:100px;
	height:110px;
	border:1px solid;
	background-color:white;
	word-wrap:break-word;
	float:left;
}
.frame_pic{
	width:1in;
	height:1.5in;
	border:1px solid;
	background-color:white;
	word-wrap:break-word;
	vertical-align: center;
}

<!-------------- CARD ------------------>
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
 
  width: 80%;
  border-radius: 5px;
  margin: 10px 0;
  margin-left: 100px;
  margin-right: -100px;

}
.container {
  padding: 2px 16px;
}

.mymargin {
  margin-left: 16px;
  margin-right: 16px;
}
.size_a4{
	width: 21cm;
	height: 29.7cm;
	display: block;
	margin: 0 auto;
	margin-bottom: 0.5cm;
}
hr { 
  display: block;
  margin-top: 0.5em;
  margin-bottom: 0.5em;
  margin-left: auto;
  margin-right: auto;
  border-style: inset;
  border-width: 2px;
  color: #000000;
} 

</style>
<script>
</script>
<?php /*pre($rs_ps_data);
	  pre($rs_su_data);*/?>
<!------------------------- Form_regis --------------------------->
<br>
<div class="col-md-12" align ="center" >
<div class="col-md-7" align ="center"  style="margin-left: 100px;">
	

		<div class="card col-md-12" style="padding: 10px 50px">
			<br>
			<table width="100%" border="0">
			<tr>
			<?php //echo base_url();/application/views/swm/frontend/IMG/LogoBW.png?>
				<td width="25%" align="center" ><img src ="" class="rounded img-fluid" width = "150px"></td>
				<td width="50%" align="center">ใบสมัครสมาชิกศูนย์นันทนาการเพื่อประชาชน<br>เทศบาล</td></td>
				<td width="25%" align="center" >
					<div valign="center">
						<div class="frame_pic" >
							ติดรูปถ่าย <br> ขนาด 1 นิ้ว
						</div>
					</div>
				</td>
			</tr>
		</table>
		<hr><br>
		<table width="100%" border="0">
			<tr>
				<td width="35%" align="center">
					<span>รหัสสมาชิก<?php echo "&nbsp;".$rs_su_data[0]->su_code;?></span>
					
				</td>
				<td width="35%" align="center">
					ประชาชนทั่วไป
				</td>
				<td width="30%" valign="bottom" align="center">
					<span>วันที่</span>
					<span><?php echo "&nbsp;".fullDateP($rs_su_data[0]->su_create_date); ?><span>
				</td>
			</tr>
		</table>
		<br>
		<table width="100%" border="0">
			<tr>
				<td width="30%">
					<span><?php echo"&emsp;"?>ชื่อ</span>
					<span><?php echo "&nbsp;".$rs_ps_data[0]->pf_name; ?><?php echo "&nbsp;".$rs_ps_data[0]->ps_fname; ?></span>
				</td>
				<td width="30%">
					<span>นามสกุล</span>
					<span><?php echo "&nbsp;".$rs_ps_data[0]->ps_lname; ?></span>
				</td>
				<td width="40%">
					<span>เกิดวันที่</span>
					<span><?php echo " ".fullDateP($rs_su_data[0]->su_birthday); ?></span>
				</td>
			</tr>
		</table>
		<br>
		<table width="100%" border="0">
			<tr>
				<td width="20%">
					<span><?php echo"&emsp;"?>อายุ</span>
					<span><?php echo calAge3($rs_su_data[0]->su_birthday)?></span>
					<span>ปี<span>
				</td>
				<td width="80%">
					<span>อาชีพ</span>
					<span><?php echo $rs_su_data[0]->su_work;?></span>
				</td>
			</tr>
		</table>
		<br>
		<table width="100%" border="0">
			<tr>
				<td>
					<span><?php echo"&emsp;"?>สถานที่ทำงาน/สถานศึกษา</span>
					<span><?php echo "&emsp;".$rs_su_data[0]->su_workplace;?></span>
				</td>
			</tr>
		</table>
		<br>
		<table width="100%">
			<tr>
				<td>
					<span><?php echo"&emsp;"?>บุคคลอ้างอิงที่สามารถติดต่อได้</span>
				</td>
			</tr>
		</table>
		<br>
		<table width="100%" border="0">
			<tr>
				<td width="30%">
					<span><?php echo"&emsp;"?>ชื่อ</span>
					<span><?php echo "&nbsp;".$rs_ps_data[0]->pf_name."&nbsp;"; ?><?php echo "&nbsp;".$rs_su_data[0]->su_contact_fname;?></span>
				</td>
				<td width="30%">
					<span>นามสกุล</span>
					<span><?php echo "&nbsp;".$rs_su_data[0]->su_contact_lname;?></span>
				</td>
				<td width="40%">
					<span>เบอร์โทร</span>
					<span><?php echo "&nbsp;".$rs_su_data[0]->	su_tel_contact;?></span>
				</td>
			</tr>
		</table>
		<br>
		<table width="100%" border="0">
			<tr>
				<td>
					<p style="text-align:justify"><?php echo"&emsp;&emsp;"?>มีความประสงค์จะสมัครสมาชิก เพื่อเข้าใช้บริการศูนย์นันทนาการเพื่อประชาชน เทศบาล</p><br>
						<p style="text-align:justify">นันทนาการเพื่อประชาชน เทศบาล 
ของเทศบาลฯ เป็นที่เข้าใจดีเเล้ว ทั้งนี้ในการใช้สนามกีฬาต่างๆ ให้อยู่ในความรับผิดชอบของข้าพเจ้าเอง<br>เเละจะไม่ก่อให้เกิดความผูกพันธ์หรือความรับผิดชอบเเก่เทศบาลตำบลในทางกฏหมายไม่ว่าในกรณีใดๆ และข้าพเจ้าจะไม่เรียกร้องสิทธิ์ใดๆทั้งสิ้น</p>
						<p><?php echo"&emsp;&emsp;"?>ข้าพเจ้ารับรอง ข้อความข้างต้นนี้เป็นความจริงทุกประการเเละจะถือตามระเบียบโดยเคร่งครัด</p>
				</td>
			</tr>
		</table>

		<table width="100%">
			<tr>
				
				<td width="60%" align="center">
					<table align="center" border="1" width="80%">
						<tr>
							<td>
								<p align="center" >หลักฐานการสมัครงาน</p>
								<p>๑. ใบสมัครที่กรอกข้อมูลครบถ้วนเเล้ว</p>
								<p>๒. รูปถ่ายหน้าตรงไม่สวมหมวก ๑ นิ้ว ๒ รูป</p>
								<p>๓. สำเนาบัตรประชาชน</p>
								<p>๔. เงินค่าสมัคร ๕๐๐ บาท (ต่อ ๑ ปี)</p>
							</td>
						</tr>
					</table>
				</td>
				<td width="50%">
					<p align="center">(ลงชื่อ)<?php echo "&nbsp;".$rs_ps_data[0]->pf_name; ?><?php echo "&nbsp;".$rs_ps_data[0]->ps_fname."&nbsp;"; ?><?php echo "&nbsp;".$rs_ps_data[0]->ps_lname."&nbsp;"; ?>ผู้สมัคร</p>
					<p align="center">(.......................................................................................)</p>
					<p align="center">
						สำหรับเจ้าหน้าที่<br>
						ได้ตรวจสอบหลักฐานถูกต้องเเล้ว</p>
					<p align="center">
						(ลงชื่อ)..........................................................ผู้ตรวจสอบ <br>
						(...................................................................................)
					</p>
				</td>
			</tr>
		</table>
		<br><br>
		<div class="col-auto align-middle,panel-footer" >
			<div class="row">
				<div class="col-md-6" style = "text-align:left;"><a class="btn btn-inverse"  href="<?php echo site_url('/swm/frontend/Swm_show_service'); ?>">ย้อนกลับ</a></div>
				<div class="col-md-6" style = "text-align:right;">
					<a href="<?php echo site_url("/swm/frontend/Swm_download_regis/export_form_register"); ?>" class="btn" target="_blank"><i class="fa fa-print"></i>&nbsp;&nbsp;พิมพ์<div class="ripple-container"></div></a>
				</div>
			</div>
		</div>	
</div>
</div>
<br><br>


