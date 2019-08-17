<div class="container">
    <div class="row" style="padding-top: 10vh;">
        <?php foreach ($rs_sys as $row_sys) { ?>
            <div class="col-md-6 col-lg-4">
                <div class="rotating-card-container" style="height: 252px; margin-bottom: 30px;">
                    <div class="card card-rotate">
                        <div class="front" style="height: 252px; width: 360px;">
                            <div class="card-content">
                                <h4 class="category-social text-success">
                                    <i class="fab fa-newspaper-o"></i> <?php echo $row_sys->StNameT; ?>
                                </h4>

                                <h4 class="card-title">
                                    <?php echo $row_sys->StDesc; ?>
                                </h4>
                                <p class="card-description">
                                </p>

                            </div>
                        </div>

                        <div class="back" style="height: 252px; width: 360px;">
                            <div class="card-content">
                                <h5 class="card-title">
                                    <?php echo $row_sys->StDesc; ?>
                                </h5>
                                <p class="card-description">
                                </p>
                                <div class="footer text-center">
                                    <a href="<?php echo site_url() . "/" . $row_sys->StURL; ?>"
                                       class="btn btn-rose btn-round">
                                        <i class="material-icons">arrow_forward_ios</i> GO
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

