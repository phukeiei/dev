<head>
    <meta charset="UTF-8">
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
    <!--<title>ใบสมัครสมาชิกศูนย์นันทนาการเพื่อประชาชนเทศบาลตำบล</title>-->
</head>
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
.photo_frame{
	border-collapse: collapse;
	border: 1px solid black;
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

<div class="col-md-12" align ="left"  style="margin-left: 10px;">
	

		<div class="card col-md-12" >
			<br>
			<table width="100%">
			<tr>
			<?php //echo base_url();/application/views/swm/frontend/IMG/LogoBW.png?>
				<td width="25%" align="center" ><img src ="" class="rounded img-fluid" width = "150px"></td>
				<td width="50%" align="center"><h3>ใบสมัครสมาชิกศูนย์นันทนาการเพื่อ<br><br>ประชาชนเทศบาล</h3></td>
				<td width="25%" align="center">
					<div valign="center">
						<table align="left" class="photo_frame" width="70%">
						<tr>
							<td>
							<br><br><p align="center">ติดรูปถ่าย<br><br>ขนาด&nbsp;1&nbsp;นิ้ว</p><br><br><br><br>
							</td>
						</tr>
					</table>
					</div>
				</td>
			</tr>
		</table>
		<hr><br>
		<table width="100%">
			<tr>
				<td width="35%" align="center">
					<span>รหัสสมาชิก<?php echo "&nbsp;".$rs_su_data[0]->su_code;?></span>
					
				</td>
				<td width="30%" align="center">
					ประชาชนทั่วไป
				</td>
				<td width="35%" valign="bottom" align="center">
					<span>วันที่</span>
					<span><?php echo "&nbsp;".fullDateP($rs_su_data[0]->su_create_date); ?><span>
				</td>
			</tr>
		</table>
		<br>
		<table width="100%" border="0">
			<tr>
				<td width="25%">
					<span><?php echo"&emsp;"?>ชื่อ</span>
					<span><?php echo "&nbsp;".$rs_ps_data[0]->pf_name; ?><?php echo "&nbsp;".$rs_ps_data[0]->ps_fname; ?></span>
				</td>
				<td width="25%">
					<span>นามสกุล</span>
					<span><?php echo "&nbsp;".$rs_ps_data[0]->ps_lname; ?></span>
				</td>
				<td width="50%">
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
				<td width="25%">
					<span><?php echo"&emsp;"?>ชื่อ</span>
					<span><?php echo "&nbsp;".$rs_ps_data[0]->pf_name."&nbsp;"; ?><?php echo "&nbsp;".$rs_su_data[0]->su_contact_fname;?></span>
				</td>
				<td width="25%">
					<span>นามสกุล</span>
					<span><?php echo "&nbsp;".$rs_su_data[0]->su_contact_lname;?></span>
				</td>
				<td width="50%">
					<span>เบอร์โทร</span>
					<span><?php echo "&nbsp;".$rs_su_data[0]->	su_tel_contact;?></span>
				</td>
			</tr>
		</table>
		<br>
		<table width="100%" border="0">
			<tr>
				<td>
				<p><div>&emsp;&emsp;&emsp;มีความประสงค์จะสมัครสมาชิก เพื่อเข้าใช้บริการศูนย์นันทนาการเพื่อประชาชน เทศบาล</div><br>
				<div>&emsp;&emsp;&emsp;ข้าพเจ้าได้ทราบระเบียบการปฎิบัติเกี่ยวกับการใช้ศูนย์กีฬาและอุปกรณ์อำนวยความสะดวกประจำสนามกีฬาของเทศบาลฯ&emsp;เป็นที่เข้าใจดีแล้ว&emsp;ทั้งนี้ในการใช้สนามกีฬาต่างๆ&emsp;ให้อยู่ในความรับผิดชอบของข้าพเจ้าเองและจะไม่ก่อให้เกิดความผูกพันหรือความผูกพันหรือความรับผิดชอบแก่เทศบาลตำบลในทางกฎหมายไม่ว่าในกรณีใดๆ&emsp;และข้าพเจ้าจะไม่เรียกร้องสิทธิ์ใดๆ&emsp;ทั้งสิ้น</p></div><br>
						<p>
							
						</p>
						<p>&emsp;&emsp;&emsp;ข้าพเจ้ารับรอง ข้อความข้างต้นนี้เป็นความจริงทุกประการเเละจะถือตามระเบียบโดยเคร่งครัด</p><br><br><br>
						
				</td>
			</tr>
		</table>

		<table width="100%" height="500%" >
			<tr>
				
				<td width="75%" align="left">
					<table align="left" width="100%" class="photo_frame">
						<tr>
							<td>
								<br><font size = "6" ><b>&emsp;&emsp;&emsp;&emsp;&emsp;หลักฐานการสมัคร</b></font><br>
								<font size = "6">&emsp;๑. ใบสมัครที่กรอกข้อมูลครบถ้วนเเล้ว </font><br>
								<font size = "6">&emsp;๒. รูปถ่ายหน้าตรงไม่สวมหมวก ๑ นิ้ว ๒ รูป</font><br>
								<font size = "6">&emsp;๓. สำเนาบัตรประชาชน</font><br>
								<font size = "6">&emsp;๔. เงินค่าสมัคร ๕๐๐ บาท ต่อ ๑ ปี)</font><br><br><br><br>
							</td>
						</tr>
					</table>
				</td>
				<td width="50%"><font size = "6">
					&emsp;&emsp;&emsp;<p align="center">&emsp;&emsp;&emsp;(ลงชื่อ)<?php echo "&nbsp;".$rs_ps_data[0]->pf_name; ?><?php echo "&nbsp;".$rs_ps_data[0]->ps_fname."&nbsp;"; ?><?php echo "&nbsp;".$rs_ps_data[0]->ps_lname."&nbsp;"; ?>ผู้สมัคร<font><br><br>
					<p align="center">&emsp;&emsp;&emsp;(............................................................)</p><br>
					<p align="center">
						&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;สำหรับเจ้าหน้าที่<br>
						&emsp;&emsp;&emsp;&emsp;&emsp;ได้ตรวจสอบหลักฐานถูกต้องเเล้ว</p><br><br>
					<p align="center">
						&emsp;(ลงชื่อ)...........................................ผู้ตรวจสอบ <br><br>
						&emsp;&emsp;(................................................................)
					</p></h4>
				</td>
			</tr>
		</table>
		
</div>
</div>
<br><br>