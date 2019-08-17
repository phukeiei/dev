<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

<div class="col-md-6">
	<div class="panel panel-default">
		<div class="panel-heading panel_heading_iserl">
			<h2><i class="fas fa-search"></i>ค้นหาตามวันที่</h2>
		</div>
		<div class="panel-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-4 control-label">วันที่</label>
                    <div class="col-sm-3">
                        <input type="date" class="input-small form-control" name="start1" />
                    </div>
                    <div class="col-sm-4">
                        <button class="btn btn-social btn-google btn_iserl tooltips" title="คลิกปุ่มเพื่อค้นหาข้อมูล" ><span> ค้นหา</span></button> 
                    </div>
                </div>
            </div> 
		</div>	<!-- panel-body -->
	</div>	
</div>	
<div class="col-md-6">
	<div class="panel panel-default">
		<div class="panel-heading panel_heading_iserl">
			<h2><i class="fas fa-search"></i>ค้นหาตามประเภท</h2>
		</div>
		<div class="panel-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label">ประเภท</label>
                    <div class="col-sm-3">
                        <select class="form-control">
                            <option value="">ทั้งหมด</option>
                             <option value="">รหัสบัตรประชาชน</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                         <input type="text" class="form-control popovers" placeholder="ระบุข้อความ" data-trigger="hover" data-toggle="popover" data-content="..." data-original-title="A Title">
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-social btn-google btn_iserl tooltips" title="คลิกปุ่มเพื่อค้นหาข้อมูล" ><span> ค้นหา</span></button> 
                    </div>
                </div>
            </div> 
		</div>	<!-- panel-body -->
	</div>	
