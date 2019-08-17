<!--
*
*main.php
*show_main
*@author Tiwakorn Hedmuin
*@author Manita Doungrassamee
*@Create Date 2562-05-17
*
-->
<script>

  $(document).ready(function(){

    $(".validate_pms").click(function(){
      <?php 
        $ps_id = $this->session->userdata("UsPsCode");
        if($ps_id == ""){ ?>
          $(".validate_pms").removeAttr("href");
          alert("กรุณาเข้าสู่ระบบ");
    <?php }?>
    })

  })


</script>

<style>
    #reg,
    #manu,
    #headmenu,
    #sers,
    #serm {
        cursor: pointer;
    }
</style>
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

.imgg {
  width : 20 px;
  height : 20 px;
}

.container {
  padding: 2px 16px;
}
.mymargin {
  margin-left: 16px;
  margin-right: 16px;


}
.mymarginx {
  margin-left: 20px;
  margin-right: 10px;


}
.mymarginn {
  margin-left: 30px;
  margin-right: 30px;
}
.mymarginnm {
  margin-left: 2px;
  margin-right: 70px;
}
divp {
    width: 10px;
    height: 10px;
    border: 3px solid #73AD21;
}

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
th{
  background-color: DodgerBlue;
}

</style>
</head>
<body>

<div class="card" >
	<div class = "mymarginnm">	
		
	<div class = "mymargin">	
		<div class="col-md-12">
		
		<br><br>
		<div class = "row"><div class="col-sm-7 control-label">
			
		<h2>สระว่ายน้ำเทศบาล</h2>
		
		
	<div class = "mymargin">
		
				<font color = "gray"><h4> สระว่ายน้ำขนาดมาตรฐานเพื่อบริการประชาชน สามารถเข้าใช้บริการได้ทั้งเด็กและผู้ใหญ่ </h4></font>
				<p> ขนาดสระว่ายน้ำ 25*50 เมตร มีครูฝึกประจำสระ </p>
				<p>สิ่งอำนวยความสะดวก : ห้องอาบน้ำ | ร้านอาหาร | ห้องน้ำ </p>
				<p> วัน เวลาที่เปิด : 8.00-21.00 น. </p>
			</div>
		</div>
		
		
		
		<div class="col-sm-5 control-label" align = "right">
		<br>
		<br>
<img src ="<?php echo base_url();?>/application/views/swm/frontend/IMG/bg01.jpg" class="rounded img-fluid" width = "500px">
</div>

</div>
		<hr width=50% size=5 color=B0E0E6> <br>
		<h3>● อัตราค่าเข้าใช้บริการสระว่ายน้ำ </h3>
		<br>
		
		<div class = "mymarginx">
			<div class = "row">
				<div class="col-md-12">
				<div class="card card-pricing">
						<div class="card-body ">
				<div class="row">
			<div class="col-sm-6 control-label">
				<h4 class="card-category text-gray">บุคคลอายุต่ำกว่า 18 ปี</h4>
							<div class="icon icon-info">
								<i class="material-icons">people</i>
							</div>
							<h3 class="card-title">10 บาท/ครั้ง</h3>
							<p class="card-description">
									จากราคาปกติ 20  บาท/ครั้ง. <br>
									เพียงทำการสมัครสมาชิกครั้งละ 300 บาท / ปี 
							</p>
			</div> 
		
			<div class="col-sm-6 control-label" >
				<h4 class="card-category text-gray">บุคคลอายุมากกว่า 18 ปี</h4>
							<div class="icon icon-info">
								<i class="material-icons">people</i>
							</div>
							<h3 class="card-title">20 บาท/ครั้ง</h3>
							<p class="card-description">
									จากราคาปกติ 40  บาท/ครั้ง. <br>
									เพียงทำการสมัครสมาชิกครั้งละ 500 บาท / ปี
							</p>
				</div>
				
			</div>
		</div>
				
							<center><div class="col-sm-6 control-label">
							<a href="<?php echo site_url("/swm/frontend/Swm_register/show_form_register");?>"  class="btn btn-info btn-round validate_pms">สมัครสมาชิก</a>
						<br></div><br>
						</div><br>
					</div>
				</div>
			</div>
		</div>
	</div>				
</div>	

<br>	
</div>				
</body>
</html>
