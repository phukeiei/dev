<!--
* v_regis-form
* Display register form
* @input    Referrent user detail 
* @output   User detail
* @author   Supak Pukdam
* @Update   Supak Pukdam
* @Update Date  2562-05-17
-->
<script>
    /*
    1. name="reg_address"
    2. name="reg_changwat"
    3. name="reg_ampere"
    4. name="reg_tumbon"
    5. name="reg_ref_fname"
    6. name="reg_ref_lname"
    7. name="reg_ref_tel"
    */
    $(document).ready(function() {

        $('#res').click(function() {
            $('#form_main').trigger("reset");
        })

        function validateForm() {
            let statusForm = 0;
            
            
           
          
            var reg_ref_fname = document.forms["myForm3"]["reg_ref_fname"].value;
            var reg_ref_lname = document.forms["myForm3"]["reg_ref_lname"].value;
            var reg_ref_tel = document.forms["myForm3"]["reg_ref_tel"].value;
            var reg_date = document.forms["myForm1"]["reg_date"].value;
            var reg_job = document.forms["myForm1"]["reg_job"].value;
            var reg_p_job = document.forms["myForm1"]["reg_p_job"].value; 

            if (reg_date == "") {
                $('.reg_date').addClass('selected')
                statusForm++;
            }
            
            if (reg_ref_fname == "") {
                //alert("การุณากรอกชื่อคนอ้างอิง")
                $('#reg_ref_fname').attr("placeholder", "การุณากรอกชื่อคนอ้างอิง");
                $('#reg_ref_fname').addClass('selected')
                // $('#reg_ref_fname').addClass('highlight')
                statusForm++;
            }
            if (reg_p_job == "") {
                //alert("การุณากรอกชื่อคนอ้างอิง")
                $('#reg_p_job').attr("placeholder", "การุณากรอกสถานที่ทำงาน");
                $('#reg_p_job').addClass('selected')
                // $('#reg_ref_fname').addClass('highlight')
                statusForm++;
            }
            if (reg_ref_lname == "") {
                //alert("การุณากรอกนามสกุลคนอ้างอิง")
                $('#reg_ref_lname').attr("placeholder", "การุณากรอกนามสกุลคนอ้างอิง");
                $('#reg_ref_lname').addClass('selected')
                // $('#reg_ref_lname').addClass('highlight')
                statusForm++;
            }
            if (reg_ref_tel == "") {
                //alert("การุณากรอกเบอร์โทรศัพท์คนอ้างอิง")
                $('#reg_ref_tel').attr("placeholder", "การุณากรอกเบอร์โทรศัพท์คนอ้างอิง");
                $('#reg_ref_tel').addClass('selected')
                // $('#reg_ref_tel').addClass('highlight')
                statusForm++;
            }
            if (reg_job == "") {
                //alert("การุณากรอกเบอร์โทรศัพท์คนอ้างอิง")
                $('#reg_job').attr("placeholder", "การุณากรอกอาชีพ");
                $('#reg_job').addClass('selected')
                // $('#reg_ref_tel').addClass('highlight')
                statusForm++;
            }
            if (statusForm != 0) {
                return false;
            } else {
                return true;
            }
        }
        let checkForm
        console.log(checkForm)
        $('#sub').click(function() {
            checkForm = validateForm();
        })
        console.log(checkForm)
        $(".reg_date").change(function() {
            $('.reg_date').removeClass('selected')
        })

        $("#reg_address").keydown(function() {
            $('#reg_address').removeClass('selected')
        })
        $("#reg_ref_fname").keydown(function() {
            $('#reg_ref_fname').removeClass('selected')
        })

        $("#reg_ref_lname").keydown(function() {
            $('#reg_ref_lname').removeClass('selected')
        })

        $("#reg_ref_tel").keydown(function() {
            $('#reg_ref_tel').removeClass('selected')
        })
        $("#reg_job").keydown(function() {
            $('#reg_job').removeClass('selected')
        })
        $("#reg_p_job").keydown(function() {
            $('#reg_p_job').removeClass('selected')
        })
        
        $('#sub').on('click', function() {
            let arr = $('#frm').find('input,select').serializeArray()

            $(arr).each(function(ind, val) {
                // console.log($('#hid-frm'))
                $('#hid-frm').append('<input type="hidden" name="' + val.name + '" value="' + val.value + '"/>')
            })
            console.log(validateForm())
            if (validateForm()){
                $('#hid-frm').submit()
            }else{
                alert("การุณากรอกข้อมูลให้ครบ")
            }
          
        })

    })
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

