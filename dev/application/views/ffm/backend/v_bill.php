<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"> -->

<!-- <div class="col-md-12">
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
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">เวลาที่เริ่มต้น</label>
                    <div class="col-sm-3">
                        <div class="input-group date">
                            <span class="input-group-addon"><i class="ti ti-calendar"></i></span>
                            <input type="date" class="form-control">
                        </div>
                    </div>
                    <label class="col-sm-2 control-label">เวลาที่สิ้นสุด</label>
                    <div class="col-sm-3">
                        <div class="input-group date" >
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
</div>	  -->

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading panel_table_iserl">
             <h2><i class="fas fa-file-invoice"></i>รายการใบเสร็จ</h2>
            <div class="panel-ctrls"></div>
            
		</div>
		<div class="panel-body">
            <div class="form-horizontal">
            <table class="table table-hover table-striped table-bordered m-n dataTable-Export" cellspacing="0">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>วันที่</th>
                        <th>เวลาที่เริ่ม</th>
                        <th>เวลาที่สิ้นสุด</th>
                        <th>สนาม</th>
                        <th>ชื่อ - สกุล</th>
                        <th>สถานะ</th>
                        <th>ดำเนินการ</th>
                    </tr>
                </thead>
                    <?php $index = 0; foreach($bill_data as $row) { $index++; ?>
                    <tr>
                        <td class="text-center"><?php echo $index; ?></td>
                        <td class="text-center"><?php echo abbreDate2($row->fr_start_date);?></td>
                        <td class="text-center"><?php echo substr($row->fr_start_time,0,5);?>&nbspน.</td>
                        <td class="text-center"><?php echo substr($row->fr_end_time,0,5);?>&nbspน.</td>
                        <td class=""><?php echo $row->ff_name;?></td>
                        <td><?php echo $row->pf_name.$row->fr_first_name." ".$row->fr_last_name; ?></td>
                        <?php
                            if($row->fr_status == 6){
                                echo " <td  class='text-center' style='color:green;'> ชำระเงินแล้ว </td>";
                            }else{
                                echo " <td  class='text-center' style='color:red;'> ยังไม่ชำระเงิน </td>";
                            }
                        
                        ?>
                        <td class="text-center">
                            <button class="btn btn-social btn-google btn_iserl tooltips ti ti-search" title="คลิกปุ่มเพื่อดูข้อมูล" onclick="window.location='<?php echo site_url('/'.$dir.'/Bill/v_bill_payment/'.$row->fr_id);?>'"></button>
                        </td>
                    </tr>
                   <?php }?>
                    
                </tbody>
            </table>
            </div>   
        </div>	<!-- panel-body -->
        <div class="panel-footer">
            <div class="col-md-3">
                <button class="btn btn-inverse btn_iserl tooltips" title="คลิกปุ่มเพื่อย้อนกลับ" onclick="window.location='<?php echo site_url('/'.$dir.'/home');?>'"><span>ย้อนกลับ</span></button>
            </div>	
        </div>
    </div>	
</div>	

                   