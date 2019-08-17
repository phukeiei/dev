<!-- 
*form_register
*view v_form_regis
*@author Chanikan Khamluang
@create Date 2562-05-17
-->
<html>
<head>
</head>
<body>
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
  margin-left: 200px;

}
p{
font-size: 18px; }
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
.cen{
	text-align :center;
}
</style>


<div class="card" >
	<div class="cen" >
		<div class="lol" >
			<h3><b><font color="white">&nbsp;&nbsp;ข้อมูลส่วนตัว</font></b></h3> 
		</div><br><br>
    </div>
	
		<div class="mymargin">	        	        
			
						<div class="col-sm-6">
							<div class="form-group label-floating bmd-form-group">
								<p>ชื่อ</p>
								<label class="control-label"></p></label>
							</div>
						</div>
						
			<div class="row" >			
						<div class="col-sm-6">
							<div class="form-group label-floating bmd-form-group ">
								<p>วันเกิด</p>
								<label class="control-label">
								<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;12 พ.ค. 2562</p></label>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group label-floating bmd-form-group ">
								<p>อายุ</p>
								<label class="control-label">
								<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;21</p></label>
							</div>
						</div>	<br>

				<div class="col-sm-6 control-label">
					<div class="form-group label-floating">
						<p>ที่อยู่: </p>
						<label class="control-label"><p>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						7 ต.บ้านเกาะ  อ.เมืองสมุทรสาคร  จ.สมุทรสาคร </p></label>
					</div>
				</div> 
				</div>
	
		</div>
		
	<br>
						
			<br>
					
	<div class="row">
			<div class="col-md-11 col-md-offset-4" align ="right">
				<a href="<?php echo site_url("/swm/frontend/Swm_register/show_form_register_input"); ?>"> <button class="btn ">ถัดไป</button> </a>
			</div>
		</div><br><br>					
	</div>
 </div>

</body>
</html>	
