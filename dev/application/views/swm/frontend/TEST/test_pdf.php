<head>
    
	<meta charset="UTF-8">
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
    <title>Document</title>
</head>

<body>


				<p>ชื่อ-นามสกุล :  <?php echo $rs_ps->full_name; ?> </p> <br>
				<p>วันเกิด :  <?php echo abbreDate2($rs_ps->psd_birthdate); ?></p> <br>
				<p>อายุ :  <?php echo calAge3($rs_ps->psd_birthdate);?>   ปี </p> <br>
				<p>เบอร์โทร :  <?php echo $rs_ps->psd_cellphone ;?> </p> <br>
				<p>อาชีพ :  <?php echo $rs_ps->su_work;?></p> <br>
				<p>สถานที่ทำงาน/สถานที่ศึกษา :  <?php echo $rs_ps->su_workplace;?></p> <br>
				<p>ที่อยู่ :  <?php echo '';?> </p> <br>   
				<p>บุคคลที่สามารถติดต่อได้ :  </p></U><br>
				<p>ชื่อ-นามสกุล :  <?php echo $rs_ps->contact_full_name; ?> </p> <br>
				<p>เบอร์โทร :  <?php echo $rs_ps->su_tel_contact;?> </p> <br>

</body>