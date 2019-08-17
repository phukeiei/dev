<link rel="stylesheet" type="text/css"
    href="<?php echo base_url("application/views/ffm/frontend/for_test2/dist/bootstrap-clockpicker.min.css ");?>">
<link rel="stylesheet" type="text/css"
    href="<?php echo base_url("application/views/ffm/frontend/for_test2/assets/css/github.min.css ");?>">
<script type="text/javascript"
    src="<?php echo base_url("application/views/ffm/frontend/for_test2/dist/bootstrap-clockpicker.min.js ");?>">
</script>

<link href='<?php echo base_url()."application/views/ffm/frontend/packages/" ?>core/main.css' rel='stylesheet' />
<link href='<?php echo base_url()."application/views/ffm/frontend/packages/" ?>daygrid/main.css' rel='stylesheet' />
<link href='<?php echo base_url()."application/views/ffm/frontend/packages/" ?>timegrid/main.css' rel='stylesheet' />
<link href='<?php echo base_url()."application/views/ffm/frontend/packages/" ?>list/main.css' rel='stylesheet' />
<script src='<?php echo base_url()."application/views/ffm/frontend/packages/" ?>core/main.js'></script>
<script src='<?php echo base_url()."application/views/ffm/frontend/packages/" ?>interaction/main.js'></script>
<script src='<?php echo base_url()."application/views/ffm/frontend/packages/" ?>daygrid/main.js'></script>
<script src='<?php echo base_url()."application/views/ffm/frontend/packages/" ?>timegrid/main.js'></script>
<script src='<?php echo base_url()."application/views/ffm/frontend/packages/" ?>list/main.js'></script>
<Style>
    .autocomplete-block {
        position: absolute;
        width: 100%;
    }

    .autocomplete-list {
        list-style-type: none;
        padding: 3px;
        background-color: #FFF;
        position: absolute;
        z-index: 99;
        margin: 0px;
        margin-top: 22px;
        float: left;
        border: 1px solid #CCC;
        line-height: 23px;
    }

    .autocomplete-item a {
        color: #333;
        display: block;
        padding: 3px;
    }

    .autocomplete-item.active {
        color: #333;
        display: block;
        background-color: #EEF;
    }

    /* .autocomplete-list { position: absolute; cursor: default;z-index:9999 !important;} */
</style>

