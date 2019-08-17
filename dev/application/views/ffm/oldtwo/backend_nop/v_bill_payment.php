<!--
    File : V_Bill_payment.php
    @Auther : Noppadol  Chansuk 
    @Edie Data : 20/05/2562 
-->


<div class="col-md-12">
	<div class="panel panel-default">
        <div class="panel-heading panel_table_iserl">
            <h2>ใบเสร็จ</h2>
        </div>
        <br>
        <div class ="col-sm-offset-11">
        <button class="btn btn-social btn-google btn_iserl tooltips ti ti-plus " onclick = "insert_bill()"><span></span></button>
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
                            <th> </th>
                        </tr>	
                    </thead> 
                    <tbody id = "list_bill">
                    
                  
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
            <!-- <div class='input-group date'> -->
                <input class='form-control pp_timepicker' id='time_end'>
            <!-- </div> -->
            <!-- <div class="form-group">    
                <table class="table  table-hover  m-n" cellspacing="0">
                    <thead> 
                        <tr>

                            <th class="text-center">เลขที่ใบเสร็จ</th>
                            <th class="text-center">วันที่ออกใบเสร็จ</th>
                            <th class="text-center">จำนวนเงินที่ชำระ</th>
                            <th class = "text-center"> การดำเนินการ</th>
                        </tr>	
                    </thead> 
                    <tbody>
                  
                    </tbody>
                </table>
            </div> -->
        </div>
    </div>
</div>

 <div class="col-md-3">
<button class="btn btn-inverse btn_iserl tooltips" title="คลิกปุ่มเพื่อย้อนกลับ" onclick="window.location='<?php echo site_url('/'.$dir.'/Bill/v_bill');?>'"><span>ย้อนกลับ</span></button>
</div>	
<style>
    .datetimepicker {
        width : 500px !important
    }
</style>
<script src='<?php echo base_url('backend/js/moment.js'); ?>'></script>
<script> 
     $(document).ready(() => {
        $('.time').datetimepicker({ // Time
         format: "hh:ii:00",
         weekStart: 1,
         todayBtn:  1,
         autoclose: 1,
         todayHighlight: 1,
         startView: 1,
         minView: 0,
         maxView: 1,
         forceParse: 0
        });
        $('#time_end').datetimepicker({ // Time
         format: "hh:ii:00",
         weekStart: 1,
         todayBtn:  1,
         autoclose: 1,
         todayHighlight: 1,
         startView: 1,
         minView: 0,
         maxView: 1,
         forceParse: 0
        });
    })
    var teamp=0; //เก็บจำนวนเงินทั้งหมดของวัสดุ
    var index =1;
    var i=0;
    var array = []; //เก็บข้อมูลวัสดุ

    function insert_bill(){
        console.log("test");
        i++;
        var rs_tag = "";
        if( i >= 0 ){
            for( j =0 ; j <i ; j++){
                rs_tag += "<tr class='tr"+j+ "'>";
                    rs_tag += '<td class ="text-center">'+ ' ' +'</td>'; //bill Code
                    rs_tag += '<td class="text-center">'+ '3/05/2562' +'</td>'; //date
                    rs_tag += '<td class="text-center">'+ 'สนามที่ 33' +'</td>' // field
                    rs_tag += '<td class="text-center"><input class="time form-control " id="time_start"></td>'//date S
                    rs_tag += '<td class="text-center"><input class="time form-control " id="time_end"></td>'//date E              
                    rs_tag += '<td class="text-center"> 700   </td>'// price
                rs_tag +="</tr>"
            }
        }
        console.log(rs_tag);
        $("#list_bill").html(rs_tag);
       $('.time').timepicker({
            minuteStep: 5,
            showInputs: false,
            disableFocus: true,
            showSeconds:true,
            showMeridian: false
        });
    }

</script>

  
