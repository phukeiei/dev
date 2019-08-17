<body>
<br>
<br>
<!--ส่วนหัว -->
<div class="row">
    <div class="col-md-4"></div>
    <div class = "col-md-2 color" id="p1">
        <p><font size="5">ขั้นที่ 1</font></p>
        <p>กรอกข้อมูลส่วนบุคคล <p>
    </div>
    <div class = "col-md-2 color" id="p2">
        <p><font size="5">ขั้นที่ 2</font></p>
        <p>กรอกข้อมูลการจองสนาม<p>
    </div>
    <div class = "col-md-2 color" id="p3"> 
        <p><font size="5">ขั้นที่ 3</font></p>
        <p>ตรวจสอบข้อมูล<p>
    </div>
    <div class = "col-md-2 color" id="p4">
        <p><font size="5">ขั้นที่ 4</font></p>
        <p>เสร็จการจอง<p>
    </div>
</div>
<div class="row">
    <div class = "col-md-12">       
        <p id="line"><p>
    </div>
</div>
<!-- เปิด php session_start()-->

<!--ส่วนกรอกข้อมูล -->
<form method="POST" action="./insert">
<!-- กรอกข้อมูมลส่วนตัว -->
<div class="tab">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-7" id="boxinput">
        <div class="form-group">
	        <label class="col-sm-3 control-label">คำนำหน้าชื่อ :</label>
	        <div class="col-sm-3">
                <select class="form-control" name ="prefix" id="prefix">
                    <option  value = "" disabled selected>----โปรดเลือก----</option>
                    <option  value = "นาย" >นาย</option>
                    <option  value = "นาง" >นาง</option>
                    <option  value = "นางสาว" >นางสาว</option>
                </select>
	        </div>
        </div>
        <br>
        <div class="form-group">
	        <label class="col-sm-3 control-label">ชื่อ-นามสกุล :</label>
	        <div class="col-sm-4">
                <input class="form-control" placeholder="ชื่อ" name = "fname">
	        </div>
            <div class="col-sm-4">
                <input class="form-control" placeholder="นามสกุล" name = "lname">
	        </div>
        </div>
        <br>
        <div class="form-group">
	        <label class="col-sm-3 control-label">ที่อยู่ :</label>
	        <div class="col-sm-6">
		        <input class="form-control" placeholder="ที่อยู่............." name = "adress" >
	        </div>
        </div>
        <br>
        <div class="form-group">
            <label class="col-sm-3 control-label">จังหวัด :</label>
	        <div class="col-sm-4">
		        <input class="form-control"  name = "pv" type="text">
	        </div>
        </div>
        <br>
        <div class="form-group">
            <label class="col-sm-3 control-label">อำเภอ :</label>
            <div class="col-sm-3">   
            <select class="form-control" name ="prefix" id="prefix">
                    <option  value = "" disabled selected>----โปรดเลือก----</option>
                    <option  value = "นาง" >เมือง</option>
                    
            </select>
            </div>
        </div>
        <br>        
        <div class="form-group">
            <label class="col-sm-3 control-label">ตำบล :</label>
	        <div class="col-sm-3">
            <select class="form-control" name ="prefix" id="prefix">
                    <option  value = "" disabled selected>----โปรดเลือก----</option>
                    <option  value = "นาย" >บางปลา</option>
                    <option  value = "นาง" >พันท้ายนรสิงค์</option>
            </select>
	        </div>
        </div>
        <br>
        <div class="form-group">
	        <label class="col-sm-3 control-label">หมู่ :</label>
	        <div class="col-sm-2">
		        <input class="form-control"  name = "moo" type="text">
	        </div>
        </div>
        <br>
        <div class="form-group">
	        <label class="col-sm-3 control-label">เบอร์โทรศัพท์ :</label>
	        <div class="col-sm-4">
                <input class="form-control" placeholder="080-XXX-XXXX" name = "phone" >
	        </div>    
        </div>
        <br>
        <br>
        <div class="col-sm-10"></div>
        <div class="col-sm-2"><a onclick="nextPrev(1)" class="buttonnext">ต่อไป</a></div>
        </div>
    </div>
