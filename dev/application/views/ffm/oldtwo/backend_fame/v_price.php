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
            url: "<?php echo site_url('/ffm/backend/Field_manage/get_sample_data');?>",
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