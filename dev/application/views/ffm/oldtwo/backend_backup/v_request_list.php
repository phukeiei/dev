<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"> -->
<!-- <?php pre($rs_rsv); ?> -->
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading panel_heading_iserl">
			<h2><i class="fas fa-search"></i>ค้นหาคำร้องตามสนาม</h2>
		</div>
		<div class="panel-body">
            <form method = "POST" action = "<?php echo site_url('/'.$dir.'/Field_reservation/search_data');?>">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label">สนาม:</label>
                    <div class="col-sm-3">
                        <?php pre($rs_opt)?>
                        <select name="feild" class="form-control">
                            <?php $i=0; foreach($rs_opt as $row){ ?>
                                    <option value="<?php echo $row;?>"><?php echo $row;?></option>
                            <?php $i++; } ?>
                        
                        </select>
                        
                    </div>
                    <label class="col-sm-2 control-label">วันที่:</label>
                    <div class="col-sm-3">
                         <input type="date" name="date" id="date" value="" class="form-control">
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
            </form>
		</div>	<!-- panel-body -->
	</div>	
</div>	
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading panel_table_iserl">
            <h2><i class="fas fa-history"></i>ตารางคำร้องขอใช้สนาม</h2>
            <div class="panel-ctrls"></div>
		</div>
		<div class="panel-body">
            <div class="form-horizontal">
            <div class="col-md-3">
                <button class="btn btn-social btn-google btn_iserl tooltips ti ti-plus" title="คลิกปุ่มเพื่อเพิ่มคำร้อง" 
                onclick="window.location='<?php echo site_url('/'.$dir.'/Field_reservation/v_request_add');?>'" ><span> เพิ่มคำร้อง</span></button>
                <br><br>
            </div>
            <table class="table table-hover table-striped table-bordered m-n dataTable-Export" cellspacing="0">
                <thead>
                    <tr>
                        <th width="10%">ลำดับ</th>
                        <th width="30%">ชื่อ - สกุล</th>
                        <th>เวลาที่เริ่ม</th>
                        <th>เวลาที่สิ้นสุด</th>
                        <th>สถานะ</th>
                        <th width="20%">ดำเนินการ</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php
                     
                        $index = 0;
                        foreach($rs_rsv as $row){
                        $index++;
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $index; ?></td>
                        <td class="text-left"><?php echo $row->pf_name.$row->fr_first_name." ".$row->fr_last_name; ?></td>
                        <td class="text-center"><?php echo $row->cd_start_time; ?>&nbspน.</td>
                        <td class="text-center"><?php echo $row->cd_end_time; ?>&nbspน.</td>
                        <td class="text-center" 
                            <?php 
                                if($row->rs_name == "อนุมัติ" ){
                                    echo 'style="color:green;">';
                                }else if($row->rs_name == "ยกเลิก" ){
                                    echo 'style="color:red;">';
                                }else if($row->rs_name == "รอดำเนินการ" ){
                                    echo 'style="color:orange;">';
                                }else if($row->rs_name == "ร่าง" ){
                                    echo 'style="color:#778899;">';
                                }
                            ?>  
                        <b><?php echo $row->rs_name; ?></b></td>
                        <td class="text-center">
                            <button class="btn btn-social btn-google btn_check_iserl tooltips ti ti-search" title="คลิกปุ่มเพื่อดูข้อมูล" 
                            onclick="window.location='<?php echo site_url('/'.$dir.'/Field_reservation/v_history_user_profile');?>'">
                            </button>
                            <?php  if($row->rs_name != "อนุมัติ" && $row->rs_name != "ยกเลิก"){ ?>
                                <a href="<?php echo site_url('/'.$dir.'/Field_reservation/update_status/2/'.$row->fr_id);?>" class="btn btn-success btn_check_iserl tooltips ti ti-check" title="คลิกปุ่มเพื่อบันอนุมัติคำร้อง" ></a>
                                <a href="<?php echo site_url('/'.$dir.'/Field_reservation/update_status/4/'.$row->fr_id);?>" class="btn btn-danger btn_check_iserl tooltips ti ti-close" title="คลิกปุ่มเพื่อยกเลิกคำร้อง" ></a>
                            <?php }?>
                            
                        </td>
                    </tr>

                    <?php

                         }
                    ?>

                   
                </tbody>
            </table>
            </div>   	
        </div>	<!-- panel-body -->
        <div class="panel-footer">
            <div class="col-md-3">
                 <button class="btn btn-inverse btn_iserl tooltips" title="คลิกปุ่มเพื่อย้อนกลับ" onclick="window.location='<?php echo site_url('/'.$dir.'/Home');?>'"><span>ย้อนกลับ</span></button>
            </div>
        </div>
    </div>	
</div>	
