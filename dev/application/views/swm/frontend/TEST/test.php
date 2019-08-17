
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


    <style>
        body {
            font-family: "Lato", sans-serif;
        }

        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 18px;
            }
        }
    </style>

    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>
</head>

<body>
   <div class="card">
	<div class="card-body">
	<div class="cen" >
		<div class="lol" >
		<h1> ข้อมูลส่วนตัว </h1>
		</div>
	</div> <br>
	<div class="container" ><br>
	<div class='row'>
		<div class="col-md-4">
		<center>
		<img src ="<?php echo base_url();?>/frontend/assets/img/faces/christian.jpg" class="rounded-circle img-fluid" width = "200px">	
		</center>
		</div>
		<div class="cen" >
		<div class="col-md-12">
				 <br>		
				 <font size = "4" >ชื่อ-นามสกุล :  <?php echo $rs_ps->full_name; ?> </font> <br>
				 <font size = "4" >วันเกิด :  <?php echo abbreDate2($rs_ps->psd_birthdate); ?></font> <br>
				 <font size = "4">อายุ :  <?php echo calAge3($rs_ps->psd_birthdate);?>   ปี </font> <br>
				 <font size = "4">เบอร์โทร :  <?php echo $rs_ps->psd_cellphone ;?> </font> <br>
				 <font size = "4">อาชีพ :  <?php echo $rs_ps->su_work;?></font> <br>
				 <font size = "4">สถานที่ทำงาน/สถานที่ศึกษา :  <?php echo $rs_ps->su_workplace;?></font> <br>
				 <font size = "4">ที่อยู่ :  <?php echo '';?> </font> <br>   
				 <U><font size = "4">บุคคลที่สามารถติดต่อได้ :  </font></U><br>
				 <font size = "4">ชื่อ-นามสกุล :  <?php echo $rs_ps->contact_full_name; ?> </font> <br>
				 <font size = "4">เบอร์โทร :  <?php echo $rs_ps->su_tel_contact;?> </font> <br>
		</div>
		</div>	
	</div>
	<br><br>
		<a href = href="#">
			<div class="col-auto align-middle" align="right">
				<button type="button" class="btn btn-success" >แก้ไขข้อมูลส่วนตัว</button>
			</div>  
		</a>
		<br>
	</div>
	
	</div>	
</div>

</body>