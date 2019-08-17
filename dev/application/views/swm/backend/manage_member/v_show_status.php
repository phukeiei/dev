<!--/*
* v_showstatus
* Display status all member 
* @input    -
* @output   search,id,name,age,status,option
* @author   Kanathip Phithaskilp
* @Update   Kanathip Phithaskilp
* @Update Date  2562-5-17
 */-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Member</title>

    <style>
        .status1 {
            color: orange;
        }

        .status2 {
            color: green;
        }
        .status3{
            color: red;
        }
    </style>
</head>

<body>
    
    <!-- <script>
        $(document).ready(function() {

            $('.xx').each(function(ind,ele){
                let num = $(ele).data('ssid')
                $(ele).addClass('status'+num)
            })

        });
    </script>-->
    <div class="panel panel-info">
        <div class="panel-heading panel_table_iserl">
            <h2> ข้อมูลสมาชิก </h2>
            <div class="panel-ctrls"></div>
        </div>
        <div class="panel-body material-datatables">
            <table id="datatables" class="table table-striped table-bordered no-footer table-hover dataTable-Export">
                <thead class="text-primary">
                    <tr>
                        <th>ลำดับ</th>
                        <th>รหัสสมาชิก</th>
                        <th>ชื่อจริง - นามสกุล</th>
                        <th>สถานะ</th>
                        <th class="disabled-sorting">ตัวดำเนินการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($status as $key => $value) { ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $key + 1; ?></td>
                            <td style="text-align: center;"><?php echo $value['su_ps_id'] ?></td>
                            <td><?php echo $value['pf_name'] . "   " . $value['ps_fname'] . " " . $value['ps_lname'] ?></td>
                            <td style="text-align: center;" class="xx status<?php echo $value['ss_id']; ?>" data-ssid="<?php echo $value['ss_id']; ?>"> <?php echo $value['ss_name']; ?></td>

                            <form action="./edit_status" method="POST">
                                <td style="text-align: center;"><button type="submit" name="id" value="<?php echo $value['su_id'] ?>  " class="btn btn-warning">แก้ไข</button></td>
                            </form>
                        </tr>
                    <?php } ?>

                </tbody>
                <tfoot>
               
                    </tfoot>
            </table>
        </div>
        <div class="panel-footer">
            <a href="<?php echo site_url() . "/swm/backend/Swm_manage_member" ?>"  class="btn btn-inverse btn_iserl tooltips pull-left" data-dismiss="modal">ย้อนกลับ</a>
           
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
</body>

</html>