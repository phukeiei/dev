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
    #shsers,
    #shserm {
        display: none;
    }
</style>

<script>
    $(document).ready(function() {
        $('#headmenu').click(function() {
            $("#bodymenu").toggle('slow')
        })
        $('#sers').click(function() {
            window.location.href = "<?php echo base_url(); ?>index.php/swm/backend/Swm_manage_member/member_table_show";
        })
        $('#serm').click(function() {
            window.location.href = "<?php echo base_url(); ?>index.php/swm/backend/Swm_status/show_status";
        })
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
    })
</script>


    <div class="page-content ng-scope" ng-view="">
        <ol class="breadcrumb ng-scope">
            <li class="active">ระบบศูนย์นันทนาการสระว่ายน้ำ</li>
            <li><a href="<?php echo base_url(); ?>index.php/swm/backend/Swm_register/">หน้าแรก</a></li>
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
                                    <div class="tile-heading"><span>Edit member</span></div>
                                    <div class="tile-body"><span>แก้ไขข้อมูลส่วนตัว</span></div>
                                </div>
                            </div>
                            <div class="col-md-6" id="serm">
                                <div class="info-tile tile-orange" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
                                    <div class="tile-icon"><i class="ti ti-shopping-cart"></i></div>
                                    <div class="tile-heading"><span>Edit status</span></div>
                                    <div class="tile-body"><span>แก้ไขสถานะ</span></div>
                                </div>
                            </div>
                    </div>
                </div>






                <div id="shsers" class="col-md-12">
                    <div class="panel panel-blue" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
                        <div class="panel-heading">
                            <h2>คำอธิบาย</h2>
                        </div>
                        <div class="panel-body" id="bodymenu">
                            <div class="col-md-6">
                            การดูข้อมูลของผู้ใช้บริการทั้งหมด แก้ไขข้อมูลส่วนตัวของผู้ใช้บริการ พิมพ์บัตรสมาชิก และพิมพ์ใบเสร็จค่าใช้จ่ายในการใช้บริการ
                            </div>
                        </div>
                    </div>
                </div>

                <div id="shserm" class="col-md-12">
                    <div class="panel panel-blue" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
                        <div class="panel-heading">
                            <h2>คำอธิบาย</h2>
                        </div>
                        <div class="panel-body" id="bodymenu">
                            <div class="col-md-6">
                            การแก้ไขสถานะของผู้ใช้บริการ
                            </div>
                        </div>
                    </div>
                </div>






            </div>



        </div> <!-- container-fluid -->
    </div>

