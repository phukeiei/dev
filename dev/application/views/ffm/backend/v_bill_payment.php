<!--
    File : V_Bill_payment.php
    @Auther : Noppadol  Chansuk 
    @Edie Data : 20/05/2562 
-->
<script src='<?php echo base_url('backend/js/moment.js'); ?>'></script>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading panel_table_iserl">
            <h2>ใบเสร็จ </h2>   
        </div>
        <br>
        <div class ="col-sm-offset-11">
        <button class="btn btn-social btn-google btn_iserl tooltips ti ti-plus table-bordered" data-toggle="modal"  href="#myModal" ><span></span></button>
               </div>
        <div class="panel-body">    
            <div class="form-group">    
                <table  class="table  table-hover  m-n" cellspacing="0">
                    <thead > 
                        <tr>
                        <th class ="text-center"> </th>
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
                        <input type="text" class="form-control text-right" placeholder="" disabled="" id="pay">
                    </div>
                    <label class="control-label">บาท</label>
                </div>  
                <div class="form-group">
                    <label class="col-sm-offset-7 col-sm-2 control-label">รับเงิน:</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id='pay_value'>
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
                    <!-- <button class="col-sm-offset-11 btn btn-success btn_iserl tooltips" title="คลิกปุ่มเพื่อบันทึกข้อมูล" onclick='submit_data()'><span>บันทึก</span></button>  -->
                </div> 
            </div> 
        </div>
        <div class="panel-footer">
            <div class="col-md-12">
                <button class="btn btn-inverse btn_iserl tooltips" title="คลิกปุ่มเพื่อย้อนกลับ" onclick="window.location='<?php echo site_url('/'.$dir.'/bill');?>'"><span>ย้อนกลับ</span></button>
                <button class="pull-right btn btn-success btn_iserl tooltips" title="คลิกปุ่มเพื่อบันทึกข้อมูล" onclick='submit_data()'><span>บันทึก</span></button> 
            </div>	
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div style="padding-top:5%" class="form-group">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading panel_heading_iserl">
                    <h2><i class="ti ti-timer"></i>เพิ่มช่วงเวลา</h2>
                </div>
                <div class="panel-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-3 col-sm-offset-1 control-label">เวลาที่เริ่ม:</label>
                            <div class="col-sm-5">
                                <input class="form-control time" name= "cc_start_time" id = "cc_start_time">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-sm-offset-1 control-label">เวลาที่สิ้นสุด:</label>
                            <div class="col-sm-5">
                                <input class="form-control time" name= "cc_end_time" id = "cc_end_time"> 
                            </div>
                        </div>
                    </div> 
                </div>  <!-- panel-body -->
                <div class="panel-footer">
                    <button type="button" class="btn btn-default" style="float:left;"  data-dismiss="modal">ปิด</button>
                    <button type="button" class="btn btn-success" style="float:right;" onclick='insert_cost()' data-dismiss="modal">เพิ่มบิล</button>
                </div>  <!-- panel-footer -->
            </div>
        </div>  
    </div>
</div> 

 <div class="col-md-3">
<!-- <button class="btn btn-inverse btn_iserl tooltips" title="คลิกปุ่มเพื่อย้อนกลับ" onclick="window.location='<?php echo site_url('/'.$dir.'/Bill/v_bill');?>'"><span>ย้อนกลับ</span></button> -->
</div>  

<style>
    .datetimepicker {
        width : 500px !important
    }
    .time{
    z-index: 100000 ! important;
    }
    .bootstrap-timepicker-widget.dropdown-menu.open, .bootstrap-timepicker-widget.tt-dropdown-menu.open{
        z-index: 100000 ! important;
    }
</style>
 <script src='<?php echo base_url('backend/js/moment.js'); ?>'></script>
