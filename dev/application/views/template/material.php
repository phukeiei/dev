<!DOCTYPE html>
<html lang="th">

<head>
    <?php $this->load->view('template/header',$datas);?>
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="rose" data-background-color="white" data-image="">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="sidebar-wrapper">
        <div class="user">
          <div class="photo">
            <img src="<?php echo base_url();?>assets/img/faces/avatar.jpg" />
          </div>
          <div class="user-info">
            <a data-toggle="collapse" href="#collapseExample" class="username">
              <span>
                Tania Andrew
                <b class="caret"></b>
              </span>
            </a>
            <div class="collapse" id="collapseExample">
              <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <span class="sidebar-mini"> MP </span>
                    <span class="sidebar-normal"> My Profile </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <span class="sidebar-mini"> EP </span>
                    <span class="sidebar-normal"> Edit Profile </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <span class="sidebar-mini"> S </span>
                    <span class="sidebar-normal"> Settings </span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <ul class="nav">
          <li class="nav-item ">
            <a class="nav-link" href="<?php echo site_url();?>/HCI_MTK/Dashboard">
              <i class="material-icons">dashboard</i>
              <p> Dashboard </p>
            </a>
          </li>
          <li class="nav-item ">  
            <a class="nav-link" data-toggle="collapse" href="#pagesExamples">
              <i class="material-icons">image</i>
              <p> Pages
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse" id="pagesExamples">
              <ul class="nav">
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo site_url();?>/HCI_MTK/Base">
                    <span class="sidebar-mini"> B </span>
                    <span class="sidebar-normal"> Ex-Base </span>
                  </a>
                </li>			  
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo site_url();?>/HCI_MTK/Pricing">
                    <span class="sidebar-mini"> P </span>
                    <span class="sidebar-normal"> Pricing </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo site_url();?>/HCI_MTK/Rtl">
                    <span class="sidebar-mini"> RS </span>
                    <span class="sidebar-normal"> RTL Support </span>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo site_url();?>/HCI_MTK/Timeline">
                    <span class="sidebar-mini"> T </span>
                    <span class="sidebar-normal"> Timeline </span>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo site_url();?>/HCI_MTK/Login">
                    <span class="sidebar-mini"> LP </span>
                    <span class="sidebar-normal"> Login Page </span>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo site_url();?>/HCI_MTK/Register">
                    <span class="sidebar-mini"> RP </span>
                    <span class="sidebar-normal"> Register Page </span>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo site_url();?>/HCI_MTK/Lock">
                    <span class="sidebar-mini"> LSP </span>
                    <span class="sidebar-normal"> Lock Screen Page </span>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo site_url();?>/HCI_MTK/User">
                    <span class="sidebar-mini"> UP </span>
                    <span class="sidebar-normal"> User Profile </span>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo site_url();?>/HCI_MTK/Error2">
                    <span class="sidebar-mini"> E </span>
                    <span class="sidebar-normal"> Error Page </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item active">
            <a class="nav-link" data-toggle="collapse" href="#componentsExamples">
              <i class="material-icons">apps</i>
              <p> Components
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse show" id="componentsExamples">
              <ul class="nav">
                <li class="nav-item active">
                  <a class="nav-link" href="<?php echo site_url();?>/HCI_MTK/Buttons">
                    <span class="sidebar-mini"> B </span>
                    <span class="sidebar-normal"> Buttons </span>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo site_url();?>/HCI_MTK/Grid">
                    <span class="sidebar-mini"> GS </span>
                    <span class="sidebar-normal"> Grid System </span>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo site_url();?>/HCI_MTK/Panels">
                    <span class="sidebar-mini"> P </span>
                    <span class="sidebar-normal"> Panels </span>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo site_url();?>/HCI_MTK/Sweet_alert">
                    <span class="sidebar-mini"> SA </span>
                    <span class="sidebar-normal"> Sweet Alert </span>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo site_url();?>/HCI_MTK/Notifications">
                    <span class="sidebar-mini"> N </span>
                    <span class="sidebar-normal"> Notifications </span>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo site_url();?>/HCI_MTK/Icons">
                    <span class="sidebar-mini"> I </span>
                    <span class="sidebar-normal"> Icons </span>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo site_url();?>/HCI_MTK/Typography">
                    <span class="sidebar-mini"> T </span>
                    <span class="sidebar-normal"> Typography </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#formsExamples">
              <i class="material-icons">content_paste</i>
              <p> Forms
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse" id="formsExamples">
              <ul class="nav">
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo site_url();?>/HCI_MTK/Regular">
                    <span class="sidebar-mini"> RF </span>
                    <span class="sidebar-normal"> Regular Forms </span>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo site_url();?>/HCI_MTK/Extended">
                    <span class="sidebar-mini"> EF </span>
                    <span class="sidebar-normal"> Extended Forms </span>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo site_url();?>/HCI_MTK/Validation">
                    <span class="sidebar-mini"> VF </span>
                    <span class="sidebar-normal"> Validation Forms </span>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo site_url();?>/HCI_MTK/Wizard">
                    <span class="sidebar-mini"> W </span>
                    <span class="sidebar-normal"> Wizard </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#tablesExamples">
              <i class="material-icons">grid_on</i>
              <p> Tables
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse" id="tablesExamples">
              <ul class="nav">
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo site_url();?>/HCI_MTK/Regular_table">
                    <span class="sidebar-mini"> RT </span>
                    <span class="sidebar-normal"> Regular Tables </span>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo site_url();?>/HCI_MTK/Extended_table">
                    <span class="sidebar-mini"> ET </span>
                    <span class="sidebar-normal"> Extended Tables </span>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo site_url();?>/HCI_MTK/Datatables">
                    <span class="sidebar-mini"> DT </span>
                    <span class="sidebar-normal"> DataTables.net </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#mapsExamples">
              <i class="material-icons">place</i>
              <p> Maps
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse" id="mapsExamples">
              <ul class="nav">
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo site_url();?>/HCI_MTK/Google">
                    <span class="sidebar-mini"> GM </span>
                    <span class="sidebar-normal"> Google Maps </span>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo site_url();?>/HCI_MTK/Fullscreen">
                    <span class="sidebar-mini"> FSM </span>
                    <span class="sidebar-normal"> Full Screen Map </span>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo site_url();?>/HCI_MTK/Vector">
                    <span class="sidebar-mini"> VM </span>
                    <span class="sidebar-normal"> Vector Map </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="<?php echo site_url();?>/HCI_MTK/Widgets">
              <i class="material-icons">widgets</i>
              <p> Widgets </p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="<?php echo site_url();?>/HCI_MTK/Charts">
              <i class="material-icons">timeline</i>
              <p> Charts </p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="<?php echo site_url();?>/HCI_MTK/Calendar">
              <i class="material-icons">date_range</i>
              <p> Calendar </p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-minimize">
              <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form">
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">notifications</i>
                  <span class="notification">5</span>
                  <p class="d-lg-none d-md-block">
                    Some Actions
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Mike John responded to your email</a>
                  <a class="dropdown-item" href="#">You have 5 new tasks</a>
                  <a class="dropdown-item" href="#">You're now friend with Andrew</a>
                  <a class="dropdown-item" href="#">Another Notification</a>
                  <a class="dropdown-item" href="#">Another One</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="#">Profile</a>
                  <a class="dropdown-item" href="#">Settings</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Log out</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
        <?php $this->load->view('template/scripts', $datas);?>
      <!-- End Navbar -->
      <div class="content">
        <?php echo $views;?>
      </div>
        <?php $this->load->view('template/footer', $datas);?>
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
</body>

</html>