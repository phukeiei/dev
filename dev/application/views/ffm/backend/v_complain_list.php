<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"> -->

<!-- <div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading panel_heading_iserl">
			<h2><i class="ti ti-search"></i>ค้นหา</h2>
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
                    <label class="col-sm-2 control-label">ประเภทปัญหา:</label>
                    <div class="col-sm-3">
                        <select name="prefix" class="form-control">
                            <option value="">ทั้งหมด</option>
                            <option value="">สนาม</option>
                            <option value="">บริการ</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">เวลาที่เริ่มต้น</label>
                    <div class="col-sm-3">
                        <div class="input-group date" id="datepicker-pastdisabled">
                            <span class="input-group-addon"><i class="ti ti-calendar"></i></span>
                            <input type="date" class="form-control" name="date1">
                        </div>
                    </div>
                    <label class="col-sm-2 control-label">เวลาที่สิ้นสุด</label>
                    <div class="col-sm-3">
                        <div class="input-group " id="datepicker-pastdisabled">
                            <span class="input-group-addon"><i class="ti ti-calendar"></i></span>
                            <input type="date" class="form-control" name="date2">
                        </div>
                    </div>
                </div>
                <div class="col-sm-2 col-sm-offset-10">
                    <button class="btn btn-social btn-google btn_iserl tooltips" title="คลิกปุ่มเพื่อค้นหาข้อมูล" ><span> ค้นหา</span></button>
                </div>
            </div> 
		</div>	<!-- panel-body -->
	<!-- </div>	
</div>--> 

<div class="col-md-12">
    <div class="panel panel-default">
		<div class="panel-heading panel_table_iserl">
            <h2><i class="ti ti-view-list"></i>รายการคำร้องแจ้งปัญหา</h2>
            <div class="panel-ctrls"></div>
		</div>
		<div class="panel-body">
            <div class="form-horizontal">
            <table class="table table-hover table-striped table-bordered m-n dataTable-Export" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">ลำดับ</th>
                        <th width="10%">วันที่</th>
                        <th width="10%">เวลา</th>
                        <th width="35%">รายละเอียด</th>
                        <th width="20%">ประเภทความคิดเห็น</th>
                        <!-- <th width="10%">ชื่อสนาม</th> -->
                        <th width="20%">ชื่อ-นามสกุล</th>
                    </tr>
                </th>
                <tbody> 

                <!-- แสดงรายการความคิดเห็น : กัน -->
                <?php $index = 0; foreach($rs_comp as $row){ $index++;?>        
                    <tr>
                        <td class="text-center"><?php echo $index;?></td>
                        <td class="text-center"><?php echo abbreDate2( substr($row->cp_update,0,10) );?></td>
                        <td class="text-center"><?php echo substr($row->cp_update,11,5);?>&nbsp น.</td>
                        <td class=""><?php echo $row->tp_complain;?></td>
                        <td><?php echo $row->cp_complain;?></td>
                        <!-- <td ><?php echo $row->ff_name;?></td> -->
                        <td><?php echo $row->pf_name."   ". $row->ps_fname."   ". $row->ps_lname; ?></td>
                    </tr>

                <?php  } ?>

                </tbody>
            </table>
            </div>   
        </div>	<!-- panel-body -->
        <div class="panel-footer">
            <div class="col-md-3">
                <button class="btn btn-inverse btn_iserl tooltips" title="คลิกปุ่มเพื่อย้อนกลับ" onclick="window.location='<?php echo site_url('/'.$dir.'/Complain');?>'"><span>ย้อนกลับ</span></button>
            </div>	
        </div>
    </div>	
</div>	
