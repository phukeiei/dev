<!--
* v_user_config
* Display Show user config
* @input    $scp_sug_id,$scp_age_min,$scp_age_max,$scp_cost
* @output   sug_id,age_min,age_max,total
* @author   Wannapa Srijermtong
* @create Date  2562-05-17
-->
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

<!--------------------------------เปิด/ปิดแท็บ--------------------------------->
<script>
    $(document).ready(function() {

        $("#tab_user").click(function() {
            $("#tabs1").show();
            $("#tabs2").hide();
            $('#tab_user').addClass('active')
            $('#tab_member').removeClass('active')
        });

        $("#tab_member").click(function() {
            $("#tabs2").show();
            $("#tabs1").hide();
            $('#tab_member').addClass('active')
            $('#tab_user').removeClass('active')
        });

        // $('#tab_member').addClass('active')

        let event = new Event("click")
        tab_user.dispatchEvent(event)


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
            
        $('.sw').on('change',function(e){
            e.preventDefault();
            let current_state = $(e.target).prop('checked')
            if(!current_state){
                // $('.sw').prop('checked', false);
                $(e.target).prop('checked',true)
                console.log(1)
                alert("ไม่สามารถปิดได้")

            }else{
                $('.sw').prop('checked', false);
                $(e.target).prop('checked',true);
                //console.log(2)
                console.log("---------------------------------------")
        
                // var scp_reference = $("#sl1").val();
                var scp_reference = $(this).val();
                var user_status = $("#user_status").val();
                console.log( scp_reference )
                console.log( user_status )

                user_price_config_change_active(user_status,scp_reference)

            }
        })

        $('.sw1').on('change',function(e){
            e.preventDefault();
            let current_state = $(e.target).prop('checked')
            if(!current_state){
                // $('.sw').prop('checked', false);
                $(e.target).prop('checked',true)
                console.log(1)
                alert("ไม่สามารถปิดได้")

            }else{
                $('.sw1').prop('checked', false);
                $(e.target).prop('checked',true);
                //console.log(2)
                console.log("---------------------------------------")
        
                // var scp_reference = $("#sl1").val();
                var scp_reference = $(this).val();
                var user_status_nonmember = $("#user_status_nonmember").val();
                console.log( scp_reference )
                console.log( user_status_nonmember )

                user_price_config_change_active(user_status_nonmember,scp_reference)

            }
        })
        
   
    });

    function user_price_config_change_active(user_status,scp_reference) {

        $.ajax({

            type: "POST",
            url: "<?php echo base_url("index.php/swm/backend/Swm_price_config/user_price_config_change_active_ajax"); ?>", 
            data:{  
                scp_sug_id : user_status
            },
            dataType : "json",
            success: function(result){
                user_price_config_change(scp_reference)
                
            }

        });	
        
    }

    function user_price_config_change(scp_reference) {

        $.ajax({

            type: "POST",
            url: "<?php echo base_url("index.php/swm/backend/Swm_price_config/user_price_config_change_ajax"); ?>", 
            data:{  
                scp_reference : scp_reference
            },
            dataType : "json",
            success: function(result){
                location.reload();
            }

        });	

    }


</script>

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading panel_heading_iserl">
            <h2>กำหนดค่าใช้บริการ</h2>
        </div>
        <div class="panel-body">
            <div class="col-md-12">

                <!--------------------------------------------form 1--------------------------------------------->
                <form method="POST" action="<?php echo base_url("index.php/swm/backend/Swm_config/user_price_config_insert"); ?>">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">ประเภทผู้ใช้บริการ</label>
                        <div class="col-sm-5">
                            <label class="radio-inline icheck"><input type="radio" value="1" name="sug_id" checked>&nbsp;&nbsp;&nbsp;สมาชิก</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <label class="radio-inline icheck"><input type="radio" value="2" name="sug_id">&nbsp;&nbsp;&nbsp;ผู้ใช้ทั่วไป</label>
                        </div>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">ช่วงอายุ</label>
                        <div class="col-sm-4">
                            <input id="age1_1" min=0 type="number" name="age_member_min" class="form-control" placeholder="">
                        </div>
                        <label class="col-sm-1 control-label" style="max-width:15px;padding:0px;">ถึง</label>
                        <div class="col-sm-4">
                            <input id="age1_2" min=0 type="number" name="age_member_max" class="form-control" placeholder="">
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">จำนวนเงิน</label>
                        <div class="col-sm-8">
                            <input min="0" type="number" name="member_total" class="form-control">
                        </div>
                        บาท
                    </div>    

                <!--------------------------------------------form 2--------------------------------------------->
                    <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">ช่วงอายุ</label>
                        <div class="col-sm-4">
                            <input readonly="readonly" min=0 id="age2_1" type="number" name="age_nonmember_min" class="form-control" placeholder="" >
                        </div>
                        <label class="col-sm-1 control-label" style="max-width:15px;padding:0px;">ถึง</label>
                        <div class="col-sm-4">
                            <input id="age2_2" min=0 type="number" name="age_nonmember_max" class="form-control" placeholder="">
                        </div>
                        <label class="col-sm-1 control-label" style="max-width:15px;padding:0px;">ปี</label>
                    </div>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">จำนวนเงิน</label>
                        <div class="col-sm-8">
                            <input min="0" type="number" name="nonmember_total" class="form-control">
                        </div>บาท
                    </div>

                    <div class="panel-footer">
                        
                        <input class="btn btn-inverse btn_iserl tooltips " title="คลิกปุ่มเพื่อเคลียร์ข้อมูล" type="reset" value="เคลียร์" /> &nbsp;&nbsp;
                        <input class="btn btn-success btn_iserl tooltips pull-right" title="คลิกปุ่มเพื่อบันทึกข้อมูล" type="submit" value="บันทึก" />
                        
                    </div>

                </form>

                <!---------------------------------------------------------------------------------------------->

            </div>
        </div>
    </div>
