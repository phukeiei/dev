<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"> -->
<script src='<?php echo base_url('backend/js/moment.js'); ?>'></script>
<style>
.time{
    z-index: 100000 ! important;
}
.bootstrap-timepicker-widget.dropdown-menu.open, .bootstrap-timepicker-widget.tt-dropdown-menu.open{
    z-index: 100000 ! important;
}
</style>

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading panel_table_iserl">
             <h2><i class="ti ti-settings"></i>จัดการอัตราค่าบริการของสนามตามช่วงเวลา ของ<?php echo $rs_field[0]->ff_name;?></h2>
            <div class="panel-ctrls"></div>
            
		</div>
		<div class="panel-body">
            <div class="form-horizontal">
            <div class="form-group">
                <div class="col-md-3">
                    <a class="btn btn-social btn-google btn_iserl tooltips ti ti-plus" 
                    title="คลิกปุ่มเพื่อเพิ่มเวลา" data-toggle="modal" href="#myModal" ><span> เพิ่มเวลา</span></a>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="tab-container">
                        <ul class="nav nav-tabs">
                            <li class="active" onclick="create_table(1)"><a data-toggle="tab">ในเขต</a></li>
                            <li onclick="create_table(2)"><a data-toggle="tab">นอกเขต</a></li>
                        </ul>
                        <div class="tab-content">
                            <table id="main-table" class="table table-striped table-bordered table_iserl no-footer table-hover dataTable-Export" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>เวลาที่เริ่ม</th>
                                        <th>เวลาที่สิ้นสุด</th>
                                        <th>ราคา</th>
                                        <th>ดำเนินการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>  
                </div>  
            </div>
            </div>
            <div style="float: left;">
                <button class="btn btn-inverse btn_iserl tooltips" title="คลิกปุ่มเพื่อย้อนกลับ" onclick="window.location='<?php echo site_url('/'.$dir.'/Field_manage');?>'"><span>ย้อนกลับ</span></button>
            </div>	  
            <div style="float: right;">
                <button class="btn btn-success btn_iserl tooltips" title="คลิกปุ่มเพื่อบันทึกข้อมูล" onclick='submit_data()' ><span>บันทึก</span></button>
            </div> 
        </div>	<!-- panel-body -->
    </div>	
</div>	

<!-- modal -->
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
                        <div class="form-group">
                            <label class="col-sm-3 col-sm-offset-1 control-label">ราคา:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name= "cc_cost" id = "cc_cost"> 
                            </div>
                        </div>
                        <label class="col-sm-3 col-sm-offset-1 control-label">ประเภทผู้ใช้:</label>
                        <div class="col-sm-5">
                            <select name="cc_type" id="cc_type" class="form-control">
                                <option value="1">ในเขต</option>
                                <option value="2">นอกเขต</option>
                            </select>
                        </div>              
                    </div> 
                </div>	<!-- panel-body -->
                <div class="panel-footer">
                    <button type="button" class="btn btn-default" style="float:left;"  data-dismiss="modal">ปิด</button>
                    <button type="button" class="btn btn-success" style="float:right;" onclick='add_data()' data-dismiss="modal">บันทึก</button>
		        </div>	<!-- panel-footer -->
            </div>
        </div>	
    </div>
</div>    
<!-- Modal -->
<!-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h2 class="modal-title">เพิ่มอัตราค่าบริการตามช่วงเวลา</h2>
            </div>
            <div class="modal-body">
                <center>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">เวลาที่เริ่ม:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name= "cc_start_time" id = "cc_start_time"> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">เวลาที่สิ้นสุด:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name= "cc_end_time" id = "cc_end_time"> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">ราคา:</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name= "cc_cost" id = "cc_cost"> 
                            </div>
                        </div>
                    </div>
                </center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-primary" onclick='add_data()' >บันทึก</button>
            </div>
        </div>
    </div>