<style>
    #title {
        color: #707070;
    }
</style>

<?php
$key = $qu_user[0];
?>
<div class="col-md-12">

    <div class="page-content ng-scope" ng-view="">
        <ol class="breadcrumb ng-scope">
            <li class="active">ระบบศูนย์นันทนาการสระว่ายน้ำ</li>
            <li><a href="#/">หน้าแรก</a></li>
            <li><a href="#/">เมนูผู้ดูแลระบบ</a></li>
            <li><a href="#/">สมัครสมาชิก</a></li>
            <li><a href="#/">ค้นหาผู้ใช้งาน</a></li>
            <li><a href="#/">แบบฟอร์มสมัครสามชิก</a></li>
        </ol>



        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading panel_heading_iserl">
                    <h2>แบบฟอร์มสมัครสมาชิก</h2>
                </div>
                <div class="panel-body">

                    <section id="frm">
                        <div class="col-md-12">
                            <div class="panel-body">
                                <div class="panel panel-default">
                                    <div class="panel-heading panel_heading_sub_iserl">
                                        <h2>ข้อมูลส่วนตัว</h2>
                                        <div class="tooltips panel_tap_iserl" title='' data-actions-container="" data-action-collapse='{"target": ".panel-body"}'>
                                        </div>
                                    </div>
                                    <br>

                                    <form name="myForm1" class="form-horizontal row-border">

                                        <div class="form-group">
                                            <label id="title" class="col-sm-2 control-label">วันที่สมัคร&nbsp;&nbsp;&nbsp;:</label>
                                            <div class="col-sm-4">
                                                <input id="reg_date" style="padding:6px;" name="reg_date" class="form-control reg_date datepicker-thai">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label id="title" class="col-sm-2 control-label">คำนำหน้าชื่อ&nbsp;&nbsp;&nbsp;:</label>
                                            <div class="col-sm-9">
                                                <label class="col-sm-2" style="max-width:200px;padding:6px;"><?php echo $key->pf_name; ?></label>
                                                <label class="col-sm-5 control-label">ชื่อ-นามสกุล&nbsp;&nbsp;&nbsp;:</label>
                                                <label class="col-sm-2" style="max-width:200px;padding:6px;"><?php echo $key->ps_fname; ?></label>
                                                <label class="col-sm-2" style="max-width:200px;padding:6px;"><?php echo $key->ps_lname; ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label id="title" class="col-sm-2 control-label">วันเกิด&nbsp;&nbsp;&nbsp;:</label>
                                            <div class="col-sm-9">
                                                <label class="col-sm-6 " style="max-width:200px;padding:6px;"><?php if ($key->psd_birthdate == "-") {
                                                                                                                    echo $key->psd_birthdate;
                                                                                                                } else {
                                                                                                                    echo abbreDate2($key->psd_birthdate);
                                                                                                                }
                                                                                                                ?></label>
                                                <label id="title" class="col-sm-4 control-label">&nbsp;&nbsp;&nbsp;อายุ&nbsp;&nbsp;&nbsp;:</label>
                                                <label class="col-sm-6" style="max-width:200px;padding:6px;"><?php echo $key->age; ?>&nbsp;&nbsp;ปี</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label id="title" class="col-sm-2 control-label">อาชีพ&nbsp;&nbsp;&nbsp;:</label>
                                            <div class="col-sm-4">
                                                <input placeholder="นักศึกษา" id="reg_job" name="reg_job" type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label id="title" class="col-sm-2 control-label">สถานที่ทำงาน&nbsp;&nbsp;&nbsp;:</label>
                                            <div class="col-sm-4">
                                                <input placeholder="มหาวิทยาลัยบูรพา" id="reg_p_job" name="reg_p_job" type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label id="title" class="col-sm-2 control-label">เบอร์โทรศัพท์&nbsp;&nbsp;&nbsp;:</label>
                                            <div class="col-sm-6">
                                                <label class="col-sm-6" style="max-width:200px;padding:6px;"><?php echo $key->psd_cellphone; ?></label>
                                            </div>
                                        </div>
                                        <div>
                                            <!--เอาไว้จัดหน้า-->
                                        </div>
                                    </form>
                                </div>


                                <div class="panel panel-default">
                                    <div class="panel-heading panel_heading_sub_iserl">
                                        <h2>ที่อยู่ปัจจุบัน</h2>
                                        <div class="tooltips panel_tap_iserl" title='' data-actions-container="" data-action-collapse='{"target": ".panel-body"}'>
                                        </div>
                                    </div>
                                    <br>

                                    <form class="form-horizontal row-border" name="myForm2">

                                        <div class="form-group">
                                            <label id="title" class="col-sm-2 control-label">ที่อยู่&nbsp;&nbsp;&nbsp;:</label>
                                            <div class="col-sm-8">
                                                <div id="reg_address" name="reg_address">
                                                <label class="col-sm-6" style="max-width:200px;padding:6px;"><?php echo $key->psd_addcur_no; ?></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label id="title" class="col-sm-2 control-label">จังหวัด&nbsp;&nbsp;&nbsp;:</label>

                                            <div class="col-sm-6">
                                                <label class="col-sm-6" style="max-width:200px;padding:6px;"><?php echo $key->pv_name; ?></label>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label id="title" class="col-sm-2 control-label">อำเภอ&nbsp;&nbsp;&nbsp;:</label>
                                            <div class="col-sm-6">
                                                <label class="col-sm-6" style="max-width:200px;padding:6px;"><?php echo $key->amph_name; ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label id="title" class="col-sm-2 control-label">ตำบล&nbsp;&nbsp;&nbsp;:</label>
                                            <div class="col-sm-6">
                                                <label class="col-sm-6" style="max-width:200px;padding:6px;"><?php echo $key->dist_name; ?></label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label id="title" class="col-sm-2 control-label">รหัสไปรษณีย์&nbsp;&nbsp;&nbsp;:</label>
                                            <div class="col-sm-6">
                                                <label class="col-sm-6" style="max-width:200px;padding:6px;"><?php echo $key->psd_addcur_zipcode; ?></label>
                                            </div>
                                        </div>

                                        <div>
                                            <!--เอาไว้จัดหน้า-->

                                        </div>
                                    </form>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading panel_heading_sub_iserl">
                                        <h2>ข้อมูลบุคคลอ้างอิง</h2>
                                        <div class="tooltips panel_tap_iserl" title='' data-actions-container="" data-action-collapse='{"target": ".panel-body"}'>
                                        </div>
                                    </div>
                                    <br>

                                    <form class="form-horizontal row-border" name="myForm3">

                                        <div class="form-group">
                                            <label id="title" class="col-sm-2 control-label">คำนำหน้าชื่อ&nbsp;&nbsp;&nbsp;:</label>
                                            <div class="col-sm-8">
                                                <select name="reg_prefix" id="reg_prefix" class="form-control">
                                                    <?php
                                                    foreach ($rs_prefix as $pf) {
                                                        ?>
                                                        <option value="<?php echo $pf['pf_id']; ?>"><?php echo $pf['pf_name']; ?></option>
                                                    <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label id="title" class="col-sm-2 control-label">ชื่อ&nbsp;&nbsp;&nbsp;:</label>
                                                <div class="col-sm-8">
                                                    <input placeholder="สมชาย" id="reg_ref_fname" name="reg_ref_fname" type="text" class="form-control" name="dfname">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label id="title" class="col-sm-2 control-label">นามสกุล&nbsp;&nbsp;&nbsp;:</label>
                                                <div class="col-sm-8">
                                                    <input placeholder="ใจดี" id="reg_ref_lname" name="reg_ref_lname" type="text" class="form-control" name="dlname">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label id="title" class="col-sm-2 control-label">เบอร์โทรศัพท์&nbsp;&nbsp;&nbsp;:</label>
                                                <div class="col-sm-8">
                                                    <input placeholder="0668750355" id="reg_ref_tel" name="reg_ref_tel" type="text" class="form-control" name="dtel">
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
                                <input type="hidden" name="ps_id" value="<?php echo ($key->ps_id != '') ? $key->ps_id : ''; ?>" />
                                <button id="res" type="reset" class="btn btn-inverse btn_iserl tooltips pull-left" data-dismiss="modal"><span>เคลียร์</span></button>
                                <input type="hidden" name="psd_birthdate;" value="<?php echo $key->psd_birthdate; ?>" />

                                <button id="sub" type="submit" class="btn btn-success btn_iserl tooltips pull-right" data-dismiss="modal"><span>บันทึก</span></button>
                            </div> 
                    </div>
                </div>
                <!---------------------------------------panelbodyนอก------------------------------------------------->
            </div>
            </section>
            <form id="hid-frm" method="post" action="<?php echo site_url() . '/swm/backend/Swm_register/insert_person'; ?>">
            </form>