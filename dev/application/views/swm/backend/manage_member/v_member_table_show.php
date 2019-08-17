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
<div class="panel panel-info">
    <div class="panel-heading panel_table_iserl">
        <h2> ข้อมูลสมาชิก </h2>
        <div class="panel-ctrls"></div>
    </div>
    <div class="panel-body material-datatables">
        <table id="datatables" class="table table-striped table-bordered table_iserl no-footer table-hover dataTable-Export">
            <thead class="text-primary">
                <tr>
                    <th>ลำดับ</th>
                    <th>รหัสสมาชิก</th>
                    <th>ชื่อ - นามสกุล</th>
                    <th>อายุ</th>
                    <th>วันที่สมัคร</th>
                    <th>สถานะ</th>
                    <th class="disabled-sorting">ดำเนินการ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($rs_userdata as $key => $value) {
                    ?>
                <tr>

                    <td class='text-center'><?php echo $key + 1; ?></td>
                    <td class='text-center'><?php echo $value->su_code; ?></td>
                    <td style="text-align:left"><?php echo $value->ps_fname . " " . $value->ps_lname; ?></td>
                    <td class='text-center'><?php echo calAge3($value->age); ?></td>
                    <td ><?php echo date("d/m/Y", strtotime($value->su_create_date)); ?></td>
                    <td class="status<?php echo $value->ss_id ?>"><?php echo $value->ss_name; ?></td>
                    <td class="td-actions text-center">
                        <a href="<?php echo site_url() . "/swm/backend/Swm_manage_member/member_data_show/" . $value->su_ps_id; ?>"
                        <button type="button" rel="tooltip" class="btn btn-primary" title='คลิกเพื่อค้นหาข้อมูล'>
                            <i class="material-icons">search</i>
                            </button></a>
                        <a href="<?php echo site_url() . "/swm/backend/Swm_manage_member/member_data_edit/" . $value->su_ps_id ?>"
                        <button type="button" rel="tooltip" class="btn btn-warning" title='คลิกเพื่อแก้ไขข้อมูล'>
                            <i class="material-icons">edit</i>
                            </button></a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="panel-footer">
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }
        });
    });
</script>