</div> -->
                
                
<script>
    let table_data
    let global_type
    $(document).ready(() => {
        get_main_data(1)
        $('.time').timepicker({ // Time
			minuteStep: 5,
            showInputs: false,
            disableFocus: true,
            showSeconds:true,
            showMeridian: false
        });
       
    })

    function submit_data() {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('/ffm/backend/Field_manage/update_cost/'.$rs_field[0]->ff_id);?>",
            data: {
                table_data: table_data
            },
            success: function(result){
                new PNotify({
                title: 'บันทึกข้อมูลสำเร็จ',
                text: '',
                type: 'success',
                icon: 'ti ti-check',
                styling: 'fontawesome'
                });
            }
        });
    }

    function get_main_data() {
        
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('/ffm/backend/Field_manage/get_table_cost_config/'.$rs_field[0]->ff_id);?>",
            data: {
                
            },
            success: function(result){
                let data = JSON.parse(result)

                table_data = data
                create_table(1)
            }
        });
    }

    function create_table(type) {
        global_type = type
        var index = 0
        $('#main-table').dataTable().fnClearTable()
        // console.log(table_data)
        table_data.forEach((row) => {
            let btn_del = '<a class="btn btn-danger btn_iserl tooltips" onclick="del_data('+index+')">ลบ</a>'

            if(row.cc_type == type){
                $('#main-table').dataTable().fnAddData([
                    (index + 1),
                    row.cc_start_time,
                    row.cc_end_time,
                    row.cc_cost,
                    btn_del
                ])
                index++
            }
            // console.log(row)
            // console.log('create_table')
        })
        // console.log('finish')
        // $('#main-table').find('tbody').empty()

        // table_data.forEach((row, index) => {
        //     $('#main-table').find('tbody').append(
        //         $('<tr>').append(
        //             $('<td>').text((index + 1))
        //         ).append(
        //             $('<td>').text(row.cc_start_time)
        //         ).append(
        //             $('<td>').text(row.cc_end_time)
        //         ).append(
        //             $('<td>').text(row.cc_cost)
        //         ).append(
        //             $('<td>').append(
        //                 $('<a>').addClass('btn btn-orange btn_iserl tooltips').append(
        //                     $('<i>').addClass('ti ti-pencil').attr('onclick', 'del_data('+index+')')
        //                 ),
        //                 $('<a>').addClass('btn btn-danger btn_iserl tooltips').append(
        //                     $('<i>').addClass('ti ti-close').attr('onclick', 'del_data('+index+')')
        //                 )
        //             )
        //         )
        //     )
        // })
    }

    function del_data(index) {
        table_data.splice(index, 1)
        // console.log(index)
        create_table()
        // console.log(table_data)
    }

    function add_data() {
        var cc_id = ""
        var cc_ff_id = <?php echo $rs_field[0]->ff_id; ?>;
        var cc_start_time = $('#cc_start_time')[0].value
        var cc_end_time = $('#cc_end_time')[0].value
        var cc_cost = $('#cc_cost')[0].value
        var cc_type = $('#cc_type')[0].value
        var cc_update = new Date();

        var format = 'hh:mm:ss'

        // var time = moment() gives you current time. no format required.
        
        let check = true
        var time_start = moment(cc_start_time,format)
        var time_end = moment(cc_end_time,format)
        table_data.forEach((row, index) => {
            var beforeTime = moment(row.cc_start_time, format)
            var afterTime = moment(row.cc_end_time, format);
            if(cc_type == row.cc_type){
                if (time_start.isBetween(beforeTime, afterTime) ||  time_end.isBetween(beforeTime, afterTime) || time_start.isSame(beforeTime)  || time_end.isSame(beforeTime) ||  time_end.isSame(afterTime)) {
                    check = false
                } 
            }
            
        })

        if (check) {
            table_data.push(
            {
                cc_id : cc_id,
                cc_ff_id : cc_ff_id,
                cc_start_time: cc_start_time,
                cc_end_time: cc_end_time,
                cc_cost: cc_cost,
                cc_type: cc_type,
                cc_update: cc_update
            }
            )
            new PNotify({
                title: 'เพิ่มช่วงเวลาสำเร็จ',
                text: '',
                type: 'success',
                icon: 'ti ti-check',
                styling: 'fontawesome'
            });
        }else{
            new PNotify({
                title: 'ช่วงเวลาที่คุณเลือกมีอยู่แล้วในระบบ',
                text: '',
                type: 'danger',
                icon: 'ti ti-close',
                styling: 'fontawesome'
            });
        }
        $('#cc_start_time')[0].value = ""
        $('#cc_end_time')[0].value = ""
        $('#cc_cost')[0].value = ""
        create_table(global_type)
        console.log(table_data)
    }

    function update(index, name) {
        table_data[index].ff_name = name
    }

   
</script>