</div>
<!-- กรอกข้อมูมลการจองสนาม -->
<div class="tab">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-7" id="boxinput">
        <div class="form-group">
	        <label class="col-sm-3 control-label">ชื่อโครงการ :</label>
	        <div class="col-sm-4">
                <input class="form-control" placeholder="โครงการ" name = "fname">
	        </div>
        </div>
        <br>
        <div class="form-group">
	        <label class="col-sm-3 control-label">สนาม :</label>
	        <div class="col-sm-3">
                <select class="form-control" name ="field" id="prefix">
                    <option  value = "" disabled selected>------โปรดเลือก------</option>
                    <option  value = "1" >สนาม 1</option>
                    <option  value = "2" >สนาม 2</option>
                </select>
	        </div>
        </div>
        <br>
        <div class="form-group">
	        <label class="col-sm-3 control-label">วันที่จอง :</label>
	        <div class="col-sm-4">
                <input type="date" name="date-start"class="form-control">
	        </div>
            <label class="col-sm-1 control-label">ถึง </label>
	        <div class="col-sm-4">
                <input type="date" name="date-start"class="form-control">
	        </div>
        </div>
        <br>
        <div class="form-group">
	        <label class="col-sm-3 control-label">เวลา :</label>
	        <div class="col-sm-3">
                <select class="form-control" name ="starttimes" id="time">
                    <option  value = "" disabled selected>------โปรดเลือก------</option>
                    <option  value = "1" >สนาม 1</option>
                    <option  value = "2" >สนาม 2</option>
                </select>
	        </div>
            <div class="col-sm-1">ถึง</div>
            <div class="col-sm-3">
                <select class="form-control" name ="endtime" id="time">
                    <option  value = "" disabled selected>------โปรดเลือก------</option>
                    <option  value = "1" >สนาม 1</option>
                    <option  value = "2" >สนาม 2</option>
                </select>
	        </div>
        </div>
        <br>
        <div class="form-group">
	        <label class="col-sm-3 control-label">ราคา :</label>
	        <div class="col-sm-3">
                
	        </div>
            <p> บาท </p>    
        </div>
        <div class="form-group">
	        <label class="col-sm-3 control-label">จำนวน :</label>
	        <div class="col-sm-4">
                <input class="form-control" placeholder="จำนวนคน" name = "phone">
	        </div>
            <p> คน </p>    
        </div>
        <div class="col-sm-10"></div>
        <div class="col-sm-2"><a onclick="nextPrev(1)" class="buttonnext">ต่อไป</a></div>
        </div>
        </div>
    </div>
</div>
<!-- ข้อมูลตรวจข้อมูล-->
<div class="tab">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-7" id="boxinput">
        <label class="col-sm-3 control-label">ชื่อ-นามสกุล : </label><p class="col-sm-5 control-label">นาย กิตติศักดิ์ น้อยดอนไพร</p>
        <br>
        <br>
        <label class="col-sm-3 control-label">ที่อยู่ : </label><p class="col-sm-5 control-label">144/455 หมูบ้านพฤกษา ถนนบางขุนเทียนชายทะเล ตำบลพันท้ายนรสิงค์ อำเภอเมือง จังหวัดสมุทรสาคร</p>
        <br>
        <br>
        <br>
        <br>
        <br>
        <label class="col-sm-3 control-label">เบอร์โทรศัพท์ :</label><p class="col-sm-5 control-label">097-037-0141</p>
        <br>
        <br>
        <label class="col-sm-3 control-label">ชื่อโครงการ :</label><p class="col-sm-5 control-label">เตะบอลเพื่อแม่</p>
        <br>
        <br>
        <label class="col-sm-3 control-label">สนาม :</label><p class="col-sm-5 control-label">สนาม 2</p>
        <br>
        <br>
        <label class="col-sm-3 control-label">วันที่ :</label><p class="col-sm-6 control-label">วันที่ 14 พ.ค. 2562 ถึง 16 พ.ค. 2562</p>
        <br>
        <br>
        <label class="col-sm-3 control-label">เวลา :</label> <p class="col-sm-5 control-label">10.00 น.-16.00 น.</p>
        <br>
        <br>
        <label class="col-sm-3 control-label">ราคา :</label><p class="col-sm-5 control-label">800 บาท</p>
        <br>
        <br>
        <label class="col-sm-3 control-label">จำนวน :</label><p class="col-sm-5 control-label">24 คน</p>
        <br>
        <br>
        <div class="col-sm-2"><a onclick="nextPrev(-2)" class="buttonedit">แก้ไข</a></div>
        <div class="col-sm-8"></div>
        <div class="col-sm-2"><a onclick="nextPrev(1)" class="buttonnext">ต่อไป</a></div>
        </div>
        </div>
    </div>
</div>
<!-- กรอกข้อมูมลดาวน์โหลด -->
<div class="tab">
    <div class="row">
        <div class="col-md-4"></div>
            
        <div class="col-md-7" id="boxinputdw">
        <p>การจองเสร็จสิ้น</p>
        <button class="btn btn-orange btn_iserl tooltips" title="คลิกปุ่มเพื่อแก้ไขข้อมูล" ><span>หน้าแรก</span></button>
        <button class="btn btn-default-alt btn_iserl tooltips ti ti-printer" title="คลิกปุ่มเพื่อดาวน์โหลดข้อมูล"><span> ดาวน์โหลด</span>        
        </div>        
    </div>
</div>
</div> 
</form>
<br>
<br>