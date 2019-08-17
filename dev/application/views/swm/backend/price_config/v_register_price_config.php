<!--
* v_user_config
* Display Show user config
* @input    $scp_sug_id,$scp_age_min,$scp_age_max,$scp_cost
* @output   sug_id,age_min,age_max,total
* @author   Wannapa Srijermtong
* @create Date  2562-05-17
-->

<!--------------------------------เปิด/ปิดแท็บ--------------------------------->
<script>
    $(document).ready(function() {

        var age;
        $("#age1_2").keyup(function() {
            if (age = $("#age1_2").val() == "") {
                $("#age2_1").val('')
            } else {
                age = $("#age1_2").val()
                $("#age2_1").val(Number(age) + Number(1))
            }
        });

        $("#age1_2").on('change', function() {
            if (age = $("#age1_2").val() == "") {
                $("#age2_1").val('')
            } else {
                age = $("#age1_2").val()
                $("#age2_1").val(Number(age) + Number(1))
            }
        });


    });
    function maxLengthCheck(object) {
        if (object.value.length > object.maxLength) {
            object.value = object.value.slice(0, object.maxLength)
        }
    }
</script>
<!-------------------------------------------------------------------------->


<style>
    input[type=text]:disabled {
        background: #dddddd;
    }

    td {
        margin-top: 100px;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 30;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 30px;
        left: 4px;
        bottom: 0px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: green;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px green;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 30px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>



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
        <div class="panel panel-default">
            <div class="panel-heading panel_heading_iserl">
                <h2>กำหนดค่าสมัครสมาชิก</h2>
            </div>
            <div class="panel-body">
                <div class="col-md-12">

                    <!--------------------------------------------form 1--------------------------------------------->
                    <form method="POST" action="./index">

                        <!--<div class="form-group">
                            <label class="col-sm-2 control-label">ประเภทผู้ใช้บริการ</label>
                            <div class="col-sm-5">
                                <label class="radio-inline icheck"><input type="radio" value="1" name="sug_id">&nbsp;&nbsp;&nbsp;สมาชิก</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <label class="radio-inline icheck"><input type="radio" value="2" name="sug_id">&nbsp;&nbsp;&nbsp;ผู้ใช้ทั่วไป</label>
                            </div>
                        </div>-->
                        <br><br>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">ช่วงอายุ</label>
                            <div class="col-sm-4">
                                <input id="age1_1" type="number" name="age_min" class="form-control" placeholder="1 ปี">
                            </div>
                            <label class="col-sm-1 control-label" style="max-width:15px;padding:0px;">ถึง</label>
                            <div class="col-sm-4">
                                <input id="age1_2" type="number" name="age_max" class="form-control" placeholder="17 ปี">
                            </div>
                            <label class="col-sm-1 control-label" style="max-width:15px;padding:0px;">ปี</label>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">จำนวนเงิน</label>
                            <div class="col-sm-4">
                                <input min="0" type="number" name="total" class="form-control">
                            </div>
                            บาท
                        </div>

                    </form>

                    <!--------------------------------------------form 2--------------------------------------------->

                    <form method="POST" action="./index">

                        <hr>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">ช่วงอายุ</label>
                            <div class="col-sm-4">
                                <input id="age2_1" type="number" name="age_min" class="form-control" placeholder="18 ปี" readonly>
                            </div>
                            <label class="col-sm-1 control-label" style="max-width:15px;padding:0px;">ถึง</label>
                            <div class="col-sm-4">
                                <input id="age2_2" type="number" name="age_max" class="form-control" placeholder="99 ปี" maxlength="2" min="1" max="99" oninput="maxLengthCheck(this)">
                            </div>
                            <label class="col-sm-1 control-label" style="max-width:15px;padding:0px;">ปี</label>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">จำนวนเงิน</label>
                            <div class="col-sm-4">
                                <input min="0" type="number" name="total" class="form-control">
                            </div>บาท
                        </div>


                        <div class="panel-footer">
                            <span class="text-gray demo-btns">
                                <input class="btn btn-danger btn_iserl tooltips " title="คลิกปุ่มเพื่อลบข้อมูล" type="submit" value="ลบ" />
                                <input class="btn btn-inverse btn_iserl tooltips " title="คลิกปุ่มเพื่อเคลียร์ข้อมูล" type="submit" value="เคลียร์" /> &nbsp;&nbsp;
                                <input class="btn btn-success btn_iserl tooltips pull-right" title="คลิกปุ่มเพื่อบันทึกข้อมูล" type="submit" value="บันทึก" />
                            </span>
                        </div>

                    </form>

                    <!---------------------------------------------------------------------------------------------->

                </div>
            </div>
        </div>
    </div>
    </div>


</body>

</html>




<div class="col-md-12">
    <div class="panel panel-default" data-widget='{"draggable": "false"}'>
        <div class="panel-heading panel_heading_iserl">
            <h2>ตารางค่าใช้จ่ายการสมัครสมาชิก</h2>
        </div>

        <div class="panel-body">
            <table border="1" class="table table-striped table-bordered table_iserl no-footer table-hover">
                <thead>
                    <tr>
                        <th width="2%">ลำดับ</th>
                        <th width="15%">ช่วงอายุ</th>
                        <th width="7%">ค่าสมัคร (บาท)</th>
                        <th width="15%">ตัวดำเนินการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0;
                    //foreach($rs_std->result() as $row){	
                    //$i++;
                    ?>
                    <tr>
                        <td rowspan="2"><br>1</td>
                        <td>อายุต่ำกว่า 18 ปี</td>
                        <td>300</td>
                        <!----------------------------------------------switch----------------------------------------------->

                        <!--------------------------------------------------------------------------------------------------->
                        <td rowspan="2"><br>
                            <a herf="#" class="btn btn-orange btn_check_iserl tooltips ti ti-pencil" title="คลิกปุ่มเพื่อแก้ไขข้อมูล"></a>
                            <a herf="#" class="btn btn-danger btn_check_iserl tooltips ti ti-close" title="คลิกปุ่มเพื่อลบข้อมูล"></a>
                        </td>
                    </tr>
                    <tr>
                        <td>อายุ 18 ปีขึ้นไป</td>
                        <td>500</td>
                    </tr>
                    <tr>
                        <td rowspan="2"><br>2</td>
                        <td>อายุต่ำกว่า 18 ปี</td>
                        <td>300</td>
                        <!----------------------------------------------switch----------------------------------------------->

                        <!--------------------------------------------------------------------------------------------------->
                        <td rowspan="2"><br>
                            <a herf="#" class="btn btn-orange btn_check_iserl tooltips ti ti-pencil" title="คลิกปุ่มเพื่อแก้ไขข้อมูล"></a>
                            <a herf="#" class="btn btn-danger btn_check_iserl tooltips ti ti-close" title="คลิกปุ่มเพื่อลบข้อมูล"></a>
                        </td>
                    </tr>
                    <tr>
                        <td>อายุ 18 ปีขึ้นไป</td>
                        <td>500</td>
                    </tr>
                    <tr>
                        <td rowspan="2"><br>3</td>
                        <td>อายุต่ำกว่า 18 ปี</td>
                        <td>300</td>
                        <!----------------------------------------------switch----------------------------------------------->

                        <!--------------------------------------------------------------------------------------------------->
                        <td rowspan="2"><br>
                            <a herf="#" class="btn btn-orange btn_check_iserl tooltips ti ti-pencil" title="คลิกปุ่มเพื่อแก้ไขข้อมูล"></a>
                            <a herf="#" class="btn btn-danger btn_check_iserl tooltips ti ti-close" title="คลิกปุ่มเพื่อลบข้อมูล"></a>
                        </td>
                    </tr>
                    <tr>
                        <td>อายุ 18 ปีขึ้นไป</td>
                        <td>500</td>
                    </tr>

                </tbody>

            </table>

        </div>

        <!------------->
    </div>
</div>