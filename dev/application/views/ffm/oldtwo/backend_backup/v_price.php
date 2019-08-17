<script src='<?php echo base_url('backend/js/moment.js'); ?>'></script>
<style>
    /* .datetimepicker {
        width : 500px !important
    } */
</style>
<script>

    $(document).ready(() => {
        // $('#time_start').datetimepicker({ // Time
		// 	format: "hh:ii:00",
        // 	weekStart: 1,
        // 	todayBtn:  1,
		// 	autoclose: 1,
		// 	todayHighlight: 1,
		// 	startView: 1,
		// 	minView: 0,
		// 	maxView: 1,
		// 	forceParse: 0
        // });
        // $('#time_end').datetimepicker({ // Time
		// 	format: "hh:ii:00",
        // 	weekStart: 1,
        // 	todayBtn:  1,
		// 	autoclose: 1,
		// 	todayHighlight: 1,
		// 	startView: 1,
		// 	minView: 0,
		// 	maxView: 1,
		// 	forceParse: 0
        // });
        $('.time').timepicker({
            minuteStep: 5,
            showInputs: false,
            disableFocus: true,
            showSeconds:true,
            showMeridian: false
        });
    })

    

    function get_time_value() {
        console.log($('#time_start').val())
        console.log($('#time_end').val())
    }

</script>
<!-- <div class='input-group date'> -->
    <input class='form-control time' id='time_start'>
<!-- </div> -->
<div class='form-group'>
<div class='col-sm-5'>
    <input class='form-control time' id='time_end'>
</div>
</div>
<a class='btn btn-primary'><i class='ti ti-plus' onclick='get_time_value()'></i></a>
<div class='panel'>
    <div class='panel-body'>
        <a class='btn btn-success' onclick = 'add_data("test")'><i class='ti ti-plus'></i></a>
        <table id='main-table' class = 'table table-bordered'>
            <thead>
                <tr>
                    <td>ลำดับ</td>
                    <td>รายการ</td>
                    <td>ดำเนินการ</td>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <a class='btn btn-success' onclick='submit_data()'>บันทึก</a>
    </div>
</div>

<script>
    let table_data

    // $(document).ready(() => {
        // get_main_data()
    // })

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
        // $.ajax({
        //     type: "POST",
        //     url: "<?php echo site_url('/ffm/backend/Field_manage/get_sample_data');?>",
        //     data: {},
        //     success: function(result){
        //         let data = JSON.parse(result)

        //         table_data = data
        //         create_table()
        //     }
        // });
    }

    function create_table() {
        $('#main-table').find('tbody').empty()

        table_data.forEach((row, index) => {
            $('#main-table').find('tbody').append(
                $('<tr>').append(
                    $('<td>').text((index + 1))
                ).append(
                    $('<td>').text(row.ff_name)
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