<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

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
	</div>	
</div>	

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading panel_table_iserl">
             <h2><i class="fas fa-file-invoice"></i>พิมพ์ใบเสร็จ</h2>
            <div class="panel-ctrls"></div>
            
		</div>
		<div class="panel-body">
            <div class="form-horizontal">
            <table class="table table-striped table-bordered table_iserl no-footer table-hover dataTable-Export" cellspacing="0">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อ - สกุล</th>
                        <th>ประเภทผู้ใช้</th>
                        <th>สนาม</th>
                        <th>เวลาที่เริ่ม</th>
                        <th>เวลาที่สิ้นสุด</th>
                        <th>วันที่</th>
                        <th>ดำเนินการ</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $index = 0; foreach($rs_bill as $row){ $index++;?>

                        <tr>
                            <td class="text-center"><?php echo $index;?></td>
                            <td><?php echo $row->pf_name." ".$row->ps_fname."   ".$row->ps_lname;?></td>
                            <td class="text-center">
                            <?php if($row->ps_in_area = "Y"){
                                echo "ภายในเขต";
                            }elseif($row->ps_in_area = "N"){
                                echo "ภายนอกเขต";
                            }else{
                                echo "ทั่วไป";
                            };?>
                            </td>
                            <td class="text-center"><?php echo $row->ff_name;?></td>
                            <td class="text-center"><?php echo $row->cd_start_time;?></td>
                            <td class="text-center"><?php echo $row->cd_end_time;?></td>
                            <td class="text-center"><?php echo abbreDate2(substr($row->cd_update,0,10));?></td>
                            <td class="text-center">
                            <button class="btn btn-primary btn-google btn_iserl tooltips ti ti-search" title="คลิกปุ่มเพื่อพิมพ์ข้อมูล" onclick="window.location='<?php echo site_url('/'.$dir.'/Football/v_bill_payment');?>'"></button>
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
                <button class="btn btn-inverse btn_iserl tooltips" title="คลิกปุ่มเพื่อย้อนกลับ" onclick="window.location='<?php echo site_url('/'.$dir.'/Dashboard');?>'"><span>ย้อนกลับ</span></button>
            </div>	
        </div>
    </div>	
</div>	
	


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading panel_modal_iserl">
                    <h2>การชำระเงิน</h2>
                    <button type="button" class="btn btn-inverse btn_iserl tooltips pull-right" 
                    data-dismiss="modal" title="คลิกปุ่มเพื่อปิดหน้าต่าง"><span>ปิด</span></button>
                   
                </div>
                <div class="panel-body">
                
    <table border = 0>
    <br>
    <tr align = 'left'>
            <td> วันที่จอง :</td>
            <td>28/4/2562 </td>
            <td></td>
            <td></td>
            <td></td>
        

        </tr>
        <tr align = 'left'>
            <td> วันที่อนุมัติ :</td>
            <td>28/4/2562 </td>
            <td></td>
            <td></td>
        

        </tr>
        <tr align = 'left'>
            <td> เวลา :</td>
            <td> 11.50 น.</td>
            <td></td>
            <td></td>

        </tr>
        <tr align = 'left'>
            <td> ชื่อสนาม :</td>
            <td> สนามที่ 1 </td>
            <td></td>
            <td></td>
            <td></td>
        

        </tr>
        <tr align = 'left'>
            <td> เวลาเริ่ม :</td>
            <td> 12.00 น.  </td>
            <td> เวลาสิ้นสุด :</td>
            <td> 16.00 น.  </td>
        </tr>   
        <tr align = 'left'>
            <td> ชนิดสนาม :</td>
            <td> หญ้าแท้ </td>
        </tr>  
        <tr align = 'left'>
            <td> จำนวนคน :</td>
            <td> 23 คน </td>
        </tr> 
    
        <tr align = 'left'>
            <td> จำนวนเงินที่ต้องชำระ :</td>
            <td> 400 บาท </td>
        </tr> 




    


   
    </table>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-inverse btn_iserl tooltips pull-right" 
                        data-dismiss="modal">PRINT</button>
                </div>			
            </div>	
        </div>	
    </div> <!-- .container-fluid -->        
</div> <!-- #page-content -->
                   