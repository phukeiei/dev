<!DOCTYPE html>
<html lang="th">

<head>
    <?php $this->load->view('template/header',$datas);?>
</head>

<body class="">
<div class="wrapper ">
    <div class="main-panel">
        <!--   Core JS Files   -->
        <script src="<?php echo base_url();?>assets/js/core/jquery.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/core/popper.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/core/bootstrap-material-design.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>

        <!-- Plugin for the momentJs  -->
        <script src="<?php echo base_url();?>assets/js/plugins/moment.min.js"></script>
        <!--  Plugin for Sweet Alert -->
        <script src="<?php echo base_url();?>assets/js/plugins/sweetalert2.js"></script>
        <!-- Forms Validations Plugin -->
        <script src="<?php echo base_url();?>assets/js/plugins/jquery.validate.min.js"></script>
        <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
        <script src="<?php echo base_url();?>assets/js/plugins/jquery.bootstrap-wizard.js"></script>
        <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
        <script src="<?php echo base_url();?>assets/js/plugins/bootstrap-selectpicker.js"></script>
        <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
        <script src="<?php echo base_url();?>assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
        <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
        <script src="<?php echo base_url();?>assets/js/plugins/jquery.dataTables.min.js"></script>
        <!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
        <script src="<?php echo base_url();?>assets/js/plugins/bootstrap-tagsinput.js"></script>
        <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
        <script src="<?php echo base_url();?>assets/js/plugins/jasny-bootstrap.min.js"></script>
        <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
        <script src="<?php echo base_url();?>assets/js/plugins/fullcalendar.min.js"></script>
        <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
        <script src="<?php echo base_url();?>assets/js/plugins/jquery-jvectormap.js"></script>
        <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
        <script src="<?php echo base_url();?>assets/js/plugins/nouislider.min.js"></script>
        <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
        <!-- Library for adding dinamically elements -->
        <script src="<?php echo base_url();?>assets/js/plugins/arrive.min.js"></script>
        <!--  Google Maps Plugin    -->
        <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
        <!-- Chartist JS -->
        <script src="<?php echo base_url();?>assets/js/plugins/chartist.min.js"></script>
        <!--  Notifications Plugin    -->
        <script src="<?php echo base_url();?>assets/js/plugins/bootstrap-notify.js"></script>
        <!-- select2 -->
        <script src="<?php echo base_url();?>assets/plugins/select2/js/select2.full.js" type="text/javascript"></script>
        <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="<?php echo base_url();?>assets/js/material-dashboard.js?v=2.1.0" type="text/javascript"></script>
        <!-- Material Dashboard AOS edition -->
        <script src="<?php echo base_url();?>assets/plugins/allosoft/aos-material.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/allosoft/aos-avenxo.js"></script>
        <!-- Code Prettifier  -->
        <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/codeprettifier/prettify.js"></script>

        <!-- plugins data aos defalut -->
        <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/allosoft/aos-defalut.js"></script>

        <!-- End Navbar -->
        <div class="content">
            <?php echo $views;?>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <nav class="float-left">
                    <ul>
                        <li>
                            <a href="https://www.aos.in.th" target='_blank'>
                                About Us
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright float-right">
                    <?php echo $this->config->item('txt_copyright'); ?>
                </div>
            </div>
        </footer>
    </div>
</div>
<?php if(isset($use_fixed) and $use_fixed !== false){?>
    <div class="fixed-plugin">
        <div class="dropdown show-dropdown">
            <a href="#" data-toggle="dropdown">
                <i class="fa fa-cog fa-2x"> </i>
            </a>
            <ul class="dropdown-menu">
                <?php foreach($fixed_datas as $fixed_data){?>
                    <li class="header-title"><?php echo $fixed_data['header-title']; ?></li>
                    <?php foreach($fixed_data['datas'] as $value_data_fixed) {?>
                        <li class="adjustments-line">
                            <a href="javascript:void(0)" class="<?php echo $value_data_fixed['class']; ?>">
                                <?php echo $value_data_fixed['value']; ?>
                                <div class="clearfix"></div>
                            </a>
                        </li>
                    <?php }
                }
                ?>
            </ul>
        </div>
    </div>
<?php } ?>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5cff79a0267b2e578531cc8b/1dh68aaoc';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->
</body>

</html>