</div>	

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading panel_table_iserl">
             <h2><i class="fas fa-table"></i>ตารางเวลาสถานะคำร้องการเข้าใช้สนามของศูนย์นันทนาการ (สนามฟุตบอล)</h2>
                <div class="col-sm-offset-5 col-sm-1">
                    <h2 class="pull-right">สนาม: </h2>
                </div>
                <div class="col-sm-1" style="padding-top:8px;">
                <select class="form-control">
                        <option value="">1 - 5</option>
                        <option value="">6 - 10</option>
                    </select>
                </div>
               	
		</div>
		<div class="panel-body">
            <div class="form-horizontal">
            <table class="table table-bordered m-n" cellspacing="0">
                <thead>
                    <tr>
                        <th width="10%">เวลา</th>
                        <th width="18%">สนาม1</th>
                        <th width="18%">สนาม2</th>
                        <th width="18%">สนาม3</th>
                        <th width="18%">สนาม4</th>
                        <th width="18%">สนาม5</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=9;$i<24;$i++) { ?>
                    <tr>
                        <td class="text-center"><?php echo $i; ?>:00 น.</td>
                        <?php if($i == 12 || $i == 13 || $i == 14){ ?>
                        <td class="text-center" style="background-color:brown;color:white;cursor: pointer;}"
                        onclick="window.location='<?php echo site_url('/'.$dir.'/Football/v_request_list');?>'">รอพิจารณา</td>
                        <?php }  elseif( $i==10 ) { ?>
                        <td  class="text-center"     style="background-color:#1cf91c;color:white;cursor: pointer;}" 
                        onclick="window.location='<?php echo site_url('/'.$dir.'/Football/v_request_list_run') ; ?>'">กำลังใช้งาน</td>
                       <?php  }else {
                              echo '<td class="text-center overlay">
                            <a  class="icon" title="User Profile"  data-toggle="modal" href="#myModal5" >
                                <i class="fa fa-search"></i>
                            </a>
                            </div>
                        </td>' ; }
                        
                       ?>
                        
                        
                   
                        <td class="text-center"></td>
                        <?php if($i == 15 || $i == 16 || $i == 17){ ?>
                        <td class="text-center" style="background-color:brown;color:white;cursor: pointer;}" 
                        onclick="window.location='<?php echo site_url('/'.$dir.'/Football/v_request_list');?>'">รอพิจารณา</td>
                        <?php }  elseif( $i==11||$i==12||$i==13) { ?>
                        <td class="text-center" style="background-color:#1cf91c;color:white;cursor: pointer;}" 
                        onclick="window.location='<?php echo site_url('/'.$dir.'/Football/v_request_list_run') ; ?>'">กำลังใช้งาน</td>
                       <?php  }else {
                          echo '<td class="text-center overlay">
                          <a  class="icon" title="User Profile"  data-toggle="modal" href="#myModal5" >
                              <i class="fa fa-search"></i>
                          </a>
                          </div>
                      </td>' ; }
                       ?>
                        
                        <td class="text-center overlay">
                            <a href="#" class="icon" title="User Profile" data-toggle="modal" href="#myModal5" >
                                <i class="fa fa-search"></i>
                            </a>
                            </div>
                        </td>
                        <td class="text-center overlay">
                            <a href="#" class="icon" title="User Profile"data-toggle="modal" href="#myModal5" >
                                <i class="fa fa-search"></i>
                            </a>
                            </div>
                        </td>
                     
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>   
        </div>	<!-- panel-body -->
    </div>	
</div>	
<div class="col-md-3">
<button class="btn btn-inverse btn_iserl tooltips" title="คลิกปุ่มเพื่อย้อนกลับ" onclick="window.location='<?php echo site_url('/'.$dir.'/Dashboard');?>'"><span>ย้อนกลับ</span></button>
</div>	

<style>
 tr:hover{
    background-color: #FAFAFA;
}
 td:hover{
    background-color: #E1E1E1;
}  
.icon {
  color: blue;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.overlay {
  opacity: 0;
  transition: .1s ease;
  text-align: center;
}

.overlay:hover {
  opacity: 1;
}
</style>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading panel_heading_iserl">
                    <h2>สนามที่ 1 </h2>
                </div>
                <div class="panel-body">
                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

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
                onclick="window.location='<?php echo site_url('/'.$dir.'/Football/v_request_add');?>'" ><span> เพิ่มคำร้อง</span></button>
                <br><br>
            </div>
            <table class="table table-hover m-n dataTable-Export" cellspacing="0">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อ - สกุล</th>
                        <th>ประเภทผู้ใช้</th>
                        <th>เวลาที่เริ่ม</th>
                        <th>เวลาที่สิ้นสุด</th>
                        <th>วันที่ส่งคำร้อง</th>
                        <th>สถานะ</th>
                        <th>เอกสารแนบ</th>
                        <th>ดำเนินการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=1;$i<=5;$i++){ ?>
                    <tr>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="text-center">นายจิรเมธ พั่วพันธ์</td>
                        <td class="text-center">นอกเขต</td>
                        <td class="text-center">12.00 น.</td>
                        <td class="text-center">15.00 น.</td>
                        <td class="text-center">24/05/62 12.00 น.</td>
                        <td class="text-center">รอพิจารณา</td>
                        <td class="text-center">-</td>
                        <td class="text-center">
                            <button class="btn btn-social btn-google btn_check_iserl tooltips ti ti-search" title="คลิกปุ่มเพื่อดูข้อมูล" 
                            onclick="window.location='<?php echo site_url('/'.$dir.'/Football/v_history_user_profile');?>'">
                            </button>
                            <a href="#" class="btn btn-success btn_check_iserl tooltips ti ti-check" title="คลิกปุ่มเพื่อบันทึกข้อมูล" ></a>
                            <a href="#" class="btn btn-danger btn_check_iserl tooltips ti ti-close" title="คลิกปุ่มเพื่อลบข้อมูล" ></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>   	
        </div>	<!-- panel-body -->
        <div class="panel-footer">
            <div class="col-md-3">
                 <button class="btn btn-inverse btn_iserl tooltips" title="คลิกปุ่มเพื่อย้อนกลับ" onclick="window.location='<?php echo site_url('/'.$dir.'/Football/v_request');?>'"><span>ย้อนกลับ</span></button>
            </div>
        </div>
    </div>	
</div>	


                <div class="modal-footer">
                    <button type="button" class="btn btn-inverse btn_iserl tooltips pull-right" 
                        data-dismiss="modal">ปิด</button>
                </div>			
            </div>	
        </div>	
    </div> <!-- .container-fluid -->   
</div><!-- /.modal -->
</div>


	

<!-- Modal -->
<div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading panel_heading_iserl">
                    <h2>สนามที่ 1 </h2>
                </div>
                <div class="panel-body">
                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading panel_table_iserl">
             <h2><i class="fas fa-history"></i>เพิ่มรายการคำร้องขอใช้สนาม</h2>
            <div class="panel-ctrls"></div>
            
		</div>

        <div class="panel-body">
            <div class="form-horizontal">
                 <div class="form-group">
                    <label class="col-sm-2 control-label">ชื่อผู้ใช้:</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control">
                    </div>
                    <label class="col-sm-2 control-label">วันที่จอง:</label>
                    <div class="col-sm-3">
                        <div >
                            <input type="date" class="input-small form-control" name="start1" />
                         
                        </div>
                    </div>
                </div>   
                <div class="form-group">
                <label class="col-sm-2 control-label">สนามที่:</label>
                    <div class="col-sm-3">
                        <div class="input-daterange input-group">
                        <select class="form-control">
                            <option value="">1</option>
                             <option value="">2</option>
                             <option value="">3</option>
                             <option value="">4</option>
                             <option value="">5</option>
                             <option value="">6</option>
                        </select>
                    
                        </div>
                    </div>
                </div>  
                <!-- <div class="form-group">
                    <label class="col-sm-2 control-label">ชนิดสนาม</label>
                    <div class="col-sm-8">
                        <label class="radio-inline icheck">
                            <input type="radio" id="inlineradio1" value="option1" name="optionsRadiosInline"> สนามหญ้าเทียม
                        </label>
                        <label class="radio-inline icheck">
                            <input type="radio" id="inlineradio1" value="option1" name="optionsRadiosInline"> สนามปูน
                        </label>
                    </div>
                </div>     -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">เพิ่มเติม:</label>
                    <div class="col-sm-4">
                         <textarea class="form-control"></textarea>
                    </div>
                </div>  
                            </div>
        </div>	<!-- panel-body -->
        <div class="panel-footer">
            <div style="float: left;">
            </div>
        
            <div style="float: right;">
            </div>
            
        </div>

                <div class="modal-footer">
                <div style="float: right;">
                    <button class="btn btn-success btn_iserl tooltips" title="คลิกปุ่มเพื่อบันทึกข้อมูล" >
                    <span>บันทึก</span></button>
                    </div>
                    <div style="float: left;">
         <button type="button" class="btn btn-inverse btn_iserl tooltips pull-right" 
                        data-dismiss="modal">ปิด</button>
                        </div>
                </div>			
            </div>	
        </div>	
    </div> <!-- .container-fluid -->   
</div><!-- /.modal -->
</div>


