<!DOCTYPE html>
<html lang="th">

<head>
    <?php $this->load->view('template/header', $datas);?>
</head>

<body class="">
  <div class="wrapper ">
      <?php $this->load->view('template/sidebar', $datas); ?>
    <div class="main">
        <?php $this->load->view('template/topbar', $datas); ?>
        <?php $this->load->view('template/scripts', $datas);?>
      <!-- End Navbar -->
      <div class="content">
          <div class="container">
              <div class="row">
                  <div class="col-md-10 ml-auto mr-auto">
                      <div class="card card-signup">
                          <h2 class="card-title text-center">Login</h2>
                          <div class="card-body">
                              <form class="form" method="post" id="validate-form"
                                    action="<?php echo site_url("gear/checklogin"); ?>">
                                  <div class="modal-body">
                                      <p class="description text-center"></p>
                                      <div class="card-body">
                                          <div class="form-group">
                                              <div class="input-group">
                                                  <div class="input-group-prepend">
                                          <span class="input-group-text">
                                            <i class="material-icons">face</i>
                                          </span>
                                                  </div>
                                                  <div class="form-group" style="width: 82%;">
                                                      <label for="username" class="bmd-label-floating">Username</label>
                                                      <input type="text" class="form-control" id="username" name="username">
                                                      <span class="bmd-help"></span>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <div class="input-group">
                                                  <div class="input-group-prepend">
                                          <span class="input-group-text">
                                            <i class="material-icons">lock_outline</i>
                                          </span>
                                                  </div>
                                                  <div class="form-group" style="width: 82%;">
                                                      <label for="password" class="bmd-label-floating">Password</label>
                                                      <input type="password" class="form-control" id="password" name="password">
                                                      <span class="bmd-help"></span>
                                                  </div>
                                              </div>
                                          </div>
                                          <input type="hidden" name="type_view" value="1">

                                      </div>
                                  </div>
                                  <div class="modal-footer justify-content-center" style="padding-bottom: 20px;">
                                      <button type="submit" class="btn btn-primary btn-simple btn-wd btn-lg">LOGIN</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
        <?php $this->load->view('template/footer', $datas);?>
    </div>
  </div>
</body>

</html>