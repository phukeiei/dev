<div class="panel panel-info">
    <div class="panel-heading panel_table_iserl">
        <h2> ข้อมูลสมาชิก </h2>
        <div class="panel-ctrls"></div>
    </div>
    <div class="panel-body material-datatables">
        <table id="datatables" class="table table-striped table-color-header table-hover table-border" cellspacing="0" width="100%" style="width:100%">
            <thead class="text-primary">
                <tr role="row">
                    <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 70px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">ลำดับ</th>
                    <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 100px;" aria-label="Position: activate to sort column ascending">รหัสสมาชิก</th>
                    <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 180px;" aria-label="Office: activate to sort column ascending">ชื่อจริง</th>
                    <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 180px;" aria-label="Date: activate to sort column ascending">นามสกุล</th>
                    <th class="disabled-sorting sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 145px;" aria-label="Actions: activate to sort column ascending">ตัวดำเนินการ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($rs_userdata as $key) {
                    $i++;
                    ?>
                <tr>
                    <td class='text-center'><?php echo $i; ?></td>
                    <td class='text-center'><?php echo $key['ps_id'] ?></td>
                    <td><?php echo $key['ps_fname'] ?></td>
                    <td><?php echo $key['ps_lname'] ?></td>
                    <td class="td-actions text-center">
                        <form method="post" action="<?php echo base_url(); ?>index.php/swm/backend/Swm_register/regis_form_input">
                            <input type="hidden" name="ps_id" value="<?php echo $key['ps_id'] ?>">
                            <input class="btn btn-success btn_iserl tooltips" title="คลิกปุ่มเพื่อเพิ่มสิทธิ์เข้าใช้" type="submit" value="เพิ่มสิทธิ์เข้าใช้" />
                        </form>
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