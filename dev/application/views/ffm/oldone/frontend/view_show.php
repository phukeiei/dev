<link rel="stylesheet" type="text/css" href="<?php echo base_url("application/views/ffm/frontend/for_test2/dist/bootstrap-clockpicker.min.css ");?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url("application/views/ffm/frontend/for_test2/assets/css/github.min.css ");?>">
<script type="text/javascript" src="<?php echo base_url("application/views/ffm/frontend/for_test2/dist/bootstrap-clockpicker.min.js ");?>"></script>

<link href='<?php echo base_url()."application/views/ffm/frontend/packages/" ?>core/main.css' rel='stylesheet' />
<link href='<?php echo base_url()."application/views/ffm/frontend/packages/" ?>daygrid/main.css' rel='stylesheet' />
<link href='<?php echo base_url()."application/views/ffm/frontend/packages/" ?>timegrid/main.css' rel='stylesheet' />
<link href='<?php echo base_url()."application/views/ffm/frontend/packages/" ?>list/main.css' rel='stylesheet' />
<script src='<?php echo base_url()."application/views/ffm/frontend/packages/" ?>core/main.js'></script>
<script src='<?php echo base_url()."application/views/ffm/frontend/packages/" ?>interaction/main.js'></script>
<script src='<?php echo base_url()."application/views/ffm/frontend/packages/" ?>daygrid/main.js'></script>
<script src='<?php echo base_url()."application/views/ffm/frontend/packages/" ?>timegrid/main.js'></script>
<script src='<?php echo base_url()."application/views/ffm/frontend/packages/" ?>list/main.js'></script>
<script>
    $(document).ready(function() {
        
        $("#ff_select").on("change", function() {
            var word = $(this).val()
            $("#name-ff").html("ปฏิทิน" + $('#ff_select option[value=' + word + ']').text())
            calldata()
        });
         $("#ff_select").change();
    });

    function addZero(num) {
        if (num < 10) {
            return "0" + num
        } else {
            return num;
        }
    }


    function calldata() {
        $("#calendar").empty()
        var value = $("#ff_select").val();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo site_url('/ffm/frontend/C_test/get'); ?>",
            data: {
                fr_ff_id: value
            },
            success: function(data) {
                var obj = [];
                console.log(data)
                data.forEach(function(row) {
                    var date1 = new Date(row.fr_start_date)
                    var date2 = new Date(row.fr_end_date)
                    var diffTime = Math.abs(date2.getTime() - date1.getTime())
                    var diffDay = Math.ceil(diffTime / (1000 * 60 * 60 * 24))
                    for (var i = 0; i <= diffDay; i++) {
                        obj.push({
                            title: row.pf_name + row.fr_first_name + " " + row.fr_last_name,
                            start: date1.getFullYear() + "-" + addZero(date1.getMonth()) + "-" + date1.getDate() + "T" + row.fr_start_time,
                            end: date1.getFullYear() + "-" + addZero(date1.getMonth()) + "-" + date1.getDate() + "T" + row.fr_end_time,
                            color: "rgb(198,239,206)",
                            textColor: "#ff0000",

                            ad_start: date1.getFullYear() + "-" + addZero(date1.getMonth()) + "-" + date1.getDate(),
                            ad_end: date1.getFullYear() + "-" + addZero(date1.getMonth()) + "-" + date1.getDate(),
                            at_start: row.fr_start_time,
                            at_end: row.fr_end_time
                        });
                        console.log(date1.getFullYear() + "-" + date1.getMonth() + "-" + date1.getDate() + "T" + row.fr_start_time);
                        console.log(date1.getFullYear() + "-" + date1.getMonth() + "-" + date1.getDate() + "T" + row.fr_end_time);
                        date1.setDate(date1.getDate() + 1);
                    }
                })
                obj.sort(function(a, b) {
                    var dateA = new Date(a.ad_start),
                        dateB = new Date(b.ad_start);
                    return dateA - dateB;
                });
                var hour = 0;
                var DateNow = "";
                obj.forEach((row) => {
                    if (DateNow == row.ad_start) {
                        var result_one = row.at_start.split(":")
                        var result_two = row.at_end.split(":")
                        var hour_one = 0;
                        var hour_two = 0;
                        if (parseInt(result_one[0]) < 9) {
                            hour_one = 9
                        } else if (parseInt(result_one[0]) > 21) {
                            hour_one = 21
                        } else {
                            hour_one = result_one[0]
                        }
                        if (parseInt(result_two[0]) < 9) {
                            hour_two = 9
                        } else if (parseInt(result_two[0]) > 21) {
                            hour_two = 21
                        } else {
                            hour_two = result_two[0]
                        }
                        hour += hour_two - hour_one
                    } else {
                        console.log(DateNow, hour)
                        if (hour < 12) {
                            obj.push({
                                start: DateNow,
                                end: DateNow,
                                rendering: 'background',
                                color: "rgb(198,239,206)"
                            })
                        } else {
                            obj.push({
                                start: DateNow,
                                end: DateNow,
                                rendering: 'background',
                                color: "red"
                            })
                        }
                        hour = 0
                        DateNow = row.ad_start
                        var result_one = row.at_start.split(":")
                        var result_two = row.at_end.split(":")
                        var hour_one = 0;
                        var hour_two = 0;
                        if (parseInt(result_one[0]) < 9) {
                            hour_one = 9
                        } else if (parseInt(result_one[0]) > 21) {
                            hour_one = 21
                        } else {
                            hour_one = result_one[0]
                        }
                        if (parseInt(result_two[0]) < 9) {
                            hour_two = 9
                        } else if (parseInt(result_two[0]) > 21) {
                            hour_two = 21
                        } else {
                            hour_two = result_two[0]
                        }
                        hour += hour_two - hour_one
                    }
                })

                console.log(DateNow, hour)
                if (hour < 12) {
                    obj.push({
                        start: DateNow,
                        end: DateNow,
                        rendering: 'background',
                        color: "rgb(198,239,206)"
                    })
                } else {
                    obj.push({
                        start: DateNow,
                        end: DateNow,
                        rendering: 'background',
                        color: "red"
                    })
                }
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    locale: 'th', // the initial locale. of not specified, uses the first one
                    plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
                    header: {
                        left: 'prev,next',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    defaultDate: new Date(),
                    minTime: '09:00:00',
                    maxTime: '22:00:00',
                    navLinks: true, // can click day/week names to navigate views
                    businessHours: false, // display business hours
                    editable: false,
                    events: obj
                });
                calendar.render();
            }
        })
    }
    document.addEventListener('DOMContentLoaded', function() {});
