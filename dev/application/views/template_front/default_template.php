<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>frontend/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>frontend/assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>
        Team Software Development Process
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url(); ?>frontend/assets/fonts/material-icons/materialicons.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>frontend/assets/fonts/Prompt/prompt.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>frontend/assets/fonts/Roboto/roboto.css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>frontend/assets/fonts/font-awesome/all.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>frontend/assets/fonts/font-awesome/v4-shims.min.css">

    <!--  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Prompt&amp;subset=thai"/>-->
    <!--  <link rel="stylesheet" type="text/css" href="https:/fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />-->
    <!--  <link rel="stylesheet" href="https:/maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">-->
    <!-- CSS Files -->
    <link href="<?php echo base_url(); ?>frontend/assets/css/material-dashboard-modify-4-frontend.css?v=2.1.0"
          rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>frontend/assets/css/material-kit.css?v=2.1.1" rel="stylesheet"/>
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="<?php echo base_url(); ?>frontend/assets/demo/demo.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>frontend/assets/demo/vertical-nav.css" rel="stylesheet"/>
    <!-- tui calendar -->
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url(); ?>backend/plugins/tui_calendar/tui-time-picker.css"/>
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url(); ?>backend/plugins/tui_calendar/tui-date-picker.css"/>
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url(); ?>backend/plugins/tui_calendar/tui-calendar.css"/>
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url(); ?>backend/plugins/tui_calendar/css/default.css"/>
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url(); ?>backend/plugins/tui_calendar/css/icons.css"/>
    <!-- highlight -->
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url(); ?>backend/plugins/highlight/default.min.css"/>

    <style type="text/css">
        <?php echo $styles; ?>
    </style>

    <!--   Core JS Files   -->
    <script src="<?php echo base_url(); ?>frontend/assets/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>frontend/assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>frontend/assets/js/core/bootstrap-material-design.min.js"
            type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>frontend/assets/js/plugins/moment.min.js"></script>
    <!-- tui calendar -->
    <script type="text/javascript"
            src="<?php echo base_url(); ?>backend/plugins/tui_calendar/tui-code-snippet.min.js"></script>
    <script type="text/javascript"
            src="<?php echo base_url(); ?>backend/plugins/tui_calendar/tui-time-picker.min.js"></script>
    <script type="text/javascript"
            src="<?php echo base_url(); ?>backend/plugins/tui_calendar/tui-date-picker.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/tui_calendar/moment-with-locales.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/tui_calendar/chance.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/tui_calendar/tui-calendar.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/tui_calendar/js/data/calendars.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/tui_calendar/js/data/schedules.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/tui_calendar/js/theme/dooray.js"></script>

    <script src="<?php echo base_url(); ?>frontend/assets/js/plugins/jquery.inputmask.min.js"></script>
    <script src="<?php echo base_url(); ?>frontend/assets/js/plugins/inputmask.binding.js"></script>

    <!-- select 2 -->
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url(); ?>backend/assets/plugins/form-select2/select2.css"/>
    <script src="<?php echo base_url(); ?>backend/assets/plugins/form-select2/select2.min.js"></script>


    <!--	Plugin for the Datepicker, full documentation here: https:/github.com/Eonasdan/bootstrap-datetimepicker -->
    <script src="<?php echo base_url(); ?>frontend/assets/js/plugins/bootstrap-datetimepicker.js"
            type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>backend/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"
            type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>backend/assets/plugins/bootstrap-datepicker/bootstrap-datepicker-custom.js"
            type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>backend/assets/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.th.min.js"
            type="text/javascript"></script>
    <!--  Plugin for the Sliders, full documentation here: http:/refreshless.com/nouislider/ -->
    <script src="<?php echo base_url(); ?>frontend/assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
    <!--  Google Maps Plugin    -->
    <!--<script src="https:/maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>-->
    <!--	Plugin for Tags, full documentation here: https:/github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
    <script src="<?php echo base_url(); ?>frontend/assets/js/plugins/bootstrap-tagsinput.js"></script>

    <script src="<?php echo base_url(); ?>frontend/assets/js/plugins/jquery.bootstrap-wizard.js"
            type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>frontend/assets/js/plugins/jquery.validate.min.js"
            type="text/javascript"></script>
    <!--	Plugin for Select, full documentation here: http:/silviomoreto.github.io/bootstrap-select -->
    <script src="<?php echo base_url(); ?>frontend/assets/js/plugins/bootstrap-selectpicker.js"
            type="text/javascript"></script>
    <!--	Plugin for Fileupload, full documentation here: http:/www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="<?php echo base_url(); ?>frontend/assets/js/plugins/jasny-bootstrap.min.js"
            type="text/javascript"></script>
    <!--	Plugin for Small Gallery in Product Page -->
    <script src="<?php echo base_url(); ?>frontend/assets/js/plugins/jquery.flexisel.js"
            type="text/javascript"></script>
    <!-- Plugins for presentation and navigation  -->
    <script src="<?php echo base_url(); ?>frontend/assets/demo/modernizr.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>frontend/assets/demo/vertical-nav.js" type="text/javascript"></script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <!--<script async defer src="https:/buttons.github.io/buttons.js"></script>-->
    <!-- Js With initialisations For Demo Purpose, Don't Include it in Your Project -->
    <script src="<?php echo base_url(); ?>frontend/assets/demo/demo.js" type="text/javascript"></script>
    <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
    <script src="<?php echo base_url(); ?>frontend/assets/js/material-kit.js?v=2.1.1" type="text/javascript"></script>


    <script type="text/javascript" src="<?php echo base_url(); ?>backend/assets/plugins/bootbox/bootbox.js"></script>
    <!-- Bootbox -->

