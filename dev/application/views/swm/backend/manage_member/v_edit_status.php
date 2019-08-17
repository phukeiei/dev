<!--/*
* v_edit_status
* Edit status  member 
* @input    status
* @output   id,name,lastname,age,status
* @author   Kanathip Phithaskilp
* @Update   Kanathip Phithaskilp
* @Update Date  2562-5-19
 */-->



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>แก้ไขสถานะ</title>

</head>

<body>

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading panel_heading_iserl">
                <h2>แก้ไขสถานะ</h2>
            </div>

            <div class="panel-body">
                <form method="post" action="./set_status ">
                    <div>
                        <label class="col-sm-2 control-label">รหัสสมาชิก :</label>
                        <div class="col-sm-2">
                            <span>
                                <?php foreach ($sta as $value) {
                                    $test = $value['su_id'];
                                    echo $value['su_ps_id'] ?></span>
                            </div>
                        </div><br><br>
                        <div class="form-group ">
                            <label class="col-sm-2 control-label">ชื่อ - นามสกุล :</label>
                            <div class="col-sm-3">
                                <span>
                                    <?php echo $value['pf_name'] . "   " . $value['ps_fname'] . "   " . $value['ps_lname'] ?></span>
                            </div>
                        </div><br>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">อายุ :</label>
                            <div class="col-sm-1">
                                <span><?php echo calAge3($value['regisdate']) ?></span>
                            </div>
                        </div><br>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">วันที่สมัคร : </label>
                            <div class="col-sm-2">
                                <span><?php echo abbreDate2($value['su_create_date']); ?></span>
                            </div>
                        </div><br>
                    <?php } ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">สถานะสมาชิก :</label>
                        <div class="col-sm-2">
                            <select class="form-control" name="status" id="status">
                                <option value="<?php echo $value['ss_id']; ?>" selected><?php echo $value['ss_name']; ?>&nbsp;( ค่าเดิม )</option>

                                <?php foreach ($status as $value) { ?>
                                    <option value="<?php echo $value['ss_id']; ?>"><?php echo $value['ss_name']; ?></option>
                                <?php  } ?>
                            </select>
                        </div>
                    </div><br>
                    <div class="form-group">
                        <label id="title" class="col-sm-2 control-label">ความคิดเห็น :</label>
                        <div class="col-sm-8">
                            <div id="reg_address" name="reg_address">
                                <textarea rows="6" id="reg_address" name="comment" style="max-width:3000px;padding:6px;" placeholder="แสดงความคิดเห็น" class="form-control col-sm-12"></textarea>
                            </div>
                        </div>
                    </div>

            </div>

            <div class="footer">
                <button href="<?php echo site_url() . "/swm/backend/Swm_status/show_status" ?>" style="margin-left:1cm" id="res" type="submit" class="btn btn-inverse btn_iserl tooltips pull-left" data-dismiss="modal"><span>ยกเลิก</span></button>
                <button name="id" value="<?php echo $test; ?>" style="margin-left:30cm" type="submit" name="id" class="btn btn-success btn_iserl tooltips" title="คลิกปุ่มเพื่อบันทึกข้อมูล">บันทึก</button>
            </div>

            <!-- <button name="id" value="<?php echo $test; ?>" style="margin-left:1250px" type="submit" name="id" class="btn btn-success btn_iserl tooltips" title="คลิกปุ่มเพื่อบันทึกข้อมูล">บันทึก</button> -->
            </form>
            

            <br><br>

        </div>
    </div>
    </div>
   
</body>

</html>