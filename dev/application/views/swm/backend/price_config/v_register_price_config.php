<!--
* v_user_config
* Display Show user config
* @input    $scp_sug_id,$scp_age_min,$scp_age_max,$scp_cost
* @output   sug_id,age_min,age_max,total
* @author   Kannapat Peankaew
* @create Date  2562-08-20
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
   <div class="card">
      <div class="card-header card-header-info card-header-icon">
         <div class="card-icon">
            <i class="material-icons">contacts</i>
         </div>
         <h4 class="card-title">กำหนดค่าสมัครสมาชิก</h4>
      </div>
      <div class="card-body">
        <form class="form-horizontal">
          <div class="row">
            <label class="col-md-2 col-form-label">ช่วงอายุ</label>
            <div class="col-md-2">
              <div class="form-group has-default">
                    <input id="age1_1" type="number" name="age_min" class="form-control text-center" placeholder="1">
              </div>
            </div>
            <label class="col-md-0 col-form-label">ถึง</label>
            <div class="col-md-2">
              <div class="form-group has-default">
                    <input id="age1_2" type="number" name="age_max" class="form-control text-center" placeholder="17"> 
              </div>
            </div>
            <label class="col-md-0 col-form-label">ปี</label>
            <label class="col-md-1 col-form-label">ราคา</label>
            <div class="col-md-2">
              <div class="form-group has-default">
                    <input min="0" type="number" name="total" class="form-control">   
              </div>
            </div>
            <label class="col-md-0 col-form-label">บาท</label>
         </div>
         <div class="row">
            <label class="col-md-2 col-form-label"></label>
            <div class="col-md-2">
              <div class="form-group has-default">
                    <input id="age1_1" type="number" name="age_min" class="form-control text-center" placeholder="1">
              </div>
            </div>
            <label class="col-md-0 col-form-label">ถึง</label>
            <div class="col-md-2">
              <div class="form-group has-default">
                    <input id="age1_2" type="number" name="age_max" class="form-control text-center" placeholder="17"> 
              </div>
            </div>
            <label class="col-md-0 col-form-label">ปี</label>
            <label class="col-md-1 col-form-label">ราคา</label>
            <div class="col-md-2">
              <div class="form-group has-default">
                    <input min="0" type="number" name="total" class="form-control">   
              </div>
            </div>
            <label class="col-md-0 col-form-label">บาท</label>
         </div>
         
        
      <div class="card-footer">
        <div class="mr-auto">
            <button class="btn btn-danger" rel="tooltip" data-placement="top" title='คลิกเพื่อยกเลิกข้อมูล'>ยกเลิก</button>
        </div>
        <div class="ml-auto">
        <button class="btn btn-success" rel="tooltip" data-placement="top" title='คลิกเพื่อบันทึกข้อมูล'>บันทึก</button>
        </div>
      </div>   
   </div>
</div>

<!--------------------------------------------form 2--------------------------------------------->

<form method="POST" action="./index">   

    <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">assignment</i>
                    </div>
                <h4 class="card-title">ตารางค่าสมัครสมาชิก</h4>
            </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-color-header table-border">
                    <thead class="text-primary">
                        <tr>
                            <th class="text-center">#</th>
                                <th class="text-center">
                                    <div class="form-check">
                                        <label class="form-check-label" style="margin-top:5px;">
                                            <input class="form-check-input" type="checkbox" value="" checked="">
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                        </label>
                                     </div>
                            </th>
                        <th>ช่วงอายุ</th>
                        <th>ราคา(บาท)</th>
                        <th>วันที่แก้ไข</th>
                        </tr>
                    </thead>
                <tbody>
                    <tr>
                        <td class="text-center" rowspan="2" >1</td>
                        <td class="text-center" rowspan="2" >
                            <div class="form-check" >
                                <label class="form-check-label" >
                                    <input class="form-check-input" type="checkbox" value="" checked="" >
                                        <span class="form-check-sign" >
                                            <span class="check" ></span>
                                        </span>
                                </label>
                            </div>  
                        </td>
                        <td class="text-center">ต่ำกว่า 18 ปี</td>
                        <td class="text-center">300</td>
                        <td rowspan="2"class="text-center" >16 มกราคม 2560</td>
                    </tr>
                    <tr>
                        <td class="text-center">มากกว่า 18 ปี</td>
                        <td class="text-center">350</td>
                    </tr>
                    <tr>
                        <td class="text-center" rowspan="2" >2</td>
                        <td class="text-center" rowspan="2" >
                            <div class="form-check" >
                                <label class="form-check-label" >
                                    <input class="form-check-input" type="checkbox" value="" checked="" >
                                        <span class="form-check-sign" >
                                            <span class="check" ></span>
                                        </span>
                                </label>
                            </div>  
                        </td>
                        <td class="text-center">ต่ำกว่า 18 ปี</td>
                        <td class="text-center">400</td>
                        <td rowspan="2"class="text-center" >15 มกราคม 2560</td>
                    </tr>
                    <tr>
                        <td class="text-center">มากกว่า 18 ปี</td>
                        <td class="text-center">450</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

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
