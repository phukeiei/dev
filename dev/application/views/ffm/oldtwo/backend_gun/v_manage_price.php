<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading panel_table_iserl">
             <h2><i class="fas fa-history"></i>จัดการเวลาสนาม 1</h2>
            <div class="panel-ctrls"></div>
            
		</div>
		<div class="panel-body">
            <div class="form-horizontal">
            <div class="form-group">
                <div class="col-md-3">
                    <button class="btn btn-social btn-google btn_iserl tooltips ti ti-plus" 
            title="คลิกปุ่มเพื่อเพิ่มเวลา" id="add" ><span> เพิ่มเวลา</span></button>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                <table class="table table-striped table-bordered table_iserl no-footer table-hover dataTable-Export" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>เวลาที่เริ่ม</th>
                            <th>เวลาที่สิ้นสุด</th>
                            <th>ราคาในเขต / ชั่วโมง</th>
                            <th>ราคานอกเขต / ชั่วโมง</th>
                            <th>ดำเนินการ</th>
                        </tr>
                    </thead>
                    <tbody id="field">
                        <tr>
                            <td class="text-center">1</td>
                            <td class="text-center">9.00 น.</td>
                            <td class="text-center">12.00 น.</td>
                            <td class="text-center">500</td>
                            <td class="text-center">800</td>
                            <td class="text-center">
                                <button class="btn btn-orange btn_iserl tooltips" title="คลิกปุ่มเพื่อแก้ไขข้อมูล"><span>แก้ไข</span></button>
                                <button class="btn btn-danger btn_iserl tooltips" title="คลิกปุ่มเพื่อลบข้อมูล" ><span>ลบ</span></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td class="text-center">12.00 น.</td>
                            <td class="text-center">13.00 น.</td>
                            <td class="text-center">400</td>
                            <td class="text-center">700</td>
                            <td class="text-center">
                                <button class="btn btn-orange btn_iserl tooltips" title="คลิกปุ่มเพื่อแก้ไขข้อมูล"><span>แก้ไข</span></button>
                                <button class="btn btn-danger btn_iserl tooltips" title="คลิกปุ่มเพื่อลบข้อมูล" ><span>ลบ</span></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>  
            </div>
            </div>
            <div style="float: left;">
                <button class="btn btn-inverse btn_iserl tooltips" title="คลิกปุ่มเพื่อย้อนกลับ" onclick="window.location='<?php echo site_url('/'.$dir.'/Football/v_manage');?>'"><span>ยกเลิก</span></button>
            </div>	  
            <div style="float: right;">
                <button class="btn btn-success btn_iserl tooltips" title="คลิกปุ่มเพื่อบันทึกข้อมูล" ><span>บันทึก</span></button>
            </div> 
        </div>	<!-- panel-body -->
    </div>	
</div>	


<script>
$( document ).ready(function() {  
    var row =  $('tr').parents.length;
    $("#add").click(function(){
        $("#field").append("<tr><td></td><td></td><td></td><td></td><td></td></tr>");
    });
});
</script>