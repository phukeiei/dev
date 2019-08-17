<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"> -->
<!-- <?php pre($rs_rsv); ?> -->
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading panel_heading_iserl">
			<h2><i class="ti ti-search"></i>ค้นหาคำร้องตามสนาม</h2>
		</div>
		<div class="panel-body">
            <form method = "POST" action = "<?php echo site_url('/'.$dir.'/Field_reservation/v_request_list');?>">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label">สนาม:</label>
                    <div class="col-sm-3">
                       
                        <select name="field" class="form-control">
                            <option value="all">ทั้งหมด</option>
                            <?php $i=0; foreach($rs_opt as $row){ ?>
                                    <option value="<?php echo $row->ff_id;?>"><?php echo $row->ff_name;?></option>
                            <?php $i++; } ?>
                        
                        </select>
                        
                    </div>
                    <label class="col-sm-2 control-label">วันที่:</label>
                    <div class="col-sm-2">
                        <div class="input-group date" id="datepicker" data-date-language="th-th">
                            <span class="input-group-addon"><i class="ti ti-calendar"></i></span>
                            <input type="text" data-date-format="dd/mm/yy"
                            class="form-control datepicker" 
                            id="datepicker" 
                            name="date"  
                            value="<?php echo getNowDateBuddish('/');?>" 
                            for="required,dateDD/MM/YYYY" />
                        </div>
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
            <h2><i class="ti ti-view-list"></i>ตารางคำร้องขอใช้สนาม <?php if(isset($rs_date)){ echo " ของวันที่ ".$rs_date;}?></h2>
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
                        <th>ชื่อสนาม</th>
                        <th>วันที่</th>
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
                        <td class="text-center"><?php echo $row->ff_name; ?></td>
                        <td class="text-center"><?php echo abbreDate2($row->fr_start_date); ?></td>
                        <td class="text-center"><?php echo substr($row->cd_start_time,0,5); ?>&nbspน.</td>
                        <td class="text-center"><?php echo substr($row->cd_end_time,0,5); ?>&nbspน.</td>
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
                                }else if($row->rs_name == "ชำระเงินแล้ว" ){
                                    echo 'style="color:#778899;">';
                                }
                            ?>  
                        <?php echo $row->rs_name; ?></td>
                        <td class="text-center">
                            <button class="btn btn-social btn-google btn_check_iserl tooltips ti ti-search" title="คลิกปุ่มเพื่อดูข้อมูลเพิ่มเติม" 
                            data-toggle="modal" href="#myModal" onclick="get_name_type_by_id(<?php echo $row->fr_id;?>) ">
                            </button>
                            <?php  if($row->rs_name != "อนุมัติ" && $row->rs_name != "ยกเลิก" && $row->rs_name != "ชำระเงินแล้ว"){ ?>
                                <a href="<?php echo site_url('/'.$dir.'/Field_reservation/update_status/2/'.$row->fr_id.'/'.$row->fr_start_date);?>" class="btn btn-success btn_check_iserl tooltips ti ti-check" title="คลิกปุ่มเพื่อบันอนุมัติคำร้อง" ></a>
                                <a href="<?php echo site_url('/'.$dir.'/Field_reservation/update_status/4/'.$row->fr_id.'/'.$row->fr_start_date);?>" class="btn btn-danger btn_check_iserl tooltips ti ti-close" title="คลิกปุ่มเพื่อยกเลิกคำร้อง" ></a>
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

<!-- modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div style="padding-top:2%" class="form-group">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
		        <div class="panel-heading panel_heading_iserl">
			        <h2><i class="ti ti-search"></i>รายละเอียดคำร้องขอใช้สนาม</h2>
		        </div>
		        <div class="panel-body">
                    <div class="">
                        <div class="form-group">
                            <label class="col-sm-12 control-label"><b>ชื่อ-นามสกุล: </b> <label id="fr_name"></label></label>
                        </div>  
                        <div class="form-group">
                            <label class="col-sm-12  control-label"><b>ที่อยู่: </b><label id="fr_address"></label></label>
                        </div>
                        <br> 
                        <div class="form-group">
                            <label class="col-sm-12 control-label"><b>เบอร์โทร: </b><label id="fr_tel"></label></label>
                        </div>
                        <br> 
                        <br><hr>
                        
                        <div class="form-group">
                            <label class="col-sm-12  control-label"><b>ชื่อโครงการ: </b><label id="fr_project"></label></label>
                        </div>        
                        <div class="form-group">
                            <label class="col-sm-12 control-label"><b>จำนวนคนที่เข้าร่วมกิจกรรม: </b> <label id="fr_number"></label></label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label"><b>วันที่เริ่ม: </b> <label id="fr_start_date"></label></label>
                            <label class="col-sm-6 control-label"><b>วันที่สิ้นสุด:  </b><label id="fr_end_date"></label></label>
                        </div>   
                        <div class="form-group">
                            <label class="col-sm-6 control-label"><b>เวลาที่เริ่ม: </b><label id="fr_start_time"></label></label>
                            <label class="col-sm-6 control-label"><b>เวลาที่สิ้นสุด: </b><label id="fr_end_time"></label></label>
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-6  control-label"><b>จำนวนชั่วโมง:</b> <label id="fr_time"></label></label>
                            <label class="col-sm-6  control-label"><b>ราคา:</b> <label id="fr_price"></label></label>
                        </div>    
                        <div class="form-group">
                            <label class="col-sm-12  control-label"><b>สถานะคำร้อง: </b> <label id="fr_status"></label></label>
                        </div>
                    </div> 
                </div>	<!-- panel-body -->
                <div class="panel-footer">
                    <button type="button" class="btn btn-default" style="float:left;"  data-dismiss="modal">ปิด</button>
		        </div>	<!-- panel-footer -->
            </div>
        </div>	
    </div>
</div>   

<script>
function get_name_type_by_id(id){
    $.ajax({
            type: "POST",
            url: "http://10.80.39.251/ossd/index.php/ffm/backend/Field_reservation/get_detail/"+id+"/",
            data: {
                fr_id: id
            },
            success: function(result){
              var temp = JSON.parse(result)
              console.log(temp)
              var name = temp[0].fr_first_name+" "+temp[0].fr_last_name
              var status
              if(temp[0].fr_status == 1){
                status = "ฉบับร่าง"
              }else if(temp[0].fr_status == 2){
                status = "อนุมัติ"
              }else if(temp[0].fr_status == 3){
                status = "ไม่อนุมัติ"
              }else if(temp[0].fr_status == 4){
                status = "ยกเลิก"
              }else if(temp[0].fr_status == 5){
                status = "รอดำเนินการ"
              }else if(temp[0].fr_status == 6){
                status = "ชำระเงินแล้ว"
              }
    
              $('#fr_name').text(name)
              $('#fr_address').text(temp[0].fr_address)
              $('#fr_tel').text(temp[0].fr_tel)
              $('#fr_project').text(temp[0].fr_project)
              $('#fr_number').text(temp[0].fr_number)
              $('#fr_start_date').text(temp[0].fr_start_date)
              $('#fr_end_date').text(temp[0].fr_end_date)
              $('#fr_start_time').text(temp[0].fr_start_time)
              $('#fr_end_time').text(temp[0].fr_end_time)
              $('#fr_time').text(temp[0].fr_hour)
              $('#fr_price').text(temp[0].fr_cost)
              $('#fr_status').text(status)
            }
            
        });
}

</script>