</div>
</div>



<div class="col-md-12">
    <div class="panel panel-default" data-widget='{"draggable": "false"}'>
        <div class="panel-heading panel_heading_iserl">
            <h2>ตารางค่าใช้จ่ายการใช้บริการ</h2>
        </div>

        <div class="panel-body">

            <!-----------------------------------------------Tab 1----------------------------------------------->
            <div class="tab-container tab-default">
                <ul class="nav nav-tabs">
                    <li id="tab_user" class=''><a data-toggle="tab"><b>สมาชิก</b></a></li>
                    <li id="tab_member" class=''><a data-toggle="tab"><b>ผู้ใช้ทั่วไป</b></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tabs1">
                        <br>
                        <table border="1" class="table table-striped table-bordered table_iserl no-footer table-hover">
                            <thead>
                                <tr>
                                    <th >ลำดับ</th>
                                    <th>ช่วงอายุ</th>
                                    <th>ค่าใช้บริการ (บาท)</th>
                                    <th>สถานะการใช้งาน</th>
                                    <th >ตัวดำเนินการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0;
                                //pre($rs_cost_pool);
                                foreach($tmp_arr as $row){	
                                    $i++;

                                // for ($i=1; $i <= count($rs_cost_pool) ; $i++) { 
                                foreach($row as $ind => $sub_row){
                                    if($ind==0){
                                ?>
                                <tr>
                                    <td rowspan="<?php echo count($row);?>"><?php echo $i; ?></td>
                                    <td><?php echo $sub_row->scp_age_min; ?></td>
                                    <td><?php echo $sub_row->scp_cost; ?></td>
                                    <td rowspan="<?php echo count($row);?>">
                                        <label class="switch" >
                                            <input id="sl1" type="checkbox" class="sw" <?php echo ($sub_row->scp_is_active=='Y')?'checked':'';?> value="<?php echo $sub_row->scp_reference ?>">
                                            <span class="slider round"></span>
                                        </label>
                                        <input id="user_status" type="hidden" class="sw" value="<?php echo $sub_row->scp_sug_id ?>">
                                    </td>
                                    <td rowspan="<?php echo count($row);?>" style="vertical-align: center;">
                                        <a herf="#" class="btn btn-orange btn_check_iserl tooltips ti ti-pencil" title="คลิกปุ่มเพื่อแก้ไขข้อมูล"></a>
                                        <a herf="#" class="btn btn-danger btn_check_iserl tooltips ti ti-close" title="คลิกปุ่มเพื่อลบข้อมูล"></a>
                                    </td>
                                </tr>
                                <?php }else{ ?>
                                    <tr>
                                        <td><?php echo $sub_row->scp_age_min; ?></td>
                                        <td><?php echo $sub_row->scp_cost; ?></td>
                                    </tr>
                                <?php } 

                                    }
                                } ?>
                            </tbody>
                        </table>
                    </div>

                    <!--------------------------------------------Tab 2------------------------------------------------------->

                    <div class="tab-pane active" id="tabs2">
                        <br>
                        <table border="1" class="table table-striped table-bordered table_iserl no-footer table-hover">
                            <thead>
                                <tr>
                                    <th >ลำดับ</th>
                                    <th >ช่วงอายุ</th>
                                    <th >ค่าใช้บริการ (บาท)</th>
                                    <th >สถานะการใช้งาน</th>
                                    <th >ตัวดำเนินการ</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0;
                                //pre($rs_cost_pool);
                                foreach($tmp_arr_nonmember as $row){	
                                    $i++;

                                // for ($i=1; $i <= count($rs_cost_pool) ; $i++) { 
                                foreach($row as $ind => $sub_row){
                                    if($ind==0){
                                ?>
                                <tr>
                                    <td rowspan="<?php echo count($row);?>"><?php echo $i; ?></td>
                                    <td><?php echo $sub_row->scp_age_min; ?></td>
                                    <td><?php echo $sub_row->scp_cost; ?></td>
                                    <td rowspan="<?php echo count($row);?>">
                                        <label class="switch" >
                                            <input type="checkbox" class="sw1" <?php echo ($sub_row->scp_is_active=='Y')?'checked':'';?> value="<?php echo $sub_row->scp_reference ?>">
                                            <span class="slider round"></span>
                                        </label>
                                        <input id="user_status_nonmember" type="hidden" class="sw" value="<?php echo $sub_row->scp_sug_id ?>">
                                    </td>
                                    <td rowspan="<?php echo count($row);?>" style="vertical-align: center;">
                                        <a herf="#" class="btn btn-orange btn_check_iserl tooltips ti ti-pencil" title="คลิกปุ่มเพื่อแก้ไขข้อมูล"></a>
                                        <a herf="#" class="btn btn-danger btn_check_iserl tooltips ti ti-close" title="คลิกปุ่มเพื่อลบข้อมูล"></a>
                                    </td>
                                </tr>
                                <?php }else{ ?>
                                    <tr>
                                        <td><?php echo $sub_row->scp_age_min; ?></td>
                                        <td><?php echo $sub_row->scp_cost; ?></td>
                                    </tr>
                                <?php } 

                                    }
                                } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--แท็บนอก-->
        </div>
        <!------------->
    </div>
</div>