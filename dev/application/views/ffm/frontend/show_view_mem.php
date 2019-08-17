<script>
function CheckNow() {
    $(".tab-pane.active").find('.required_check').each(function() {
        if ($(this).val() == "") {
            if (!$(this).parent().hasClass("has-danger")) {
                $(this).parent().addClass("has-danger")
                $(this).parent().append(
                    '<span class="form-control-feedback"><i class="material-icons">clear</i></span>');
            }
        }
    })
}
$(document).ready(function() {

    $(".required_check").on("click", function() {
        $(this).parent().removeClass("has-danger")
        $(this).parent().find(".form-control-feedback").remove()
    })
    $(".autocomplete").on("keydown", function(event) { //onkeydown
        switch (event.keyCode) {
            case 38: // up
                moveactive1(-1);
                break;
            case 40: // down
                moveactive1(1);
                break;
            case 9: // tab
                $(document).find(".autocomplete-block").each(function(index) {
                    acLink1(currentStep); //go to function acLink
                });
                break;
            case 13: // return
                event.cancelBubble = false; //stop event 
                event.returnValue = false; //
                $(document).find(".autocomplete-block").each(function(index) {
                    acLink1(currentStep); //go to function acLink
                });
                return false;
                break;
        }
        $(this).attr("autocomplete", "off"); //set attribute autocomplete=off
    }).on("keyup", function(event) { //onkeyup
        switch (event.keyCode) {
            case 38: // up
            case 40: // down
            case 9: // tab
            case 13: // return
                return;
        }
        obj = $(this);
        get = obj.attr("get"); //set get ,for append url
        key = obj.val(); //set key ,for search
        acStart($(this));

        url = "<?php echo site_url("/ffm/frontend/C_test/get_address");?>"; // get append url

        $.ajax({
            type: "POST",
            url: url,
            data: {
                q: key
            },
            dataType: "json",
            success: function(data, textStatus, jqXHR) {
                if (data != null && data != '') {
                    globaldata = data;
                    li = "";
                    $.each(data, function(i, item) {
                        li += "<li class=\"autocomplete-item\" onclick=\"acLink1(" +
                            i +
                            ")\"><a href=\"javascript:void(0);\">" + item
                            .dist_name + "<br>" + item.name +
                            "</a></li>"; // add to list autocomplete
                    });
                    $(".autocomplete-block").remove(); //delete block list autocomplete
                    if (li == "") { //if li not value -> stop
                        return;
                    }
                    obj.before(
                        "<div class=\"autocomplete-block\"><ul class=\"autocomplete-list\">" +
                        li + "</ul></div>"); //add list autocomplete to block 
                    $("li.autocomplete-item").first().addClass(
                        "active"); //li active at first row  
                    currentStep = 0; //first row -> currentStep = 0
                    // $('.autocomplete-block').css('position', 'absolute');
                    // $('.autocomplete-block').css('z-index', 99999999); 
                } else {

                    $(".autocomplete-block").remove(); //delete block list autocomplete
                }

            },
            error: function(xhr, status, error) {
                //alert ("Error: " + error);
                $(".autocomplete-block").remove(); //delete block list autocomplete
            }
        });

    });


});


function acLink1(id) {
    var data = globaldata[id];
    if (get == "get_address") { //-- กำหนด
        //set value in Author
        $("#dist_id").val(data.dist_id);
        $("#dist_name").val(data.dist_name);
        $("#pv_id").val(data.pv_id);
        $("#pv_name").val(data.pv_name);
        $("#pv_name").parent().addClass("is-focused");
        $("#amph_id").val(data.amph_id);
        $("#amph_name").val(data.amph_name);
        $("#amph_name").parent().addClass("is-focused");
        $("#zipcode").val(data.dist_pos_code);
        $("#zipcode").parent().addClass("is-focused");
    }
    /*else if(get == "get_address2"){	//-- กำหนด
    			//set value in Author
    			$("#psd_addcur_dist_id").val(data.dist_id);
    			$("#psd_cur_dist_id").val(data.dist_name);
    			$("#psd_addcur_amph_id").val(data.amph_id);
    			$("#psd_cur_amph_id").val(data.amph_name);
    			$("#psd_addcur_pv_id").val(data.pv_id);
    			$("#psd_cur_pv_id").val(data.pv_name);
    			$("#psd_addcur_zipcode").val(data.dist_pos_code);
    		}*/
    $(".autocomplete-block").remove();
}

