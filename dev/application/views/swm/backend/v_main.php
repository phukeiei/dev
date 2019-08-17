<!--
* v_main
* Display main menu
* @input    - 
* @output   menu for admin
* @author   Supak Pukdam
* @Update   Supak Pukdam
* @Update Date  2562-05-17
-->
<style>
    #reg,
    #manu,
    #headmenu,
    #sers,
    #serm {
        cursor: pointer;
    }

    #shreg,
    #shmanu,
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
        $('#reg').click(function() {
            window.location.href = "<?php echo base_url(); ?>index.php/swm/backend/Swm_register/regis_table_show";
        })
        $('#manu').click(function() {
            window.location.href = "<?php echo base_url(); ?>index.php/swm/backend/Swm_manage_member";
        })
        $('#sers').click(function() {
            window.location.href = "<?php echo base_url(); ?>index.php/swm/backend/Swm_price_config";
        })
        $('#serm').click(function() {
            window.location.href = "<?php echo base_url(); ?>index.php/swm/backend/Swm_service_manage";
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
            <div class="col-md-6">
                <div class="panel panel-blue">
                    <div class="panel-heading" id="headmenu">
                        <h2>เมนูผู้ดูแลระบบ</h2>
                    </div>
                    <div class="panel-body" id="bodymenu">
                        <div class="col-md-6" id="reg">
                            <div class="card">
                                <div class="card-body text-center">
                                    <div class="tile-heading"><span>register</span></div>
                                    <div class="tile-body" style="color:DodgerBlue;"><span>สมัครสมาชิก</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" id="manu">
                            <div class="card">
                                <div class="card-body text-center">
                                    <div class="tile-heading"><span>User management</span></div>
                                    <div class="tile-body" style="color:DodgerBlue;"><span>จัดการข้อมูลผู้ใช้</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" id="sers">
                            <div class="card">
                                <div class="card-body text-center">
                                    <div class="tile-heading"><span>Services Setting</span></div>
                                    <div class="tile-body" style="color:DodgerBlue;"><span>การกำหนดค่าใช้จ่าย</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" id="serm">
                            <div class="card">
                                <div class="card-body text-center">
                                    <div class="tile-heading"><span>Services management</span></div>
                                    <div class="tile-body" style="color:DodgerBlue;"><span>การจัดการการเข้าใช้บริการ </span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div id="shreg" class="col-md-12">
                    <div class="panel panel-blue">
                        <div class="panel-heading">
                            <h2>คำอธิบาย</h2>
                        </div>
                        <div class="panel-body" id="bodymenu">
                            <div class="col-md-6">
                                สมัครสมาชิก555
                            </div>
                        </div>
                    </div>
                </div>

                <div id="shmanu" class="col-md-12">
                    <div class="panel panel-blue">
                        <div class="panel-heading">
                            <h2>คำอธิบาย</h2>
                        </div>
                        <div class="panel-body" id="bodymenu">
                            <div class="col-md-6">
                                จัดการข้อมูลผู้ใช้
                            </div>
                        </div>
                    </div>
                </div>

                <div id="shsers" class="col-md-12">
                    <div class="panel panel-blue">
                        <div class="panel-heading">
                            <h2>คำอธิบาย</h2>
                        </div>
                        <div class="panel-body" id="bodymenu">
                            <div class="col-md-6">
                                การกำหนดค่าใช้จ่าย
                            </div>
                        </div>
                    </div>
                </div>

                <div id="shserm" class="col-md-12">
                    <div class="panel panel-blue">
                        <div class="panel-heading">
                            <h2>คำอธิบาย</h2>
                        </div>
                        <div class="panel-body" id="bodymenu">
                            <div class="col-md-6">
                                การจัดการการเข้าใช้บริการ
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>



</div> <!-- container-fluid -->
