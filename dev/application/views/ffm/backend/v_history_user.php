<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

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
                    <!-- <label class="col-sm-2 control-label">สนาม:</label>
                    <div class="col-sm-3">
                        <select name="prefix" class="form-control">
                            <option value="">ทั้งหมด</option>
                            <option value="">สนาม 1</option>
                            <option value="">สนาม 2</option>
                            <option value="">สนาม 3</option>
                        </select>
                    </div> -->
                <!-- </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">วันที่</label>
                    <div class="col-sm-3">
                        <div class="input-group date" id="datepicker-pastdisabled">
                            <span class="input-group-addon"><i class="ti ti-calendar"></i></span>
                            <input type="date" class="form-control">
                        </div>
                    </div>
                    <label class="col-sm-2 control-label">ถึง</label>
                    <div class="col-sm-3">
                        <div class="input-group date" id="datepicker-pastdisabled">
                            <span class="input-group-addon"><i class="ti ti-calendar"></i></span>
                            <input type="date" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-sm-2 col-sm-offset-10">
                    <button class="btn btn-social btn-google btn_iserl tooltips" title="คลิกปุ่มเพื่อค้นหาข้อมูล" ><span> ค้นหา</span></button>
                </div>
            </div> 
		</div>	<!-- panel-body -->
	<!-- </div>	
</div>	   -->

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading panel_table_iserl">
             <h2><i class="fas fa-history"></i>ประวัติผู้ใช้ในการเข้าใช้สนามของศูนย์นันทนาการ (สนามฟุตบอล)</h2>
            <div class="panel-ctrls"></div>
            
		</div>
		<div class="panel-body">
            <div class="form-horizontal">
            <table class="table table-hover m-n dataTable-Export" cellspacing="0">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อ - สกุล</th>
                        <th>ประเภทผู้ใช้</th>
                        <th>จำนวนคำร้อง</th>
                        <th>จำนวนผลอนุมัติ</th>
                        <th>ดำเนินการ</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $index = 0; foreach($rs_user as $row){ $index++;?>
                    <tr >
                        <td class="text-center"><?php echo $index;?></td>
                        <td><?php echo $row->pf_name. $row->fr_first_name."   ". $row->fr_last_name; ?></td>
                        <td class="text-center"><?php  if($row->ps_in_area ="N"){
                                        echo "ภายนอกเขต";
                                    }
                                    elseif($row->ps_in_area ="Y"){
                                        echo "ภายในเขต";
                                    }
                                    else{
                                        echo "ทั่วไป";
                                    };?></td>
                        <td class="text-center"><?php echo $row->reservation_count;?></td>
                        <td class="text-center"><?php echo $row->receive;?></td>
                        <td class="text-center">
                            <button class="btn btn-social btn-google btn_iserl tooltips ti ti-search" title="คลิกปุ่มเพื่อดูข้อมูล" 
                            onclick="window.location='<?php echo site_url('/'.$dir.'/history/v_history_user_profile');?>'">
                            </button>
                        </td>
                    </tr>
                    <?php  } ?>
                </tbody>
            </table>
            </div>   
        </div>	<!-- panel-body -->
        <div class="panel-footer">
            <div class="col-md-3">
                <button class="btn btn-inverse btn_iserl tooltips" title="คลิกปุ่มเพื่อย้อนกลับ" onclick="window.location='<?php echo site_url('/'.$dir.'/History/v_history');?>'"><span>ย้อนกลับ</span></button>
            </div>		
        </div>
    </div>	
</div>	
