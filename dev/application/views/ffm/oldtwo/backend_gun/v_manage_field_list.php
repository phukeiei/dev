<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<div class="col-md-12">
	<div class="panel panel-midnightblue">
		<div class="panel-heading panel_table_iserl">
             <h2><i class="fas fa-cogs"></i></i>จัดการสนาม</h2>
            <div class="panel-ctrls"></div>
		</div>
		<div class="panel-body">
			<div class="col-md-4">
                <button class="btn btn-social btn-google btn_iserl tooltips ti ti-plus" title="คลิกปุ่มเพื่อเพิ่มสนาม" 
                onclick="window.location='<?php echo site_url('/'.$dir.'/Field_manage/v_manage_field');?>'" ><span> เพิ่มสนาม</span></button>
                <br><br>
            </div>
            
            <div class="col-md-12">
            <table  style="width:100%" class="table table-striped table-bordered table_iserl no-footer table-hover dataTable-Export" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width:10%" >ลำดับ</th>
                        <th style="width:30%" >ชื่อสนาม</th>
                        <th style="width:20%" >สถานะ</th>
                        <th style="width:40%" >ดำเนินการ</th>
                    </tr>
                    
                </thead>
                <tbody>
                    <?php $index = 0; foreach($rs as $row){ $index++;?>        
                    <tr>

                        <td class="text-center" style="width:10%"><?php echo $index;?></td>
                        <td class="text-left"><?php echo $row->ff_name?></td>
                        <?php 
                            if($row->ff_status == "Y"){
                                echo '<b><td  style="color:green;">พร้อมใช้งาน</td></b>';
                            }else{
                                echo '<b><td  style="color:red;">ปรับปรุง</td></b>';
                            }
                        ?>
                        <td class="text-center" style="width:20%">
                            <button class="btn btn-social btn-google btn_check_iserl tooltips ti ti-search" title="คลิกปุ่มเพื่อดูเพิ่มเติม" data-toggle="modal" href="#myModal" ></button>
                            <button class="btn btn-inverse btn_check_iserl tooltips ti ti-time" title="คลิกปุ่มเพื่อแก้ไขเวลา" 
                            onclick="window.location='<?php echo site_url('/'.$dir.'/Field_manage/v_manage_price');?>'"></button>
                            <button class="btn btn-orange btn_check_iserl tooltips ti ti-pencil" title="คลิกปุ่มเพื่อแก้ไขข้อมูล" 
                            onclick="window.location='<?php echo site_url('/'.$dir.'/Field_manage/v_manage_update/'.$row->ff_id);?>'"></button>
                            <button class="btn btn-danger btn_iserl tooltips ti ti-close" title="คลิกปุ่มเพื่อลบข้อมูล" 
                            onclick="window.location='<?php echo site_url('/'.$dir.'/Field_manage/delete_field/'.$row->ff_id.'/');?>'"></button>
                        </td>
                    </tr>
                    
                    <?php  } ?>
                </tbody>
            </table>
            </div>
        </div>	<!-- panel-body -->
        <div class="panel-footer">
            <div class="col-md-3">
                <button class="btn btn-inverse btn_iserl tooltips" title="คลิกปุ่มเพื่อย้อนกลับ" onclick="window.location='<?php echo site_url('/'.$dir.'/Home/');?>'"><span>ย้อนกลับ</span></button>
            </div>
        </div>
	</div>	
</div>	