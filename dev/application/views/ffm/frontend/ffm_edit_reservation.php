<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <form method="POST" action="../update_reservation" name="Myform">
            <div class="card">
                <div class="card-content">
                    <h2 class="card-title" style="text-align: center;"></h2>
                    <?php
                    foreach($edit as $row)
                    {
                                $fname = $row->FFname;
                    } 
                    ?>
                </div>
                <!--CARD cintent-->

                <nav class="navbar navbar-expand-lg bg-info">
                    <div class="container">
                        <div class="navbar-translate">
                            <label class="navbar-brand" style="font-size: 25px;">ข้อมูลส่วนบุคคล<div
                                    class="ripple-container"></div></label>
                        </div>
                        <div class="collapse navbar-collapse">
                            <ul class="navbar-nav ml-auto"></ul>
                        </div>
                    </div>
                </nav>
                <br>

                <!-- ***************กรอกข้อมูล***************** -->
                
                <label class="col-sm-3" style="text-align: right; font-size: 25px;">รายละเอียดสนาม</label>
                <br>
                <div class="from-group-control row">
                <label class="col-sm-3" style="text-align: right;">ชื่อสนาม : </label>
                <label style="text-align: right;"><input type="text" class="form-control" placeholder="" disabled value="<?php echo $row->FFname;?>"></label>
                <label class="col-sm-1" style="text-align: right;">วันที่เริ่ม : </label>
                <label style="text-align: right;"><input type="text" class="form-control" placeholder="" disabled value="<?php echo $row->Startdate;?>"></label>
                <label class="col-sm-1" style="text-align: right;">วันที่สิ้นสุด	 : </label>
                <label style="text-align: right;"><input type="text" class="form-control" placeholder="" disabled value="<?php echo $row->Enddate;?>"></label>
                
               
                <br>
                </div>
                
                <br>
                <br>
                <label class="col-sm-3" style="text-align: right; font-size: 25px;">แก้ไขข้อมูล</label>
                <br>
                <div class=" from-group-control row">
                <label class="col-sm-3" style="text-align: right;">เวลาเข้าสนาม : </label>
                <label style="text-align: right;">
                <input type="text" class="form-control" placeholder="Regular" name="Starttime" value="<?php echo $row->Starttime;?>">
           
                </label>
                <label class="col-sm-1.5" style="text-align: right;">เวลาออกสนาม : </label>
                <label style="text-align: right;"><input type="text" class="form-control" placeholder="Regular" name="Endtime" value="<?php echo $row->Endtime;?>"></label>
                 <label class="col-sm-1" style="text-align: right;">จำนวนคน : </label>
                 <label style="text-align: right;"><input type="number" min="0" class="form-control" placeholder="number" name="number" value="<?php echo $row->number;?>"></label>
                  <label style="text-align: right;">คน</label>
                </div>

                <br>
                <br>
                <div class="form" style="text-align: center;">
                    <input class="btn btn-danger btn-sm" type="submit" value="ยกเลิก" name="data">

                    <input class="btn btn-success btn-sm " id="submit" type="submit" value="ส่ง" name="data">
                </div>
                <br>
                <br>
                    <input type="hidden" name="fr_id" value=" <?php echo $row->fr_id;?>"




                <!-- ***************กรอกข้อมูล***************** -->

            </div>
            <!--CARD -->
        </form>
        <!--FORM -->
    </div>
    <!--col-md-10 -->
</div>
<!--row -->

<div class="col-md-1"></div>