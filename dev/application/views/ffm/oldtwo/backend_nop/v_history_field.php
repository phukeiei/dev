<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<style>
.hover:hover, .hover:active:hover, .hover:focus {
    outline: none;
    background-color: #17bab8;
    color: #ffffff;
}
</style>
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading panel_heading_iserl"> 
			<h2><i class="fas fa-history"></i>การแสดงผล</h2>
		</div>
		<div class="panel-body">
             <div class="col-md-4">
				<div class="panel panel-green" style="cursor:pointer">
					<div class="panel-body hover">
                        <img width="42" height="42" src="https://10.80.39.16/Camp/index.php/UMS/getIcon?type=menu&image=Icon-40.png" alt="" />
                        &nbsp;&nbsp;&nbsp;รายวัน					
                    </div>
				</div>
            </div>
            <div class="col-md-4">
				<div class="panel panel-green" style="cursor:pointer">
					<div class="panel-body hover">
                        <img width="42" height="42" src="https://10.80.39.16/Camp/index.php/UMS/getIcon?type=menu&image=Icon-40.png" alt="" />
                        &nbsp;&nbsp;&nbsp;รายเดือน						
                    </div>
				</div>
            </div>
            <div class="col-md-4">
				<div class="panel panel-green" style="cursor:pointer">
					<div class="panel-body hover">
                        <img width="42" height="42" src="https://10.80.39.16/Camp/index.php/UMS/getIcon?type=menu&image=Icon-40.png" alt="" />
                        &nbsp;&nbsp;&nbsp;รายปี						
                    </div>
				</div>
            </div>
		</div>	 <!-- panel-body -->
	</div>	
</div>	

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading panel_heading_iserl">
			<h2><i class="fas fa-search"></i>ค้นหา</h2>
		</div>
		<div class="panel-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label">ประเภทผู้ใช้:</label>
                    <div class="col-sm-3">
                        <select name="prefix" class="form-control">
                            <option value="">ทั้งหมด</option>
                            <option value="">ในเขต</option>
                            <option value="">นอกเขต</option>
                        </select>
                    </div>
                    <label class="col-sm-2 control-label">สนาม:</label>
                    <div class="col-sm-3">
                        <select name="prefix" class="form-control">
                            <option value="">ทั้งหมด</option>
                            <option value="">สนาม 1</option>
                            <option value="">สนาม 2</option>
                            <option value="">สนาม 3</option>
                        </select>
                    </div> 
                </div>
                <!-- <div class="form-group">
                    <label class="col-sm-2 control-label">เวลาที่เริ่มต้น</label>
                    <div class="col-sm-3">
                        <div class="input-group date" id="datepicker-pastdisabled">
                            <span class="input-group-addon"><i class="ti ti-calendar"></i></span>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <label class="col-sm-2 control-label">เวลาที่สิ้นสุด</label>
                    <div class="col-sm-3">
                        <div class="input-group date" id="datepicker-pastdisabled">
                            <span class="input-group-addon"><i class="ti ti-calendar"></i></span>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div> -->
                <div class="col-sm-2 col-sm-offset-10">
                    <button class="btn btn-social btn-google btn_iserl tooltips" title="คลิกปุ่มเพื่อค้นหาข้อมูล" ><span> ค้นหา</span></button>
                </div>
            </div> 
		</div>	<!-- panel-body -->
	</div>	
</div>	

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading panel_table_iserl">
             <h2><i class="fas fa-history"></i>ประวัติรายวันการเข้าใช้สนามของศูนย์นันทนาการ (สนามฟุตบอล)</h2>
            <div class="panel-ctrls"></div>
            
		</div>
		<div class="panel-body">
            <div class="form-horizontal">
            <table class="table table-hover m-n dataTable-Export" cellspacing="0">
                <thead>
                    <tr>
                        <th>ช่วงเวลา</th>
                        <th>จำนวนผู้จองทั้งหมด</th>
                        <th>ชื่อผู้ถูกอนุมัติ</th>
                        <th>ประเภทผู้ใช้</th>
                        <th>ดำเนินการ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">9.00 - 10.00 น.</td>
                        <td class="text-center">8</td>
                        <td class="text-center">นายนพดล จันโอชา</td>
                        <td class="text-center">ในเขต</td>
                        <td class="text-center">
                            <button class="btn btn-social btn-google btn_iserl tooltips ti ti-search" title="คลิกปุ่มเพื่อดูข้อมูล" >
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">10.00 - 11.00 น.</td>
                        <td class="text-center">10</td>
                        <td class="text-center">นายนพดล จันโอชา</td>
                        <td class="text-center">ในเขต</td>
                        <td class="text-center">
                            <button class="btn btn-social btn-google btn_iserl tooltips ti ti-search" title="คลิกปุ่มเพื่อดูข้อมูล" ></button>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">11.00 - 12.00 น.</td>
                        <td class="text-center">3</td>
                        <td class="text-center">นายนพดล จันโอชา</td>
                        <td class="text-center">ในเขต</td>
                        <td class="text-center">
                            <button class="btn btn-social btn-google btn_iserl tooltips ti ti-search" title="คลิกปุ่มเพื่อดูข้อมูล" ></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>   
        </div>	<!-- panel-body -->
        <div class="panel-footer">
            <div class="col-md-3">
                <button class="btn btn-inverse btn_iserl tooltips" title="คลิกปุ่มเพื่อย้อนกลับ" onclick="window.location='<?php echo site_url('/'.$dir.'/Football/v_history');?>'"><span>ย้อนกลับ</span></button>
            </div>			
        </div>
    </div>	
</div>	
