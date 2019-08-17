<!--
*
*showinformation
*view show_su_data
*@author phattanan chawalitsuwan
*@Create Date 2562-05-18
*
-->
<!DOCTYPE html>
<html lang="en">
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
.lol{
  background-color: DodgerBlue;
  width: 1010px;
  border: 6 px solid white;
  padding: 10px;
  margin: 0px;
  
}

.cen{
	text-align :center;
}	
</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Show Information</title>
	
</head>
<body>

<div class="card">
	<div class="card-body">
	<div id="mylayout_1">
	    <div class="cen">
      <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
      <div class="card-header card-header-primary">
        
		<h3><font color="white">ข้อมูลส่วนตัว</font></h3>
		
		</div>
		</div> <br>
		

	<div class="container" ><br>
	<div class='row'>
		<div class="col-md-4">
		<center>
		<img src ="<?php echo base_url();?>/frontend/assets/img/faces/christian.jpg" class="rounded-circle img-fluid" width = "200px">	
		</center>
		</div>
	
		<div class="col-md-8">
				 
				 <font size = "4" ><b>ชื่อ-นามสกุล :</b>   <?php echo $full_name ; ?> </font> <br>
				 <font size = "4" ><b>วันเกิด :  </b><?php echo $birthdate ; ?></font>&nbsp;
				 <font size = "4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>อายุ :  </b><?php echo $age ;?>   ปี </font> <br>
				 <font size = "4"><b>เบอร์โทร :  </b><?php echo $phone ;?> </font> 
				 <font size = "4">&nbsp;&nbsp;&nbsp;&nbsp;<b>อาชีพ :  </b><?php echo $work ;?></font> <br>
				 <font size = "4"><b>สถานที่ทำงาน/สถานที่ศึกษา :  </b><?php echo $workplace ;?></font> <br>
				 <font size = "4"><b>ที่อยู่ :  </b><?php echo $address.$district.$ampn;?></font><br>
				 <font size = "4"><?php echo $province.$zipcode;?></font><br><br>
				 <U><font size = "4"><b>บุคคลที่สามารถติดต่อได้</b> </font></U><br>
				 <font size = "4"><b>ชื่อ-นามสกุล :  </b><?php echo $contact_full_namee ; ?> <br>
				 <font size = "4"><b>เบอร์โทร :  </b><?php echo $contact_tell ;?> </font> <br>
				
		</div>
		
	</div>
	<br><br>
	<div class="col-auto align-middle,panel-footer" >
		<div class="row">
			<div class="col-md-6"><a class="btn btn-inverse"  href="<?php echo site_url('/swm/frontend/Swm_show_service'); ?>">ย้อนกลับ</a></div>
			<div class="col-md-6" style = "text-align:right;">
				<a href="<?php echo site_url($this->config->item('swm_folder').$this->config->item('swm_folder_front')."Swm_manage_su_data/load_view_form_edit"); ?>">
						<button type="button" class="btn btn-warning">แก้ไขข้อมูลส่วนตัว</button>
				</a>
			</div>
		</div>
	</div>			
				
	</div>	
		<br>
	</div>
	</div>
	</div>
</div>	
</body>
</html>	

<!--	<button type = "button" rel="tooltip" class="btn btn-success btn-just-icon btn-sm" data-original-title title> 
			<i class = "material-icons">edit</i>
			<div class="ripple-container"></div>
		</button>
-->		