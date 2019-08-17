<div class="col-md-12">
	<div class="panel panel-default">
        <div class="panel-heading panel_table_iserl">
            <h2>ใบเสร็จ</h2>
        </div>
        <div class="panel-body">	
            <div class="form-group">    
                <table  class="table  table-hover  m-n" cellspacing="0">
                    <thead > 
                        <tr>
                        <th class ="text-center"> เลขที่ใบเสร็จ</th>
                        <th class="text-center">วันที่</th>
                            <th class="text-center">สนาม</th>

                            <th class="text-center">เวลาเริ่ม</th>
                            <th class="text-center">เวลาสิ้นสุด</th>
                     
                            <th  align = 'right'>จำนวนเงินที่ต้องชำระ</th>
                        </tr>	
                    </thead> 
                    <tbody>
                        <tr>
                        <td class ="text-center"> 62001 </td>
                        <td class="text-center">  23/05/2562  </td>
                            <td class="text-center"> สนามที่ 1  </td>
                            <td class="text-center">  13.00 น. </td>
                            <td class="text-center">  15.00 น. </td>
                            <td class="text-center"> 700   </td>

                        </tr>
                        <tr>
                        <td></td>
                        <td class="text-center">  23/05/2562  </td>
                            <td class="text-center"> สนามที่ 1  </td>
                            <td class="text-center">  18.00 น. </td>
                            <td class="text-center">  20.00 น. </td>
                            <td class="text-center"> 200   </td>

                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-offset-7 col-sm-2 control-label">รวมทั้งหมด:</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control text-right" placeholder="900" disabled="">
                    </div>
                    <label class="control-label">บาท</label>
                </div>  
                <div class="form-group">
                    <label class="col-sm-offset-7 col-sm-2 control-label">รับเงิน:</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control">
                    </div>
                    <label class="control-label">บาท</label>
                </div> 
                <div class="form-group">
                    <label class="col-sm-offset-7 col-sm-2 control-label">เงินทอน:</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" placeholder="" disabled="">
                    </div>
                    <label class="control-label">บาท</label>
                </div> 
                <div class="form-group">
                    <button class="col-sm-offset-11 btn btn-success btn_iserl tooltips" title="คลิกปุ่มเพื่อบันทึกข้อมูล" ><span>บันทึก</span></button> 
                </div> 
            </div> 
            <div class="form-group">    
                <table class="table  table-hover  m-n" cellspacing="0">
                    <thead> 
                        <tr>
                            <th class="text-center">เลขที่ใบเสร็จ</th>
                            <th class="text-center">วันที่ออกใบเสร็จ</th>
                            <th class="text-center">จำนวนเงินที่ชำระ</th>

                            <th class = "text-center"> การดำเนินการ
                        </tr>	
                    </thead> 
                    <tbody>
                        <tr>
                            <td class="text-center">62001</td>
                            <td class="text-center">23/05/2562</td>
                            <td class= "text-center"> 900 บาท </td>
                            <td class="text-center">
                                <button class="btn btn-default-alt btn_iserl tooltips ti ti-printer" title="คลิกปุ่มเพื่อดาวน์โหลดข้อมูล"><span> พิมพ์</span></a>
                                
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- <div class="col-md-12">
	<div class="panel panel-default">
        <div class="panel-heading panel_table_iserl">
            <h2>ประวัติการชำระเงิน</h2>
        </div>
        <div class="panel-body">	
            <div class="form-group">    
                <table class="table  table-hover  m-n" cellspacing="0">
                    <thead> 
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">รายละเอียด</th>
                            <th class="text-center">#</th>
                        </tr>	
                    </thead> 
                    <tbody>
                        <tr>
                            <td class="text-center">1.</td>
                            <td class="text-center">รายละเอียด</td>
                            <td class="text-center">
                                <button class="btn btn-default-alt btn_iserl tooltips ti ti-printer" title="คลิกปุ่มเพื่อดาวน์โหลดข้อมูล"><span> พิมพ์</span></a>
                                
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
 -->
 <div class="col-md-3">
<button class="btn btn-inverse btn_iserl tooltips" title="คลิกปุ่มเพื่อย้อนกลับ" onclick="window.location='<?php echo site_url('/'.$dir.'/Bill/v_bill');?>'"><span>ย้อนกลับ</span></button>
</div>	