</script>
<style>
    body {
        margin: 40px 10px;
        padding: 0;
        font-size: 14px;
    }
    
    #calendar {
        max-width: 100%;
        margin: 0 auto;
        font-size: 20px;
    }
    
    .fc-center h2 {
        color: black;
    }
</style>

<script>
    $(document).ready(function() {
        $("#time1-1").show();
        $("#time1-2").show();
        $("#time1").on("click", function() {
            if ($('#time1').is(':checked')) {

                $("#time1-1").show();
                $("#time1-2").show();
            }
        });

        $("#time2,#time3,#time4").on("click", function() {
            if ($('#time2,#time3,#time4').is(':checked')) {

                $("#time1-1").hide();
                $("#time1-2").hide();
            }
        });

        $('.btn-next ,.nav-link').on("click", function(e) {
                var action = 0;
                $(".tab-pane.active").find('.required_check').each(function() {
                    if ($(this).val() == "") {
                        if (!$(this).parent().hasClass("has-danger")) {
                            $(this).parent().addClass("has-danger")
                            $(this).parent().append(
                                '<span class="form-control-feedback"><i class="material-icons">clear</i></span>');
                        }
                        action = 1;
                    }
                })
                $(".tab-pane.active").each(function() {
                    var Now = $(this)
                    if (action) {
                        setTimeout(function() {
                            $(".btn-previous").click()
                        }, 0);
                    }
                })

            })
            // $('#time1').click(){
            //     if($('#time1').is(':checked')){
            //    alert("55");
            //     } 
            // }
            // $('#time2').click(){
            //     if($('#time2').is(':checked')){
            //         $("#time1-1").hide();
            //         $("#time1-2").hide();
            //     }
            // }
            // $('#time3').click(){
            //     if($('#time3').is(':checked')){
            //         $("#time1-1").hide();
            //         $("#time1-2").hide();
            //     }
            // }
            // $('#time4').click(){
            //     if($('#time4').is(':checked')){
            //         $("#time1-1").hide();
            //         $("#time1-2").hide();
            //     }
            // }

        // $("#time1-1").hide();
        // $("#time1-2").hide();

        // $("#time1").click(function(){
        //     $("#time1-1").show();
        //     $("#time1-2").show();
        // })
        $(".required_check").on("click", function() {
            $(this).parent().removeClass("has-danger")
            $(this).parent().find(".form-control-feedback").remove()
        })
        $(".required_check").on("keyup", function() {
            $(this).parent().removeClass("has-danger")
            $(this).parent().find(".form-control-feedback").remove()
        })
        $(".autocomplete").on("keyup", function(event) { //onkeydown
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
        /*else if(get == "get_address2"){   //-- กำหนด
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
                <form action="<?php echo site_url('/ffm/frontend/C_test/insert_reservation_form');?>" method="POST" novalidate="novalidate">
                    <!--        You can switch " data-color="primary" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
                    <div class="text-center">
                        <h3 class="card-title">
                            แบบฟอร์มกรอกข้อมูล
                        </h3>
                        <h5 class="card-description">สำหรับทำการจองสนามฟุตบอล</h5>
                    </div>
                    <div class="wizard-navigation">
                        <ul class="nav nav-pills">
                            <li class="nav-item" style="width: 24%;">
                                <a class="nav-link active" href="#person" data-toggle="tab" role="tab">
                                    ขั้นที่ 1
                                </a>
                            </li>
                            <li class="nav-item" style="width: 24%;">
                                <a class="nav-link" href="#field" data-toggle="tab" role="tab">
                                    ขั้นที่ 2
                                </a>
                            </li>
                            <!-- <li class="nav-item" style="width: 24%;">
                                <a class="nav-link" href="#checking" data-toggle="tab" role="tab">
                                    ขั้นที่ 3
                                </a>
                            </li> -->
                            <li class="nav-item" style="width: 24%;">
                                <a class="nav-link" href="#download" data-toggle="tab" role="tab">
                                    ขั้นที่ 3
                                </a>
                            </li>

                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="person">
                                <h5> กรอกข้อมูลส่วนบุคคล</h5>
                                <br>
                                <div class="row justify-content-center">
                                    <div class="col-md-4">
                                        <div class="picture-container">

                                            <img src='<?PHP echo site_url("hr/getIcon?type=picturePerson&image=".$picture) ;?>' class=" picture-src" id="wizardPicturePreview" title="" style="width: 250px !important;">

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
                                                <select class="selectpicker" data-style="select-with-transition" name="quantity" id="dropdownList" data-size="7" tabindex="-98">
                                                    <?php foreach($qu_mr as $row){?>
                                                        <option name="prefix" value="<?php echo $row->pf_id;?>">
                                                            <?php echo $row->pf_name;?>
                                                        </option>
                                                        <?php }?>
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
                                                    <input type="text" class="form-control required_check" id="exampleInput1" name="fname" aria-required="true">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group bmd-form-group">
                                                    <label for="exampleInput1" class="bmd-label-floating">นามสกุล
                                                    </label>
                                                    <input type="text" class="form-control required_check" id="exampleInput1" name="lname" aria-required="true">
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
                                                    <input type="text" class="form-control required_check" id="exampleInput1" name="phone" aria-required="true">
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
                                                    <input type="text" class="form-control required_check" id="exampleInput1" name="adress" aria-required="true">
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
                                                    <input type="text" class="form-control required_check" id="exampleInput1" name="moo" aria-required="true">
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
                                                    <input type="text" class="form-control" id="zipcode" name="" aria-required="true" readonly>
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
                                                    <input type="text" class="form-control autocomplete required_check" id="dist_name" aria-required="true" get="get_address">
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
                                                    <input type="text" class="form-control" id="amph_name" aria-required="true" readonly>
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
                                                    <input type="text" class="form-control" id="pv_name" aria-required="true" readonly>
                                                    <input type="hidden" id="pv_id" name="pv_id">

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
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-content">
                                                        <h2 class="card-title" id="name-ff" style="text-align: center;">
                                                            ปฏิทินสนามฟุตบอลบางปลา
                                                        </h2>
                                                    </div>
                                                    <br>
                                                    <div id='calendar'></div>
                                                </div>

                                            </div>
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
                                                    <input type="text" class="form-control required_check" id="exampleInput1" name="project" aria-required="true">
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
                                                <select class="selectpicker" data-style="select-with-transition" data-size="7" tabindex="-98" id="ff_select" name="field">
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
                                                    <input type="text" class="form-control datepicker-thai" id="date1" name="date1" value="<?php echo getNowDateFwTh();?>">
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
                                                    <input type="text" class="form-control datepicker-thai" id="date2" name="date2" value="<?php echo getNowDateFwTh();?>">
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

                                                <input type="radio" class="form-check-input" id="time1" name="time" aria-required="true" checked>กำหนดเอง
                                                <br>
                                                <input id="time1-1" name="time_start" class="clockpicker form-control" value="<?php echo date('H-I')?>" data-default="20:48">
                                                <input id="time1-2" name="time_end" class="clockpicker form-control" value="<?php echo date('H-I')?>" data-default="20:48">

                                                <input type="radio" class="form-check-input" id="time2" name="time" aria-required="true">ช่วงเช้า (09:00 - 12:00)
                                                <br>
                                                <input type="hidden" name="time_start" class="clockpicker form-control" value="9" data-default="20:48">
                                                <input type="hidden" name="time_end" class="clockpicker form-control" value="12" data-default="20:48">
                                                <input type="radio" class="form-check-input" id="time3" name="time" aria-required="true">ช่วงเย็น (13:00 - 16:00)
                                                <br>
                                                <input type="hidden" name="time_start" class="clockpicker form-control" value="13" data-default="20:48">
                                                <input type="hidden" name="time_end" class="clockpicker form-control" value="16" data-default="20:48">

                                                <input type="radio" class="form-check-input" id="time4" name="time" aria-required="true">ทั้งวัน (09:00 - 21:00)
                                                <br>
                                                <input type="hidden" name="time_start" class="clockpicker form-control" value="9" data-default="20:48">
                                                <input type="hidden" name="time_end" class="clockpicker form-control" value="21" data-default="20:48">
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
                                                    <label for="exampleInput1" class="bmd-label-floating">1400
                                                    </label>
                                                    <input type="number" class="form-control" id="exampleInput1" name="price" aria-required="true" readonly>
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
                                                    <input type="number" class="form-control required_check" id="exampleInput1" name="total" aria-required="true">
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

                            
                               





















































<!--
                            <div class="tab-pane" id="checking">
                                <h5> กรอกข้อมูลส่วนบุคคล</h5>
                                <br>
                                <div class="row justify-content-center">
                                    <div class="col-md-4">
                                        <div class="picture-container">

                                            <img src='<?PHP echo site_url("hr/getIcon?type=picturePerson&image=".$picture) ;?>' class=" picture-src" id="wizardPicturePreview" title="" style="width: 250px !important;">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        คำนำหน้า :
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group bmd-form-group">
                                                    <label for="exampleInput1" class="bmd-label-floating">คำนำหน้า
                                                    </label>
                                                    <input type="text" class="form-control" id="exampleInput1" name="phone" aria-required="true" readonly>
                                                </div>
                                            </div>
                                        </div>
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
                                                    <input type="text" class="form-control required_check" id="exampleInput1" name="fname" aria-required="true" readonly>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group bmd-form-group">
                                                    <label for="exampleInput1" class="bmd-label-floating">นามสกุล
                                                    </label>
                                                    <input type="text" class="form-control required_check" id="exampleInput1" name="lname" aria-required="true" readonly>
                                                </div>
                                            </div>
                                        </div>
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
                                                    <input type="text" class="form-control required_check" id="exampleInput1" name="phone" aria-required="true" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h5>ที่อยู่ปัจจุบัน</h5>
                                <br>
                                <div class="row justify-content-center">
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
                                                    <input type="text" class="form-control required_check" id="exampleInput1" name="adress" aria-required="true" readonly>
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
                                                    <input type="text" class="form-control required_check" id="exampleInput1" name="moo" aria-required="true" readonly>
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
                                                    <input type="text" class="form-control" id="zipcode" name="" aria-required="true" readonly>
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
                                                <div class="form-group bmd-form-group is-focused">
                                                    <label for="exampleInput1" class="bmd-label-floating">ตำบล
                                                    </label>
                                                    <input type="text" class="form-control autocomplete required_check" id="dist_name" aria-required="true" get="get_address" readonly>
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
                                                    <input type="text" class="form-control" id="amph_name" aria-required="true" readonly>
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
                                                    <input type="text" class="form-control" id="pv_name" aria-required="true" readonly>
                                                    <input type="hidden" id="pv_id" name="pv_id">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h5> ข้อมูลการจองสนาม </h5>
                                <br>
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
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
                                                    <input type="text" class="form-control required_check" id="exampleInput1" name="project" aria-required="true">
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
                                                <select class="selectpicker" data-style="select-with-transition" data-size="7" tabindex="-98" id="ff_select" name="field">
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
                                                    <input type="text" class="form-control datepicker-thai" id="date1" name="date1" value="<?php echo getNowDateFwTh();?>">
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
                                                    <input type="text" class="form-control datepicker-thai" id="date2" name="date2" value="<?php echo getNowDateFwTh();?>">
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

                                                <input type="radio" class="form-check-input" id="time1" name="time" aria-required="true" checked>กำหนดเอง
                                                <br>
                                                <input id="time1-1" name="time_start" class="clockpicker form-control" value="<?php echo date('H-I')?>" data-default="20:48">
                                                <input id="time1-2" name="time_end" class="clockpicker form-control" value="<?php echo date('H-I')?>" data-default="20:48">

                                                <input type="radio" class="form-check-input" id="time2" name="time" aria-required="true">ช่วงเช้า (09:00 - 12:00)
                                                <br>
                                                <input type="hidden" name="time_start" class="clockpicker form-control" value="9" data-default="20:48">
                                                <input type="hidden" name="time_end" class="clockpicker form-control" value="12" data-default="20:48">
                                                <input type="radio" class="form-check-input" id="time3" name="time" aria-required="true">ช่วงเย็น (13:00 - 16:00)
                                                <br>
                                                <input type="hidden" name="time_start" class="clockpicker form-control" value="13" data-default="20:48">
                                                <input type="hidden" name="time_end" class="clockpicker form-control" value="16" data-default="20:48">

                                                <input type="radio" class="form-check-input" id="time4" name="time" aria-required="true">ทั้งวัน (09:00 - 21:00)
                                                <br>
                                                <input type="hidden" name="time_start" class="clockpicker form-control" value="9" data-default="20:48">
                                                <input type="hidden" name="time_end" class="clockpicker form-control" value="21" data-default="20:48">
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
                                                    <input type="number" class="form-control" id="exampleInput1" name="price" aria-required="true" readonly>
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
                                                    <input type="number" class="form-control required_check" id="exampleInput1" name="total" aria-required="true">
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


















-->













                            
                            <div class="tab-pane" id="download">
                                <div class="row justify-content-center">
                                    <div class="col-sm-12">
                                        <iframe src="<?php echo site_url('/ffm/frontend/C_downloadpdf/export_pdf_With_Data/34'); ?>" style="width: 100%;height: 980px;"></iframe>

                                        <a type="button" rel="tooltip"
                                            class="btn btn-danger  btn-wd"
                                            href="<?php echo site_url('/ffm/frontend/C_downloadpdf/export_pdf_With_Data/34');?>"style=" margin-left: 45%; ">
                                            <i class="material-icons">library_books</i> Download PDF
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="mr-auto">
                                <input type="button" class="btn btn-previous btn-fill btn-default btn-wd disabled" name="previous" value="Previous">
                            </div>
                            <div class="ml-auto">
                                <input type="button" class="btn btn-next btn-fill btn-primary btn-wd" name="next" id="next" value="Next">
                                <input type="submit" class="btn btn-finish btn-fill btn-success btn-wd" name="finish" value="Finish" style="display: none;">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                </form>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
    <script type="text/javascript">
        var hours = ["9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21"];
        var choices = ["00", "30"];

        $('.clockpicker').clockpicker({
            autoclose: true,
            afterShow: function() {
                $(".clockpicker-minutes").find(".clockpicker-tick").filter(function(index, element) {
                    return !($.inArray($(element).text(), choices) != -1)
                }).remove();
                $(".clockpicker-hours").find(".clockpicker-tick").filter(function(index, element) {
                    return !($.inArray($(element).text(), hours) != -1)
                }).remove();
            }
        });
    </script>