<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="wizard-container">
            <div class="card card-wizard active" data-color="primary" id="wizardProfile">
                <form action="<?php echo site_url('/ffm/frontend/C_test/insert_reservation_form');?>" method="POST"
                    novalidate="novalidate">
                    <!--        You can switch " data-color="primary" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
                    <div class="text-center">
                        <h3 class="card-title">
                            ตรวจสอบข้อมูล
                        </h3>

                    </div>
                    <div class="wizard-navigation">
                        <ul class="nav nav-pills">

                            <li class="nav-item" style="width: 24%;">
                                <a class="nav-link" href="#checking" data-toggle="tab" role="tab">
                                    ขั้นที่ 3
                                </a>
                            </li>


                        </ul>
                    </div>



                    <div class="card-body">
                        <div class="tab-content">
                            <div class="" id="person">
                                <h5> ข้อมูลส่วนบุคคล</h5>
                                <br>
                                <div class="row justify-content-center">

                                    <!-- คำนำหน้า -->
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        คำนำหน้า :
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="form-group bmd-form-group">
                                                    <label for="exampleInput1" class="bmd-label-floating">คำนำหน้าชื่อ
                                                    </label>
                                                    <input type="text" class="form-control required_check"
                                                        id="exampleInput1" name="fname" aria-required="true">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ชื่อ-นามสกุล -->
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        ชื่อ-นามสกุล :
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group bmd-form-group">
                                                    <label for="exampleInput1" class="bmd-label-floating">ชื่อ
                                                    </label>
                                                    <input type="text" class="form-control required_check"
                                                        id="exampleInput1" name="fname" aria-required="true">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group bmd-form-group">
                                                    <label for="exampleInput1" class="bmd-label-floating">นามสกุล
                                                    </label>
                                                    <input type="text" class="form-control required_check"
                                                        id="exampleInput1" name="lname" aria-required="true">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- เบอร์โทร -->
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        เบอร์ติดต่อ :
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group bmd-form-group">
                                                    <label for="exampleInput1" class="bmd-label-floating">เบอร์ติดต่อ
                                                    </label>
                                                    <input type="text" class="form-control required_check"
                                                        id="exampleInput1" name="phone" aria-required="true">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h5>ที่อยู่ปัจจุบัน</h5>
                                <br>
                                <div class="row justify-content-center">
                                    <!-- คำนำหน้า -->
                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-sm-1">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        ที่อยู่ :
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group bmd-form-group">
                                                    <label for="exampleInput1" class="bmd-label-floating">ที่อยู่
                                                    </label>
                                                    <input type="text" class="form-control required_check"
                                                        id="exampleInput1" name="adress" aria-required="true">
                                                </div>
                                            </div>
                                            <div class="col-sm-1">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        หมู่ :
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group bmd-form-group">
                                                    <label for="exampleInput1" class="bmd-label-floating">หมู่
                                                    </label>
                                                    <input type="text" class="form-control required_check"
                                                        id="exampleInput1" name="moo" aria-required="true">
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        รหัสไปรษณีย์ :
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group bmd-form-group">
                                                    <label for="exampleInput1" class="bmd-label-floating">รหัสไปรษณีย์
                                                    </label>
                                                    <input type="text" class="form-control" id="zipcode" name=""
                                                        aria-required="true" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-1">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        ตำบล :
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <!--<select class="selectpicker" data-style="select-with-transition"
                                                     title="ตำบล" data-size="7" tabindex="-98">
                                                </select>-->
                                                <div class="form-group bmd-form-group is-focused">
                                                    <label for="exampleInput1" class="bmd-label-floating">ตำบล
                                                    </label>
                                                    <input type="text" class="form-control autocomplete required_check"
                                                        id="dist_name" aria-required="true" get="get_address">
                                                    <input type="hidden" id="dist_id" name="dist_id">
                                                </div>
                                            </div>
                                            <div class="col-sm-1">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        อำเภอ :
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group bmd-form-group">
                                                    <label for="exampleInput1" class="bmd-label-floating">อำเภอ
                                                    </label>
                                                    <input type="text" class="form-control" id="amph_name"
                                                        aria-required="true" readonly>
                                                    <input type="hidden" id="amph_id" name="amph_id">

                                                </div>
                                            </div>
                                            <div class="col-sm-1">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        จังหวัด :
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group bmd-form-group">
                                                    <label for="exampleInput1" class="bmd-label-floating">จังหวัด
                                                    </label>
                                                    <input type="text" class="form-control" id="pv_name"
                                                        aria-required="true" readonly>
                                                    <input type="hidden" id="pv_id" name="pv_id">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="" id="field">
                                <h5> ข้อมูลการจองสนาม </h5>
                                <br>

                                <!-- คำนำหน้า -->
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    ชื่อโครงการ :
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group bmd-form-group">
                                                <label for="exampleInput1" class="bmd-label-floating">ขื่อโครงการ
                                                </label>
                                                <input type="text" class="form-control required_check"
                                                    id="exampleInput1" name="project" aria-required="true">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    สนาม :
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <select class="selectpicker" data-style="select-with-transition"
                                                data-size="7" tabindex="-98" id="ff_select" name="field">
                                                <?php foreach($qu_fleid as $row){?>
                                                <option value="<?php echo $row->ff_id;?>">
                                                    <?php echo $row->ff_name;?>
                                                </option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    วันที่ :
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group bmd-form-group is-filled">
                                                <input type="text" class="form-control datepicker-thai" id="date1"
                                                    name="date1" value="<?php echo getNowDateFwTh();?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    ถึง
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group bmd-form-group is-filled">
                                                <input type="text" class="form-control datepicker-thai" id="date2"
                                                    name="date2" value="<?php echo getNowDateFwTh();?>">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    เวลา :
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">

                                            <input type="radio" class="form-check-input" id="time1" name="time"
                                                aria-required="true" checked>กำหนดเอง
                                            <br>
                                            <input id="time1-1" name="time_start" class="clockpicker form-control"
                                                value="<?php echo date('H-I')?>" data-default="20:48">
                                            <input id="time1-2" name="time_end" class="clockpicker form-control"
                                                value="<?php echo date('H-I')?>" data-default="20:48">

                                            <input type="radio" class="form-check-input" id="time2" name="time"
                                                aria-required="true">ช่วงเช้า (09:00 - 12:00)
                                            <br>
                                            <input type="hidden" name="time_start" class="clockpicker form-control"
                                                value="9" data-default="20:48">
                                            <input type="hidden" name="time_end" class="clockpicker form-control"
                                                value="12" data-default="20:48">
                                            <input type="radio" class="form-check-input" id="time3" name="time"
                                                aria-required="true">ช่วงเย็น (13:00 - 16:00)
                                            <br>
                                            <input type="hidden" name="time_start" class="clockpicker form-control"
                                                value="13" data-default="20:48">
                                            <input type="hidden" name="time_end" class="clockpicker form-control"
                                                value="16" data-default="20:48">

                                            <input type="radio" class="form-check-input" id="time4" name="time"
                                                aria-required="true">ทั้งวัน (09:00 - 21:00)
                                            <br>
                                            <input type="hidden" name="time_start" class="clockpicker form-control"
                                                value="9" data-default="20:48">
                                            <input type="hidden" name="time_end" class="clockpicker form-control"
                                                value="21" data-default="20:48">
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    ราคา :
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group bmd-form-group">
                                                <label for="exampleInput1" class="bmd-label-floating">1-100
                                                </label>
                                                <input type="number" class="form-control" id="exampleInput1"
                                                    name="price" aria-required="true" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    บาท
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    จำนวน :
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group bmd-form-group">
                                                <label for="exampleInput1" class="bmd-label-floating">1-100
                                                </label>
                                                <input type="number" class="form-control required_check"
                                                    id="exampleInput1" name="total" aria-required="true">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    คน
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>


                            <div class="" style="display: none;" id="checking">
                                <h5> ข้อมูลส่วนบุคคล</h5>
                                <br>
                                <div class="row justify-content-center">

                                    <!-- คำนำหน้า -->
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        คำนำหน้า :
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="form-group bmd-form-group">
                                                    <label for="exampleInput1" class="bmd-label-floating">คำนำหน้าชื่อ
                                                    </label>
                                                    <input type="text" class="form-control required_check"
                                                        id="exampleInput1" name="fname" aria-required="true">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ชื่อ-นามสกุล -->
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        ชื่อ-นามสกุล :
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group bmd-form-group">
                                                    <label for="exampleInput1" class="bmd-label-floating">ชื่อ
                                                    </label>
                                                    <input type="text" class="form-control required_check"
                                                        id="exampleInput1" name="fname" aria-required="true">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group bmd-form-group">
                                                    <label for="exampleInput1" class="bmd-label-floating">นามสกุล
                                                    </label>
                                                    <input type="text" class="form-control required_check"
                                                        id="exampleInput1" name="lname" aria-required="true">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- เบอร์โทร -->
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        เบอร์ติดต่อ :
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group bmd-form-group">
                                                    <label for="exampleInput1" class="bmd-label-floating">เบอร์ติดต่อ
                                                    </label>
                                                    <input type="text" class="form-control required_check"
                                                        id="exampleInput1" name="phone" aria-required="true">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h5>ที่อยู่ปัจจุบัน</h5>
                                <br>
                                <div class="row justify-content-center">
                                    <!-- คำนำหน้า -->
                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-sm-1">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        ที่อยู่ :
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group bmd-form-group">
                                                    <label for="exampleInput1" class="bmd-label-floating">ที่อยู่
                                                    </label>
                                                    <input type="text" class="form-control required_check"
                                                        id="exampleInput1" name="adress" aria-required="true">
                                                </div>
                                            </div>
                                            <div class="col-sm-1">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        หมู่ :
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group bmd-form-group">
                                                    <label for="exampleInput1" class="bmd-label-floating">หมู่
                                                    </label>
                                                    <input type="text" class="form-control required_check"
                                                        id="exampleInput1" name="moo" aria-required="true">
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        รหัสไปรษณีย์ :
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group bmd-form-group">
                                                    <label for="exampleInput1" class="bmd-label-floating">รหัสไปรษณีย์
                                                    </label>
                                                    <input type="text" class="form-control" id="zipcode" name=""
                                                        aria-required="true" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-1">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        ตำบล :
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <!--<select class="selectpicker" data-style="select-with-transition"
                                                     title="ตำบล" data-size="7" tabindex="-98">
                                                </select>-->
                                                <div class="form-group bmd-form-group is-focused">
                                                    <label for="exampleInput1" class="bmd-label-floating">ตำบล
                                                    </label>
                                                    <input type="text" class="form-control autocomplete required_check"
                                                        id="dist_name" aria-required="true" get="get_address">
                                                    <input type="hidden" id="dist_id" name="dist_id">
                                                </div>
                                            </div>
                                            <div class="col-sm-1">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        อำเภอ :
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group bmd-form-group">
                                                    <label for="exampleInput1" class="bmd-label-floating">อำเภอ
                                                    </label>
                                                    <input type="text" class="form-control" id="amph_name"
                                                        aria-required="true" readonly>
                                                    <input type="hidden" id="amph_id" name="amph_id">

                                                </div>
                                            </div>
                                            <div class="col-sm-1">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        จังหวัด :
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group bmd-form-group">
                                                    <label for="exampleInput1" class="bmd-label-floating">จังหวัด
                                                    </label>
                                                    <input type="text" class="form-control" id="pv_name"
                                                        aria-required="true" readonly>
                                                    <input type="hidden" id="pv_id" name="pv_id">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="mr-auto">
                                <input type="button" class="btn btn-previous btn-fill btn-default btn-wd disabled"
                                    name="previous" value="Previous">
                            </div>
                            <div class="ml-auto">
                                <input type="button" class="btn btn-next btn-fill btn-primary btn-wd" name="next"
                                    id="next" value="Next">
                                <input type="submit" class="btn btn-finish btn-fill btn-success btn-wd" name="finish"
                                    value="Finish" style="display: none;">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>
</div>