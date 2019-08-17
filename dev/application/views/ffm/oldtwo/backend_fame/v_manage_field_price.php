<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"> -->

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading panel_table_iserl">
             <h2><i class="fas fa-history"></i>จัดการอัตราค่าบริการของสนามตามช่วงเวลา ของสนาม <?php echo $rs_field['ff_name']; ?></h2>
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
                        <tr>
                            <td class="text-center">1</td>
                            <td class="text-center">9.00 น.</td>
                            <td class="text-center">12.00 น.</td>
                            <td class="text-center">500</td>
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



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h2 class="modal-title">เพิ่มอัตราค่าบริการตามช่วงเวลา</h2>
            </div>
            <div class="modal-body">
                
 

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick='submit_data()' >Save changes</button>
            </div>
        </div>
    </div>
</div>
                
                
<script>
    let table_data

    $(document).ready(() => {
        get_main_data()
    })

    function submit_data() {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('/ffm/backend/Field_manage/submit_table');?>",
            data: {
                table_data: table_data
            },
            success: function(result){
                console.log(result)
                // let data = JSON.parse(result)

                // table_data = data
                // create_table()
            }
        });
    }

    function get_main_data() {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('/ffm/backend/Field_manage/get_table_cost_config/1');?>",
            data: {},
            success: function(result){
                let data = JSON.parse(result)

                table_data = data
                create_table()
            }
        });
    }

    function create_table() {
        $('#main-table').find('tbody').empty()

        table_data.forEach((row, index) => {
            $('#main-table').find('tbody').append(
                $('<tr>').append(
                    $('<td>').text((index + 1))
                ).append(
                    $('<td>').text(row.cc_start_time)
                ).append(
                    $('<td>').text(row.cc_end_time)
                ).append(
                    $('<td>').text(row.cc_cost)
                ).append(
                    $('<td>').append(
                        $('<a>').addClass('btn btn-danger').append(
                            $('<i>').addClass('ti ti-close').attr('onclick', 'del_data('+index+')')
                        )
                    )
                )
            )
        })
    }

    function del_data(index) {
        table_data.splice(index, 1)
        create_table()
        console.log(table_data)
    }

    function add_data(name) {
        table_data.push(
            {
                ff_name: name
            }
        )

        create_table()

        console.log(table_data)
    }

    function update(index, name) {
        table_data[index].ff_name = name
    }
</script>