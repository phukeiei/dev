<?php if ($use_slide) { ?>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			<?php if(!$is_login){?>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
			<?php } ?>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="page-header header-filter header-small" style="background-image: url('<?php echo base_url();?>frontend/assets/img/dg1.jpg');">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 text-left">
                                <h1 class="title">Team Software Development Process</h1>
                                <h4></h4>
                                <br>
                                <div class="buttons">
                                    <a href="#pablo" class="btn btn-just-icon btn-white btn-link">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="#pablo" class="btn btn-just-icon btn-white btn-link">
                                        <i class="fab fa-facebook-square"></i>
                                    </a>
                                    <a href="#pablo" class="btn btn-just-icon btn-white btn-link">
                                        <i class="fab fa-get-pocket"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="page-header header-filter header-small" style="background-image: url('<?php echo base_url();?>frontend/assets/img/dg2.jpg');">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 ml-auto mr-auto text-center">
                                <h1 class="title">Team Software Development Process</h1>
                                <h4</h4>
                                <br>
                                <h6>Connect with us on:</h6>
                                <div class="buttons">
                                    <a href="#pablo" class="btn btn-just-icon btn-white btn-link btn-lg">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="#pablo" class="btn btn-just-icon btn-white btn-link btn-lg">
                                        <i class="fab fa-facebook-square"></i>
                                    </a>
                                    <a href="#pablo" class="btn btn-just-icon btn-white btn-link btn-lg">
                                        <i class="fab fa-google-plus"></i>
                                    </a>
                                    <a href="#pablo" class="btn btn-just-icon btn-white btn-link btn-lg">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<?php if(!$is_login){?>
            <div class="carousel-item">
                <div class="page-header header-filter header-small" style="background-image: url('<?php echo base_url();?>frontend/assets/img/dg3.jpg');">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7 ml-auto text-right">
                                <h1 class="title">Team Software Development Process</h1>
                                <h4></h4>
                                <br>
                                <div class="buttons">
                                    <a href="#signupModal" class="btn btn-rose btn-lg" data-toggle="modal" data-target="#signupModal" >
                                        <i class="material-icons">assignment</i> สมัครสมาชิก
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<?php }?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <i class="material-icons">keyboard_arrow_left</i>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <i class="material-icons">keyboard_arrow_right</i>
            <span class="sr-only">Next</span>
        </a>
    </div>
<?php } else { ?>

    <div class="page-header header-filter header-small" data-parallax="true"
         style="background-image: url('<?php echo $header_bg_img; ?>');">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-1">
                    <h1 class="title"><?php echo $header_title; ?></h1>
                    <h4><?php echo $header_description; ?></h4>
                </div>
            </div>
        </div>
    </div>

<?php } ?>