<table id="datatables" class="table table-striped table-color-header table-hover table-border" cellspacing="0" width="100%" style="width:100%">
    <thead class="text-primary">
        <tr>
            <th>ลำดับ</th>
            <th>รหัสสมาชิก</th>
            <th>ชื่อ - นามสกุล</th>
            <th>อายุ (ปี)</th>
            <th>วันที่สมัคร</th>
            <th class="disabled-sorting">ดำเนินการ</th>
        </tr>
    </thead>
    <tbody>
        <!-- <?php
        foreach ($rs_userdata as $key => $value) {
            ?>
        <tr>

            <td class='text-center'><?php echo $key + 1; ?></td>
            <td class='text-center'><?php echo $value->su_code; ?></td>
            <td style="text-align:left"><?php echo $value->ps_fname . " " . $value->ps_lname; ?></td>
            <td class='text-center'><?php echo calAge3($value->age); ?></td>
            <td class='text-center'><?php echo date("d/m/Y", strtotime($value->su_create_date)); ?></td>
            <td class="td-actions text-center">
                <a href="<?php echo site_url() . "/swm/backend/Swm_manage_member/member_data_show/" . $value->su_ps_id; ?>" <button type="button" rel="tooltip" class="btn btn-primary" title='คลิกเพื่อค้นหาข้อมูล'>
                    <i class="material-icons">search</i>
                    </button></a>
                <a href="<?php echo site_url() . "/swm/backend/Swm_manage_member/member_data_edit/" . $value->su_ps_id ?>" <button type="button" rel="tooltip" class="btn btn-warning" title='คลิกเพื่อแก้ไขข้อมูล'>
                    <i class="material-icons">edit</i>
                    </button></a>
            </td>
        </tr>
        <?php
        }
        ?> -->
    </tbody>
</table>