</head>

<body class="">

<?php if (!$is_fancy) { ?>
    <?php $this->load->view('template_front/menu', $data); ?>
    <?php $this->load->view('template_front/page_header', $data); ?>
<?php } ?>
<?php if ($is_main){ ?>
<div class="main <?php if ($is_main_raised) { ?>main-raised<?php } ?>">
    <?php } ?>
    <?php $this->load->view($body, $data); ?>
    <?php if ($is_main){ ?>
</div>
<?php } ?>
<?php if (!$is_fancy) { ?>
    <?php $this->load->view('template_front/footer'); ?>
<?php } ?>
<!-- file code use tui_calendar -->
<!--<script src="--><?php //echo base_url();?><!--backend/plugins/tui_calendar/js/default.js"></script>-->

<!-- highlight -->
<script src="<?php echo base_url(); ?>backend/plugins/highlight/highlight.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        //init DateTimePickers
        materialKit.initFormExtendedDatetimepickers();

        // Sliders Init
        // materialKit.initSliders();
        $('.datepicker-thai').datetimepicker({
                format: 'DD/MM/YYYY',
                locale: 'th-TH',  // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.
                focusOnShow: false,
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down",
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-screenshot',
                    clear: 'fa fa-trash',
                    close: 'fa fa-remove'
                }
            }
        )
        // $('.datepicker-thai').datetimepicker({
        //     format: 'dd/mm/yyyy',
        //     locale: 'th',
        //     icons: {
        //         time: "fa fa-clock-o",
        //         date: "fa fa-calendar",
        //         up: "fa fa-chevron-up",
        //         down: "fa fa-chevron-down",
        //         previous: 'fa fa-chevron-left',
        //         next: 'fa fa-chevron-right',
        //         today: 'fa fa-screenshot',
        //         clear: 'fa fa-trash',
        //         close: 'fa fa-remove'
        //     }          //Set เป็นปี พ.ศ.
        // }).datepicker("setDate", "0");  //กำหนดเป็นวันปัจุบัน
        // Initialise the wizard
        demo = {
            initMaterialWizard: function () {
                // Code for the Validator
                var $validator = $('.card-wizard form').validate({
                    rules: {
                        firstname: {
                            required: true,
                            minlength: 3
                        },
                        lastname: {
                            required: true,
                            minlength: 3
                        },
                        email: {
                            required: true,
                            minlength: 3,
                        }
                    },

                    highlight: function (element) {
                        $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
                    },
                    success: function (element) {
                        $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
                    },
                    errorPlacement: function (error, element) {
                        $(element).append(error);
                    }
                });


                // Wizard Initialization
                $('.card-wizard').bootstrapWizard({
                    'tabClass': 'nav nav-pills',
                    'nextSelector': '.btn-next',
                    'previousSelector': '.btn-previous',

                    onNext: function (tab, navigation, index) {
                        var $valid = $('.card-wizard form').valid();
                        if (!$valid) {
                            $validator.focusInvalid();
                            return false;
                        }
                    },

                    onInit: function (tab, navigation, index) {
                        //check number of tabs and fill the entire row
                        var $total = navigation.find('li').length;
                        var $wizard = navigation.closest('.card-wizard');

                        $first_li = navigation.find('li:first-child a').html();
                        $moving_div = $('<div class="moving-tab">' + $first_li + '</div>');
                        $('.card-wizard .wizard-navigation').append($moving_div);

                        refreshAnimation($wizard, index);

                        $('.moving-tab').css('transition', 'transform 0s');
                    },

                    onTabClick: function (tab, navigation, index) {
                        var $valid = $('.card-wizard form').valid();

                        if (!$valid) {
                            return false;
                        } else {
                            return true;
                        }
                    },

                    onTabShow: function (tab, navigation, index) {
                        var $total = navigation.find('li').length;
                        var $current = index + 1;

                        var $wizard = navigation.closest('.card-wizard');

                        // If it's the last tab then hide the last button and show the finish instead
                        if ($current >= $total) {
                            $($wizard).find('.btn-next').hide();
                            $($wizard).find('.btn-finish').show();
                        } else {
                            $($wizard).find('.btn-next').show();
                            $($wizard).find('.btn-finish').hide();
                        }

                        button_text = navigation.find('li:nth-child(' + $current + ') a').html();

                        setTimeout(function () {
                            $('.moving-tab').text(button_text);
                        }, 150);

                        var checkbox = $('.footer-checkbox');

                        if (!index == 0) {
                            $(checkbox).css({
                                'opacity': '0',
                                'visibility': 'hidden',
                                'position': 'absolute'
                            });
                        } else {
                            $(checkbox).css({
                                'opacity': '1',
                                'visibility': 'visible'
                            });
                        }

                        refreshAnimation($wizard, index);
                    }
                });


                // Prepare the preview for profile picture
                $("#wizard-picture").change(function () {
                    readURL(this);
                });

                $('[data-toggle="wizard-radio"]').click(function () {
                    wizard = $(this).closest('.card-wizard');
                    wizard.find('[data-toggle="wizard-radio"]').removeClass('active');
                    $(this).addClass('active');
                    $(wizard).find('[type="radio"]').removeAttr('checked');
                    $(this).find('[type="radio"]').attr('checked', 'true');
                });

                $('[data-toggle="wizard-checkbox"]').click(function () {
                    if ($(this).hasClass('active')) {
                        $(this).removeClass('active');
                        $(this).find('[type="checkbox"]').removeAttr('checked');
                    } else {
                        $(this).addClass('active');
                        $(this).find('[type="checkbox"]').attr('checked', 'true');
                    }
                });

                $('.set-full-height').css('height', 'auto');

                //Function to show image before upload

                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }

                $(window).resize(function () {
                    $('.card-wizard').each(function () {
                        $wizard = $(this);

                        index = $wizard.bootstrapWizard('currentIndex');
                        refreshAnimation($wizard, index);

                        $('.moving-tab').css({
                            'transition': 'transform 0s'
                        });
                    });
                });

                function refreshAnimation($wizard, index) {
                    $total = $wizard.find('.nav li').length;
                    $li_width = 100 / $total;

                    total_steps = $wizard.find('.nav li').length;
                    move_distance = $wizard.width() / total_steps;
                    index_temp = index;
                    vertical_level = 0;

                    mobile_device = $(document).width() < 600 && $total > 3;

                    if (mobile_device) {
                        move_distance = $wizard.width() / 2;
                        index_temp = index % 2;
                        $li_width = 50;
                    }

                    $wizard.find('.nav li').css('width', $li_width + '%');

                    step_width = move_distance;
                    move_distance = move_distance * index_temp;

                    $current = index + 1;

                    if ($current == 1 || (mobile_device == true && (index % 2 == 0))) {
                        move_distance -= 8;
                    } else if ($current == total_steps || (mobile_device == true && (index % 2 == 1))) {
                        move_distance += 8;
                    }

                    if (mobile_device) {
                        vertical_level = parseInt(index / 2);
                        vertical_level = vertical_level * 38;
                    }

                    $wizard.find('.moving-tab').css('width', step_width);
                    $('.moving-tab').css({
                        'transform': 'translate3d(' + move_distance + 'px, ' + vertical_level + 'px, 0)',
                        'transition': 'all 0.5s cubic-bezier(0.29, 1.42, 0.79, 1)'

                    });
                }
            },
        };

        demo.initMaterialWizard();
        setTimeout(function () {
            $('.card.card-wizard').addClass('active');
        }, 600);
    });
</script>
<script type="text/javascript">
    <?php echo $scripts; ?>
</script>
</body>

</html>