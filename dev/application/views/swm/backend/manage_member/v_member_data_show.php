<!--
* v_edit_member
* Display Edit form
* @input  fname_ref,lname_ref,regis_job
* @output data user
* @author Kanathip Phithaskilp
* @Update Kanathip Phithaksilp
* @Update Date  2562-05-19
-->

<script>
    $(document).ready(function() {

        $('#res').click(function() {
            $('#form_main').trigger("reset");
        })
        let checkForm
        $("#regis_job").keyup(function() {
            $('#regis_job').removeClass('selected')
        })
        $("#fname_ref").keyup(function() {
            $('#fname_ref').removeClass('selected')
        })
        $("#lname_ref").keyup(function() {
            $('#lname_ref').removeClass('selected')
        })
        $("#tel_ref").keyup(function() {
            $('#tel_ref').removeClass('selected')
        })

        $("#sub").on('click', function() {
            $('#checkid').val()
            $('#cjob').val($('#regis_job').val());
            $('#clname').val($('#lname_ref').val());
            $('#cfname').val($('#fname_ref').val());
            $('#ctel').val($('#tel_ref').val());

            if (validateForm()) {
                $('#update').submit();
            }
        })


    })

    function validateForm() {

        let statusForm = 0;
        var regis_job = document.forms["form-1"]["regis_job"].value;
        var fname_ref = document.forms["form-3"]["fname_ref"].value;
        var lname_ref = document.forms["form-3"]["lname_ref"].value;
        var tel_ref = document.forms["form-3"]["tel_ref"].value;

        if (regis_job == "") {
            $('#regis_job').attr("placeholder", "กรุณากรอกอาชีพ");
            $('#regis_job').addClass('selected');
            statusForm++;
        }
        if (fname_ref == "") {
            $('#fname_ref').attr("placeholder", "กรุณากรอกชื่อบุคคลอ้างอิง");
            $('#fname_ref').addClass('selected');
            statusForm++;
        }
        if (lname_ref == "") {
            $('#lname_ref').attr("placeholder", "กรุณากรอกนามสกุลบุคคลอ้างอิง");
            $('#lname_ref').addClass('selected');
            statusForm++;
        }
        if (tel_ref == "") {
            $('#tel_ref').attr("placeholder", "กรุณากรอกเบอร์บุคคลอ้างอิง");
            $('#tel_ref').addClass('selected');
            statusForm++;
        }
        if (statusForm != 0) {
            alert("กรุณากรอกข้อมูลให้ครบ")
            return false;
        }
        if (statusForm == 0) {
            return true;
        }

    }
</script>

<style>
    .selected {
        background-color: rgb(251, 232, 229);
        border-color: rgb(246, 153, 136);
        color: rgb(246, 153, 136);
    }

    .highlight {
        border: 2px solid red;
    }