function acStart(obj) {
    if (get == "get_place") { //-- เคลียร์
        acdau_ps_id = $("#place_name").val();
        if (acdau_ps_id == 0) {
            $("#ps_place1").val("");
        }
    } else if (get == "get_place2") { //-- เคลียร์
        acdau_ps_id = $("#place2").val();
        if (acdau_ps_id == 0) {
            $("#ps_place2").val("");
        }
    }
}

function moveactive1(step) {
    if (step == -1 && currentStep == 0) {
        return false;
    }
    if (step == 1 && currentStep == numrow - 2) {
        return false;
    }
    currentStep = currentStep + step;
    $("li.autocomplete-item").removeClass("active");
    $("li.autocomplete-item:eq(" + currentStep + ")").addClass("active");
}
</script>
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
                <form action=" <?php echo site_url('/ffm/frontend/C_reservation/insert_reservation_form');?> " method="POST"
                    novalidate="novalidate">
                    <!--        You can switch " data-color="primary" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
                    <div class="text-center">
                        <h3 class="card-title">
                            แบบฟอร์มกรอกข้อมูล
                        </h3>
                        <h5 class="card-description">สำหรับทำการจองสนามฟุตบอล</h5>
                    </div>
                    <div class="wizard-navigation">
                        <ul class="nav nav-pills">
                            <li class="nav-item" style="width: 23%;">
                                <a class="nav-link active" href="#person" data-toggle="tab" role="tab">
                                    ขั้นที่ 1
                                </a>
                            </li>
                            <li class="nav-item" style="width: 23%;">
                                <a class="nav-link" href="#field" data-toggle="tab" role="tab">
                                    ขั้นที่ 2
                                </a>
                            </li>
                            <li class="nav-item" style="width: 23%;">
                                <a class="nav-link" href="#checking" data-toggle="tab" role="tab">
                                    ขั้นที่ 3
                                </a>
                            </li>
                            <li class="nav-item" style="width: 23%;">
                                <a class="nav-link" href="#download" data-toggle="tab" role="tab">
                                    ขั้นที่ 4
                                </a>
                            </li>

                        </ul>
                        <div class="moving-tab"
                            style="width: 370px; transform: translate3d(-8px, 0px, 0px); transition: transform 0s ease 0s;">
                            1. About
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="person">
                                <h5> กรอกข้อมูลส่วนบุคคล</h5>
                                <br>
                                <div class="row justify-content-center">
                                    <div class="col-md-4">
                                        <div class="picture-container">
                                            <img src='<?PHP echo site_url("hr/getIcon?type=picturePerson&image=".$picture) ;?>'
                                                class=" picture-src" id="wizardPicturePreview" title="">

                                        </div>
                                    </div>
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
                                                <select class="selectpicker" data-style="select-with-transition"
                                                    title="คำนำหน้า" data-size="7" tabindex="-98">
                                                    <option disabled=""> คำนำหน้า</option>
                                                    <?php 	foreach($rs_Ms as $row){	
								                               
								                            ?>
                                                    <option value="<?php echo $row->pf_id;?>" <?php  echo $selected;?>>
                                                        <?php echo $row->pf_name;?>
                                                    </option>
                                                    <?php 	}	?>
                                                </select>
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
                                                    <label for="exampleInput1" class="bmd-label-floating">ขื่อ
                                                    </label>
                                                    <input type="text" class="form-control" id="exampleInput1"
                                                        name="fname" aria-required="true"
                                                        value="<?php echo $rs_Ms->ps_fname;?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group bmd-form-group">
                                                    <label for="exampleInput1" class="bmd-label-floating">นามสกุล
                                                    </label>
                                                    <input type="text" class="form-control" id="exampleInput1"
                                                        name="lname" aria-required="true"
                                                        value="<?php echo $rs_Ms->ps_lname;?>" readonly>
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
                                                    <input type="text" class="form-control" id="exampleInput1"
                                                        name="phone" aria-required="true">
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
                                                    <input type="text" class="form-control" id="exampleInput1"
                                                        name="adress" aria-required="true"
                                                        value="<?php echo $rs_Ms->psd_addhome_no;?>" readonly>
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
                                                    <input type="text" class="form-control" id="exampleInput1"
                                                        name="moo" aria-required="true"
                                                        value="<?php echo $rs_Ms->ps_lname;?>" readonly>
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
                                                        aria-required="true"
                                                        value="<?php echo $rs_Ms->psd_addhome_zipcode;?>" readonly>
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
                                                    <input type="text" class="form-control autocomplete" id="dist_name"
                                                        aria-required="true" get="get_address"
                                                        value="<?php echo $rs_Ms->dist_name;?>" readonly>
                                                    <input type="hidden" id="dist_id" name="dist_id"
                                                        value="<?php echo $rs_Ms->dist_id;?>">
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
                                                        aria-required="true" value="<?php echo $rs_Ms->amph_name;?>"
                                                        readonly>
                                                    <input type="hidden" id="amph_id" name="amph_id"
                                                        value="<?php echo $rs_Ms->amph_id;?>">

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
                                                        aria-required="true" value="<?php echo $rs_Ms->pv_name;?>"
                                                        readonly>
                                                    <input type="hidden" id="pv_id" name="pv_id"
                                                        value="<?php echo $rs_Ms->pv_id;?>">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="field">
                                <h5> ข้อมูลการจองสนาม </h5>
                                <br>
                                <div class="row justify-content-center">
                                    <div class="col-md-4">
                                        <div class="picture-container">

                                        </div>
                                    </div>
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
                                                    <input type="text" class="form-control" id="exampleInput1"
                                                        name="project" aria-required="true">
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
                                                    title="สนาม" data-size="7" tabindex="-98" id="field" name="field">
                                                    <?php foreach($qu_fleid as $row){?>
                                                    <option value="<?php echo $row->ff_id;?>">
                                                        <?php echo $row->ff_name;?></option>
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
                                                    <input type="text" class="form-control datepicker-ffm" id="time"
                                                        name="date" value="<?php echo getNowDateFwTh();?>">
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
                                                    <input type="text" class="form-control datepicker-ffm" id="date2"
                                                        value="<?php echo getNowDateFwTh();?>">
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
                                                <input type="radio" class="form-check-input" id="" name="time"
                                                    aria-required="true">กำหนดเอง<br>
                                                <input type="radio" class="form-check-input" id="" name="time"
                                                    aria-required="true">ช่วงเช้า (09:00 - 12:00)<br>
                                                <input type="radio" class="form-check-input" id="" name="time"
                                                    aria-required="true">ช่วงเย็น (13:00 - 16:00)<br>
                                                <input type="radio" class="form-check-input" id="" name="time"
                                                    aria-required="true">ทั้งวัน (09:00 - 16:00)<br>
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
                                                    <input type="number" class="form-control" id="exampleInput1"
                                                        name="total" aria-required="true">
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
                            </div>

                        </div>
                        <div class="card-footer">
                            <div class="mr-auto">
                                <input type="button" class="btn btn-previous btn-fill btn-default btn-wd disabled"
                                    name="previous" value="Previous">
                            </div>
                            <div class="ml-auto">
                                <input type="button" class="btn btn-next btn-fill btn-primary btn-wd" name="next"
                                    value="Next">
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