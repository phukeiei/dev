<style>
    .status1 {
        color: orange;
    }

    .status2 {
        color: green;
    }

    .status3 {
        color: red;
    }
</style>
<script>
    function get_member_status() {
        $('#pending').on('click', function(e) {
            $('#member_status').val(1);
        });
        $('#member').on('click', function(e) {
            $('#member_status').val(2);
        });
        $('#disqualify').on('click', function(e) {
            $('#member_status').val(3);
        });
        $('#expire').on('click', function(e) {
            $('#member_status').val(4);
        });
    }
    function show_table() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . "index.php/swm/backend/Swm_manage_member/member_table_show"; ?>",
            data: {
                status: $('#member_status').val()
            },
            dataType: "json",
            success: function(data) {
                console.log(data);

                var table = $('#datatables').DataTable();

                //clear datatable
                table.clear().draw();

                //destroy datatable
                table.destroy();

                var rowCount;
                if (data.length != 0) {
                    $('.odd').remove();
                    $.each(data, function(index) {
                        rowCount = $('tr').length;
                        $('tbody')
                            .append($('<tr class="jsTable">')
                                .append($('<td>').text(rowCount).attr('class', 'text-center'))
                                .append($('<td>').text(this.su_code).attr('class', 'text-center'))
                                .append($('<td>').text(this.ps_fname + " " + this.ps_lname).attr('class', 'text-left'))
                                .append($('<td>').text(this.age).attr('class', 'text-center'))
                                .append($('<td>').text(this.su_create_date).attr('class', 'text-center'))
                                .append($('<td>')
                                    .append($('<center>')
                                        .append($(`<a>`).attr('href', `<?php echo site_url() . "/swm/backend/Swm_manage_member/member_data_show/"; ?>${this.su_ps_id}`)
                                            .append($(`<button type="button" rel="tooltip" class="btn btn-primary" title='คลิกเพื่อค้นหาข้อมูล'>`)
                                                .append($(`<i class="material-icons">search</i>`))
                                            )
                                        )
                                        .append($(`<a>`).attr('href', `<?php echo site_url() . "/swm/backend/Swm_manage_member/member_data_edit/"; ?>${this.su_ps_id}`)
                                            .append($(`<button type="button" rel="tooltip" class="btn btn-warning" title='คลิกเพื่อแก้ไขข้อมูล'>`)
                                                .append($(`<i class="material-icons">edit</i>`))
                                            )
                                        )
                                    )
                                )   
                            )
                        
                    });
                }
                refreshTable();
            }        
        });
        
    }
    function refreshTable() {
        dt = $('#datatables').DataTable();
        dt.fnDraw();
        dt.DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ], 
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "ค้นหา",
            }
        });
    }
    $(document).ready(function() {
        get_member_status();
        show_table();
        $('a').on('click', function(e) {
            show_table();
        });
    });
</script>
<div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-info card-header-icon">
            <div class="card-icon">
                <i class="material-icons">assignment</i>
            </div>
            <h4 class="card-title">ข้อมูลสมาชิก</h4>
        </div>
        <div class="card-body">
            <div class="card card-nav-tabs card-plain">
                <div class="card-header card-header-primary">
                    <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                    <div class="nav-tabs-navigation">
                        <div class="nav-tabs-wrapper">
                            <ul class="nav nav-tabs" data-tabs="tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#table" data-toggle="tab" id="pending">รออนุมัติ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#table" data-toggle="tab" id="member">สมาชิก</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#table" data-toggle="tab" id="disqualify">ตัดสิทธิ์</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#table" data-toggle="tab" id="expire">หมดอายุสมาชิก</a>
                                </li>
                            </ul>
                            <input type="hidden" name="status_id" id="member_status" value="1">
                        </div>
                    </div>
                </div>
                <div class="card-body ">
                    <div class="tab-content text-center">
                        <div class="tab-pane active" id="table">
                            <div class="panel panel-info">
                                <div class="panel-heading panel_table_iserl">
                                    <div class="panel-ctrls"></div>
                                </div>
                                <div class="material-datatables">
                                    <?php echo $v_table; ?>
                                </div>
                                <div class="panel-footer">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>