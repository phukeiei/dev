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
<!------------------------------------  อันล่าสุด -------------------------->
<div class="col-md-12">
   <div class="card">
      <div class="card-header card-header-info card-header-icon">
         <div class="card-icon">
            <i class="material-icons">contacts</i>
         </div>
         <h4 class="card-title"> กำหนดค่าใช้บริการ</h4>
      </div>
      <div class="card-body">
      <div class="col-lg-5 col-md-6 col-sm-3">
    <div class="dropdown bootstrap-select">
        <select class="selectpicker" data-size="4" data-style="btn btn-primary btn-round" title="สถานะผู้ใช้งาน" tabindex="-98">
                            <option class="bs-title-option" value=""></option>
                            <option disabled="" selected="">สถานะผู้ใช้งาน</option>
                            <option value="2">สมาชิก</option>
                            <option value="2">ผู้ใช้ทั่วไป</option>
                          </select>
        </div>
</div>
        <form class="form-horizontal">
          <div class="row">
            <label class="col-md-3 col-form-label">ช่วงอายุ</label>
            <input id="age1_1" min=0 type="number" name="age_member_min" class="form-control" placeholder="">
            <label class="col-md-0 col-form-label">ปี   ถึง</label>
            <input id="age1_2" min=0 type="number" name="age_member_max" class="form-control" placeholder="">
            <label class="col-md-0 col-form-label">ปี ราคา</label>
            <input min="0" type="number" name="member_total" class="form-control" placeholder="">
            <label class="col-md-0 col-form-label">บาท</label>
         </div>
         <div class="row">
         <label class="col-md-3 col-form-label"></label>
            <input id="age1_1" min=0 type="number" name="age_member_min" class="form-control" placeholder="">
            <label class="col-md-0 col-form-label">ปี   ถึง</label>
            <input id="age1_2" min=0 type="number" name="age_member_max" class="form-control" placeholder="">
            <label class="col-md-0 col-form-label">ปี ราคา</label>
            <input min="0" type="number" name="member_total" class="form-control" placeholder="">
            <label class="col-md-0 col-form-label">บาท</label>
           </div>
       <!-- <div class="row">
          <label class="col-md-3"></label>
            <div class="col-md-9">
              
            </div>
          </div>
        </form>
      </div>-->
      <div class="card-footer">
        <div class="mr-auto">
          <button class="btn btn-danger" rel="tooltip" data-placement="top" title="" data-original-title="คลิกเพื่อยกเลิกข้อมูล">ยกเลิก</button>
        </div>
        <div class="ml-auto">
         <!-- <button type="submit" class="btn btn-fill btn-success " rel="tooltip" data-placement="top" title='Submit'>Submit</button>-->
          <button class="btn btn-success" rel="tooltip" data-placement="top" title="" data-original-title="คลิกเพื่อบันทึกข้อมูล">บันทึก</button>
        </div>
      </div>	  
   </div>
</div>

<!------------------------------------  อันล่าสุด -------------------------->





<!----------------------------------------ตารางใหม่------------------------>
<div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-info card-header-icon">
            <div class="card-icon">
                <i class="material-icons">assignment</i>
            </div>
            <h4 class="card-title">ตารางค่าใช้บริการ</h4>
        </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-striped table-hover table-color-header table-border">
                    <thead class="text-primary">
                    <tr>
                    <th class="text-center">ลำดับ</th>
                    <th class="text-center"><div class="form-check">
                    <label class="form-check-label" style="margin-top:5px;">
                    <input class="form-check-input" type="checkbox" value="" checked="">
                    <span class="form-check-sign">
                    <span class="check"></span>
                    </span>
                    </label>
                    </div>
                    </th>
                        <th>สถานะสมาชิก</th>
                        <th>ช่วงอายุ</th>
                        <th>ค่าใช้บริการ (บาท)</th>
                        <th>วันที่แก้ไขข้อมูล</th>
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
                                    <td class="text-center"  rowspan="<?php echo count($row);?>">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" value="" checked="">
                                            <span class="form-check-sign">
                                            <span class="check"></span>
                                            </span>
                                            </label>
                                        </div>
                                </td>
                                    <td rowspan="<?php echo count($row);?>" class="text-center"><?php echo "สมาชิก";?></td>
                                    <td><?php echo $sub_row->scp_age_min; ?></td>
                                    <td><?php echo $sub_row->scp_cost; ?></td>
                                    <td rowspan="<?php echo count($row);?>" class="text-center"><?php echo "2019-05-20";?></td>
                                    </td>
                                    <td rowspan="<?php echo count($row);?>" class="td-actions text-center">
                                    <button type="button" rel="tooltip" class="btn btn-warning" data-placement="top" title="" data-original-title="คลิกเพื่อแก้ไขข้อมูล">
                                        <i class="material-icons">edit</i>
                                    </button>
                                    <button type="button" rel="tooltip" class="btn btn-danger" data-placement="top" title="" data-original-title="คลิกเพื่อลบข้อมูล">
                                        <i class="material-icons">close</i>
                                    </button>
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
</div>



<!----------------------------------------ตารางใหม่------------------------>

























 