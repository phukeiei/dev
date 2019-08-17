<!--
* v_config
* Display Show user config
* @input    $scp_sug_id,$scp_age_min,$scp_age_max,$scp_cost
* @output   sug_id,age_min,age_max,total
* @author   Wannapa Srijermtong
* @create Date  2562-05-19
-->

<style>
    #reg,
    #manu,
    #headmenu,
    #sers,
    #serm {
        cursor: pointer;
    }
</style>

<script>
    $(document).ready(function() {
        $('#headmenu').click(function() {
            $("#bodymenu").toggle('slow')
        })
        $('#reg').click(function() {
            window.location.href = "<?php echo base_url(); ?>index.php/swm/backend/Swm_register/regis";
        })
        $('#manu').click(function() {
           window.location.href = "<?php echo base_url(); ?>index.php/swm/backend/Swm_status/show_status";
        })
        $('#sers').click(function() {
            window.location.href = "<?php echo base_url(); ?>index.php/swm/backend/Swm_price_config/user_price_config";
        })
        $('#serm').click(function() {
            window.location.href = "<?php echo base_url(); ?>index.php/swm/backend/Swm_price_config/register_price_config";
        })
        $("#reg").hover(function() {
            $("#shreg").slideDown('slow')
        });
        $("#reg").mouseleave(function() {
            $("#shreg").slideToggle('fast')
        });
        $("#sers").hover(function() {
            $("#shsers").slideDown('slow')
        });
        $("#sers").mouseleave(function() {
            $("#shsers").slideToggle('fast')
        });
        $("#serm").hover(function() {
            $("#shserm").slideDown('slow')
        });
        $("#serm").mouseleave(function() {
            $("#shserm").slideToggle('fast')
        });
        $("#manu").hover(function() {
            $("#shmanu").slideDown('slow')
        });
        $("#manu").mouseleave(function() {
            $("#shmanu").slideToggle('fast')
        });
    })
</script>


    <div class="page-content ng-scope" ng-view="">
        <ol class="breadcrumb ng-scope">
            <li class="active">ระบบศูนย์นันทนาการสระว่ายน้ำ</li>
            <li><a href="#/">หน้าแรก</a></li>
            <li><a href="#/">เมนูผู้ดูแลระบบ</a></li>
        </ol>

        <div class="container-fluid ng-scope" ng-controller="DashboardController">
            <div class="row">


                <div class="col-md-12">
                    <div class="panel panel-blue" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
                        <div class="panel-heading" id="headmenu">
                            <h2>เมนูผู้ดูแลระบบ</h2>
                        </div>
                        <div class="col-md-6" id="sers">
                                <div class="info-tile tile-info" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
                                    <div class="tile-icon"><i class="ti ti-settings"></i></div>
                                    <div class="tile-heading"><span>Services Config</span></div>
                                    <div class="tile-body"><span>ค่าใช้จ่ายการใช้บริการ</span></div>
                                </div>
                            </div>
                            <div class="col-md-6" id="serm">
                                <div class="info-tile tile-orange" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
                                    <div class="tile-icon"><i class="ti ti-shopping-cart"></i></div>
                                    <div class="tile-heading"><span>Member Config</span></div>
                                    <div class="tile-body"><span>ค่าใช้จ่ายการสมัครสมาชิก</span></div>
                                </div>
                            </div>
                    </div>
                </div>






                <div id="shreg" class="col-md-12" hidden>
                    <div class="panel panel-blue" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
                        <div class="panel-heading">
                            <h2>คำอธิบาย</h2>
                        </div>
                        <div class="panel-body" id="bodymenu">
                            <div class="col-md-6">
                            การกำหนดค่าใช้จ่ายการใช้บริการ
                            </div>
                        </div>
                    </div>
                </div>

                <div id="shmanu" class="col-md-12" hidden>
                    <div class="panel panel-blue" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
                        <div class="panel-heading">
                            <h2>คำอธิบาย</h2>
                        </div>
                        <div class="panel-body" id="bodymenu">
                            <div class="col-md-6">
                            การกำหนดค่าใช้จ่ายการสมัครสมาชิก
                            </div>
                        </div>
                    </div>
                </div>






            </div>



        </div> <!-- container-fluid -->
    </div>

