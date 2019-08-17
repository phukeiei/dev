<script>


</script>

<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <form method="POST" action="./insert" name="Myform">
            <div class="card">
                <div class="card-content">
                    <h2 class="card-title" style="text-align: center;"></h2>
                </div>
                <center>
                    <h1>แสดงความคิดเห็น</h1>
                </center>

                <br>
                <div class="from-group-control row">
                    <input type="hidden" name="type" value="0">
                    <label class="col-sm-3" style="text-align: right;">แสดงความคิดเห็น : </label>
                    <TEXTAREA class="form-control" style="width:500px; height: 150px;"
                        placeholder="กรุณาระบุความคิดเห็น" name="cp_complain"></TEXTAREA>
                    <br>
                </div>
                <br>
                <div class="group ">
                    <label class="col-sm-3" style="text-align: right;">แนบหลักฐาน :</label>
                    <input type="file" name="fileToUpload" id="fileToUpload">
                </div>
                <br>
                <br>
                <div class="form" style="text-align: center;">
                    <input class="btn btn-danger btn-sm" type="submit" value="ยกเลิก" name="data">
                    <input class="btn btn-success btn-sm" type="submit" value="ส่ง" name="data">
                </div>
                <br>
                <br>
                <br>
                <br>
            </div>
    </div>
    <!--CARD -->
    </form>
    <!--FORM -->
    <div class="col-md-1"></div>
    <!--
<div class="row">
    <div class ="col-md-1"></div>
    <div class="col-md-10">
   <form method="POST" action="./insert"> 
    </div>
        <div class="card">
          <div class="card-content"><h2 class="card-title" style="text-align: center;"> ชื่อหัวข้อ </h2></div>
            <center><h1>แสดงความคิดเห็น</h1></center>
		<br>
		<br>  
    <div class="form-group ">
      <div class="form-group-control row" >
              <label class="col-sm-3" style="text-align: right;">แสดงความคิดเห็น : </label>
              <TEXTAREA class="form-control" style="width:500px; height: 150px;"placeholder="กรุณาระบุความคิดเห็น" name="cp_complain" id="cp_complain"></TEXTAREA>
              <br>
          </div></div>
          <br>
           <div class="group ">
              <label class="col-sm-3" style="text-align: right;">แนบหลักฐาน :</label>
        <input  type="file" name="fileToUpload" id="fileToUpload">
       </div>
<br>   
<br>

			<div  style="text-align: center;">

 				<button class="btn btn-danger btn-sm" type="submit" value="ยกเลิก" name="data1" > ยกเลิก</button>

        <button  id="Success" class="btn btn-success btn-sm" type="submit" v alue="ส่ง" name="data2" > ส่ง </button>

			</div>
        	<br>
			<br>  
			<br>
			<br>  
 		</div>

         
    </div>
    </form>
    <div class ="col-md-1"></div>
   
</div>

-->