<script> 
    const formatter = new Intl.NumberFormat('en-US',{
        minimumFractionDigits: 2
    })
     $(document).ready(() => {
        add_data();
        $('.time').timepicker({ // Time
            minuteStep: 5,
            showInputs: false,
            disableFocus: true,
            showSeconds:true,
            showMeridian: false
        });
        $("body").on('click','.d',function() {
            var  a = $(this).data('id_d');  
            array.splice(a,1);
            display_product_table();
        });
    });
    var teamp = 0; //เก็บจำนวนเงินทั้งหมดของวัสดุ
    var index = 0; //เก็บจำนวนแถวของบิล
    var size = 0;
    var array = []; //เก็บข้อมูลบิล
    var total_cost=0;
    var fr_id = <?php echo $get_fr_id;?>;
    var rs_tag = "";
    var ff_id
       function add_data(){
        var fr_id = <?php echo $get_fr_id;?>;
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("/".$dir."/Bill/get_bill_json_by_id/".$get_fr_id);?>',
            data:{
              fr_id:fr_id,
            },
            success : function(data){
                var text ;
                var conv = JSON.parse(data);
                ff_id = conv[0]['ff_id']
                conv.forEach((row) => {
                rs_tag += "<tr class='tr"+'1'+ "'>";
                    rs_tag += '<input type="hidden" id="field_id" value="'+row.ff_id+'">';
                    rs_tag += '<input type="hidden" id="dist_id" value="'+row.fr_dist_id+'">';
                    rs_tag += '<td align="center" >'+' '+'</td>';
                    rs_tag += '<td align="center">'+((row.fr_start_date == '0000-00-00') ? '-' : row.fr_start_date)+'</td>'; //date
                    rs_tag += '<td align="center">'+((row.ff_name == null) ? '-' : row.ff_name)+'</td>';//name field
                    rs_tag += '<td align="left">'+row.fr_start_time+'</td>'; // time start
                    rs_tag += '<td align="right" >'+row.fr_end_time+'</td>'; //formatter.format()
                    rs_tag += '<td align="right" >'+formatter.format(row.fr_cost)+'</td>'; //formatter.format()    
                rs_tag += "</tr>";
                    array[index]={
                        id: row.fr_id,
                        field_id: row.ff_id,
                        in_area: row.in_area,
                        bill_code: "",
                        start_date: (row.fr_start_date == '0000-00-00') ? '-' : row.fr_start_date,
                        field_name: (row.ff_name == null) ? '-' : row.ff_name,
                        start_time: row.fr_start_time,
                        end_time: row.fr_end_time,
                        cost: row.fr_cost
                    };
                    total_cost += parseInt(row.fr_cost);
                    rs_tag
                    index++;
                })
                
                $("#list_bill").html(rs_tag);
                $("#pay").val(total_cost);
            } 
            
        });
    }
    function insert_cost($field_id){
        let start_time = $("#cc_start_time").val();
        let end_time = $("#cc_end_time").val();
        let field_id = $("#field_id").val();
        let dist_id = $("#dist_id").val();
        // let field_id = "1"//$()
        size++;
        var cost_total = 0;
        // console.log(ff_id)
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("/ffm/backend/Bill/calculate_cost");?>',
            data:{
              start_time: start_time,
              end_time: end_time,
              field: ff_id,
              type:'1',
              return_type:'1'

            },
            success : function(data){
                var text ;
                var conv = JSON.parse(data);
                var i = 0;
                conv.forEach((row)=>{
                    cost_total += row.price ;
                });
                var format = 'hh:mm:ss'
                let check = true
                var time_start = moment(start_time,format)
                var time_end = moment(end_time,format)
                array.forEach((row, index) => {
                    var beforeTime = moment(row.start_time, format)
                    var afterTime = moment(row.end_time, format);
                    if (time_start.isBetween(beforeTime, afterTime) ||  time_end.isBetween(beforeTime, afterTime) || time_start.isSame(beforeTime) || time_end.isSame(beforeTime) ||  time_end.isSame(afterTime)) {
                        check = false
                    } 
                    
                })
                if (check) {
                    array.push({
                        id:'',
                        bill_code: "",
                    start_date: '-',
                    field_name: '-',
                    field_id: array[0]['field_id'],
                    in_area: array[0]['in_area'],
                    start_time: start_time,
                    end_time: end_time,
                    cost: cost_total})
                    display_product_table();
                    total_cost += parseInt(cost_total);
                    $("#pay").val(total_cost);
                    new PNotify({
                        title: 'เพิ่มช่วงเวลาสำเร็จ',
                        text: '',
                        type: 'success',
                        icon: 'ti ti-check',
                        styling: 'fontawesome'
                    });
                } else {
                    new PNotify({
                        title: 'ช่วงเวลาที่คุณเลือกมีอยู่แล้วในระบบ',
                        text: '',
                        type: 'danger',
                        icon: 'ti ti-close',
                        styling: 'fontawesome'
                    });
                }
            } 
            
        });
       
    }
    function display_product_table(){
        const formatter = new Intl.NumberFormat('en-US',{
         minimumFractionDigits: 2
        })
        var rs_tag = "";
        var index = 1;
        var total = 0 ;
        var j = 0;
        console.log(array); 

        if( size >= 0 ){
            array.forEach((row) => {
                console.log(row);
                if(row != null && row!==undefined ){
                    if(row.id != ''){
                        rs_tag += "<tr class='tr"+j+ "'>";
                            rs_tag += '<input type="hidden" id="field_id_'+index+'">';
                            rs_tag += '<td align="center" >'+' '+'</td>';
                            rs_tag += '<td align="center">'+row.start_date+'</td>'; //date
                            rs_tag += '<td align="center">'+row.field_name+'</td>';//name field
                            rs_tag += '<td align="left">'+row.start_time+'</td>'; // time start
                            rs_tag += '<td align="right" >'+row.end_time+'</td>'; //formatter.format()
                            rs_tag += '<td align="right" >'+formatter.format(row.cost)+'</td>'; //formatter.format()
                            rs_tag += '<td align="center" >'+' '+'</td>';
                        rs_tag += "</tr>"; 
                        j++; 
                    }else{
                        rs_tag += "<tr class='tr"+j+ "'>";
                            rs_tag += '<input type="hidden" id="field_id_'+index+'">';
                            rs_tag += '<td align="center" >'+' '+'</td>';
                            rs_tag += '<td align="center">'+row.start_date+'</td>'; //date
                            rs_tag += '<td align="center">'+row.field_name+'</td>';//name field
                            rs_tag += '<td align="left">'+row.start_time+'</td>'; // time start
                            rs_tag += '<td align="right" >'+row.end_time+'</td>'; //formatter.format()
                            rs_tag += '<td align="right" >'+formatter.format(row.cost)+'</td>'; //formatter.format()
                            rs_tag += '<td align="center" >'+'<a href="#" class="d btn btn-danger btn_check_iserl tooltips ti ti-close" title="คลิกปุ่มเพื่อลบข้อมูล" data-id_d="'+j+'" ></a>'+'</td>';
                        rs_tag += "</tr>";    
                        j++; 
                    }                   
                index++; 
                      
                }
            })
                
            $("#list_bill").html(rs_tag);
            
        }
    }//end display_product_table

    function submit_data() {
        if ($('#pay').val() > $('#pay_value').val()) {
            new PNotify({
                        title: 'กรุณากรอกจำนวนเงินให้ถูกต้อง',
                        text: '',
                        type: 'danger',
                        icon: 'ti ti-close',
                        styling: 'fontawesome'
                    });
        } else {
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url("/ffm/backend/Bill/save_bill/");?>',
                data:{
                    data: array,
                }, success : function(data){
                    new PNotify({
                        title: 'ชำระเงินสำเร็จ',
                        text: '',
                        type: 'success',
                        icon: 'ti ti-check',
                        styling: 'fontawesome'
                    });
                    window.location.replace('<?php echo site_url("ffm/backend/Bill"); ?>')
                }
            })
        }
    }

</script>

  
    