</style>
<?php $value = $show[0]; ?>
<div class="col-md-12">

    <div class="page-content ng-scope" ng-view="">
        <ol class="breadcrumb ng-scope">
            <li class="active">ระบบศูนย์นันทนาการสระว่ายน้ำ &nbsp</li>
            <li><a href="#/">หน้าแรก &nbsp</a></li>
            <li><a href="#/">เมนูผู้ดูแลระบบ &nbsp</a></li>
            <li><a href="#/">สมัครสมาชิก &nbsp</a></li>
            <li><a href="#/">ค้นหาผู้ใช้งาน &nbsp</a></li>
            <li><a href="#/">แบบฟอร์มสมัครสามชิก</a></li>
        </ol>

        <!DOCTYPE html>
        <html lang="en">

        <head>

            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Register</title>

        </head>

        <body>


            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-info card-header-text">
                        <div class="card-text">
                            <h2>แบบฟอร์มสมัครสมาชิก</h2>
                        </div>
                        <div class="panel-body">


                            <div class="col-md-12">
                                <div class="panel-body">
                                    <div class="panel panel-default">
                                        <div class="panel-heading panel_heading_sub_iserl">
                                            <h2 style="color:black;">ข้อมูลส่วนตัว</h2>
                                            <div class="tooltips panel_tap_iserl" title='' data-actions-container="" data-action-collapse='{"target": ".panel-body"}'>
                                            </div>
                                        </div>
                                        <br>


                                        <form class="form-horizontal row-border" name="form-1" action='#'>

                                            <div class="form-group">
                                                <div class="row">
                                                    <label id="title" class="col-sm-2 control-label">วันที่สมัคร&nbsp;&nbsp;&nbsp;:</label>
                                                    <div class="col-sm-4">
                                                        <span>
                                                            <label class="col-sm-4" style="max-width:200px;padding:6px;"><?php echo  abbreDate2($value['regdate']); ?></label>

                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label id="title" class="col-sm-2 control-label">คำนำหน้าชื่อ&nbsp;&nbsp;&nbsp;:</label>
                                                    <div class="col-sm-9">
                                                        <label class="col-sm-2" style="max-width:200px;padding:6px;"><?php echo  $value['prefix']; ?></label>
                                                        <label id="title" class="col-sm-2 control-label">ชื่อ-นามสกุล&nbsp;&nbsp;&nbsp;:</label>
                                                        <label class="col-sm-2" style="max-width:200px;padding:6px;"> <?php echo $value['fname'] . " " . $value['lname']; ?></label>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <label id="title" class="col-sm-2 control-label">วันเกิด&nbsp;&nbsp;&nbsp;:</label>
                                                    <div class="col-sm-9">
                                                        <label class="col-sm-6" style="max-width:200px;padding:6px;"><?php echo  abbreDate2($value['birthday']); ?></label>
                                                        <label id="title" class="col-sm-2 control-label">&nbsp;&nbsp;&nbsp;อายุ&nbsp;&nbsp;&nbsp;:</label>
                                                        <label class="col-sm-6" style="max-width:200px;padding:6px;"><?php echo  calAge3($value['birthday']); ?> &nbsp;&nbsp;ปี</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <label id="title" class="col-sm-2 control-label">อาชีพ&nbsp;&nbsp;&nbsp;:</label>
                                                    <div class="col-sm-6">
                                                        <label class="col-sm-6" style="max-width:200px;padding:6px;"><?php echo $value['job']; ?></label>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <label id="title" class="col-sm-2 control-label">เบอร์โทรศัพท์&nbsp;&nbsp;&nbsp;:</label>
                                                    <div class="col-sm-6">
                                                        <label class="col-sm-6" style="max-width:200px;padding:6px;"><?php echo $value['tel']; ?></label>
                                                    </div>
                                                </div>
                                                <div>
                                                    <!--เอาไว้จัดหน้า-->
                                                </div>
                                        </form>
                                    </div>


                                    <div class="panel panel-default">
                                        <div class="panel-heading panel_heading_sub_iserl">
                                            <div class="row">
                                                <h2 style="color:black;">ที่อยู่ปัจจุบัน</h2>
                                                <div class="tooltips panel_tap_iserl" title='' data-actions-container="" data-action-collapse='{"target": ".panel-body"}'>
                                                </div>
                                            </div>
                                            <br>

                                            <form class="form-horizontal row-border">

                                                <div class="form-group">
                                                    <div class="row">
                                                        <label id="title" class="col-sm-2 control-label">ที่อยู่&nbsp;&nbsp;&nbsp;:</label>
                                                        <div class="col-sm-8">
                                                            <div id="reg_address_border" class="">
                                                                <label class="col-sm-6" style="max-width:200px;padding:6px;"><?php echo $value['addr']; ?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <label id="title" class="col-sm-2 control-label">จังหวัด&nbsp;&nbsp;&nbsp;:</label>
                                                        <div class="col-sm-8">
                                                            <label class="col-sm-6" style="max-width:200px;padding:6px;"><?php echo $value['province']; ?></label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <label id="title" class="col-sm-2 control-label">อำเภอ&nbsp;&nbsp;&nbsp;:</label>
                                                        <div class="col-sm-8">
                                                            <label class="col-sm-6" style="max-width:200px;padding:6px;"><?php echo $value['amphor']; ?></label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <label id="title" class="col-sm-2 control-label">ตำบล&nbsp;&nbsp;&nbsp;:</label>
                                                        <div class="col-sm-8">
                                                            <label class="col-sm-6" style="max-width:200px;padding:6px;"><?php echo $value['dist']; ?></label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <label id="title" class="col-sm-2 control-label">รหัสไปรษณีย์&nbsp;&nbsp;&nbsp;:</label>
                                                        <div class="col-sm-8">
                                                            <label class="col-sm-6" style="max-width:200px;padding:6px;"><?php echo $value['zipcode']; ?></label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>
                                                    <!--เอาไว้จัดหน้า-->

                                                </div>
                                            </form>
                                        </div>

                                        <div class="panel panel-default">
                                            <div class="panel-heading panel_heading_sub_iserl">
                                                <h2 style="color:black;">ข้อมูลบุคคลอ้างอิง</h2>
                                                <div class="tooltips panel_tap_iserl" title='' data-actions-container="" data-action-collapse='{"target": ".panel-body"}'>
                                                </div>
                                            </div>
                                            <br>

                                            <form class="form-horizontal row-border" name="form-3">

                                                <div class="form-group">
                                                    <div class="row">
                                                        <label id="title" class="col-sm-2 control-label">ชื่อ&nbsp;&nbsp;&nbsp;:</label>
                                                        <div class="col-sm-8">
                                                            <label class="col-sm-6" style="max-width:200px;padding:6px;"><?php echo $value['cfname']; ?></label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <label id="title" class="col-sm-2 control-label">นามสกุล&nbsp;&nbsp;&nbsp;:</label>
                                                        <div class="col-sm-8">
                                                            <label class="col-sm-6" style="max-width:200px;padding:6px;"><?php echo $value['clname']; ?></label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <label id="title" class="col-sm-2 control-label">เบอร์โทรศัพท์&nbsp;&nbsp;&nbsp;:</label>
                                                        <div class="col-sm-8">
                                                            <label class="col-sm-6" style="max-width:200px;padding:6px;"><?php echo $value['ctel']; ?></label>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div>
                                                    <!--เอาไว้จัดหน้า-->

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!---------------------------------------panelbodyใน------------------------------------------------->
                                <div class="modal-footer">
                                    <a href="<?php echo site_url() . "/swm/backend/Swm_manage_member/member_table_show" ?>" class="btn btn-inverse btn_iserl tooltips pull-left" data-dismiss="modal">ยกเลิก</a>


                                </div>
                            </div>
                        </div>
                        <!---------------------------------------panelbodyนอก------------------------------------------------->
                    </div>
                    <form id="update" action="<?php echo site_url() . '/swm/backend/Swm_manage_member/member_data_update'; ?>" method="post">
                        <input type="hidden" id="checkid" value="<?php echo $value['su_id']; ?>" name="checkid">
                        <input type="hidden" id="cjob" name="cjob">
                        <input type="hidden" id="cfname" name="cfname">
                        <input type="hidden" id="clname" name="clname">
                        <input type="hidden" id="ctel" name="ctel">
                    </form>