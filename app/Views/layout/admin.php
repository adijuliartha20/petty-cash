<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $title; ?></title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="template language" name="keywords">
    <meta content="Tamerlan Soziev" name="author">
    <meta content="Admin dashboard html template" name="description">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="<?php echo base_url(); ?>/favicon.png" rel="shortcut icon">
    <link href="apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>/bower_components/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/bower_components/dropzone/dist/dropzone.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/bower_components/slick-carousel/slick/slick.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/css/main.css?version=4.5.0" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/css/style.css?version=1.0" rel="stylesheet">
    
  </head>
  <body class="menu-position-side menu-side-left full-screen">
    <div class="all-wrapper solid-bg-all">
      <div class="search-with-suggestions-w">
        <div class="search-with-suggestions-modal">
          <div class="element-search">
            <input class="search-suggest-input" placeholder="Start typing to search..." type="text">
              <div class="close-search-suggestions">
                <i class="os-icon os-icon-x"></i>
              </div>
            </input>
          </div>
          <div class="search-suggestions-group">
            <div class="ssg-header">
              <div class="ssg-icon">
                <div class="os-icon os-icon-box"></div>
              </div>
              <div class="ssg-name">
                Projects
              </div>
              <div class="ssg-info">
                24 Total
              </div>
            </div>
            <div class="ssg-content">
              <div class="ssg-items ssg-items-boxed">
                <a class="ssg-item" href="users_profile_big.html">
                  <div class="item-media" style="background-image: url(<?php echo base_url(); ?>/img/company6.png)"></div>
                  <div class="item-name">
                    Integ<span>ration</span> with API
                  </div>
                </a><a class="ssg-item" href="users_profile_big.html">
                  <div class="item-media" style="background-image: url(<?php echo base_url(); ?>/img/company7.png)"></div>
                  <div class="item-name">
                    Deve<span>lopm</span>ent Project
                  </div>
                </a>
              </div>
            </div>
          </div>
          <div class="search-suggestions-group">
            <div class="ssg-header">
              <div class="ssg-icon">
                <div class="os-icon os-icon-users"></div>
              </div>
              <div class="ssg-name">
                Customers
              </div>
              <div class="ssg-info">
                12 Total
              </div>
            </div>
            <div class="ssg-content">
              <div class="ssg-items ssg-items-list">
                <a class="ssg-item" href="users_profile_big.html">
                  <div class="item-media" style="background-image: url(<?php echo base_url(); ?>/img/avatar1.jpg)"></div>
                  <div class="item-name">
                    John Ma<span>yer</span>s
                  </div>
                </a><a class="ssg-item" href="users_profile_big.html">
                  <div class="item-media" style="background-image: url(<?php echo base_url(); ?>/img/avatar2.jpg)"></div>
                  <div class="item-name">
                    Th<span>omas</span> Mullier
                  </div>
                </a><a class="ssg-item" href="users_profile_big.html">
                  <div class="item-media" style="background-image: url(<?php echo base_url(); ?>/img/avatar3.jpg)"></div>
                  <div class="item-name">
                    Kim C<span>olli</span>ns
                  </div>
                </a>
              </div>
            </div>
          </div>
          <div class="search-suggestions-group">
            <div class="ssg-header">
              <div class="ssg-icon">
                <div class="os-icon os-icon-folder"></div>
              </div>
              <div class="ssg-name">
                Files
              </div>
              <div class="ssg-info">
                17 Total
              </div>
            </div>
            <div class="ssg-content">
              <div class="ssg-items ssg-items-blocks">
                <a class="ssg-item" href="#">
                  <div class="item-icon">
                    <i class="os-icon os-icon-file-text"></i>
                  </div>
                  <div class="item-name">
                    Work<span>Not</span>e.txt
                  </div>
                </a><a class="ssg-item" href="#">
                  <div class="item-icon">
                    <i class="os-icon os-icon-film"></i>
                  </div>
                  <div class="item-name">
                    V<span>ideo</span>.avi
                  </div>
                </a><a class="ssg-item" href="#">
                  <div class="item-icon">
                    <i class="os-icon os-icon-database"></i>
                  </div>
                  <div class="item-name">
                    User<span>Tabl</span>e.sql
                  </div>
                </a><a class="ssg-item" href="#">
                  <div class="item-icon">
                    <i class="os-icon os-icon-image"></i>
                  </div>
                  <div class="item-name">
                    wed<span>din</span>g.jpg
                  </div>
                </a>
              </div>
              <div class="ssg-nothing-found">
                <div class="icon-w">
                  <i class="os-icon os-icon-eye-off"></i>
                </div>
                <span>No files were found. Try changing your query...</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="layout-w">
        <!--------------------
        START - Mobile Menu
        -------------------->
        <div class="menu-mobile menu-activated-on-click color-scheme-dark">
          <div class="mm-logo-buttons-w">
            <a class="mm-logo" href="index.html"><img src="<?php echo base_url(); ?>/img/logo.png"><span>Pondok Lensa</span></a>
            <div class="mm-buttons">
              <div class="content-panel-open">
                <div class="os-icon os-icon-grid-circles"></div>
              </div>
              <div class="mobile-menu-trigger">
                <div class="os-icon os-icon-hamburger-menu-1"></div>
              </div>
            </div>
          </div>
          <div class="menu-and-user">
            <div class="logged-user-w">
              <div class="avatar-w">
                <img alt="" src="<?php echo base_url(); ?>/img/avatar1.jpg">
              </div>
              <div class="logged-user-info-w">
                <div class="logged-user-name">
                  Maria Gomez
                </div>
                <div class="logged-user-role">
                  Administrator
                </div>
              </div>
            </div>
            <!--------------------
            START - Mobile Menu List
            -------------------->
            <ul class="main-menu">
              <li class="has-sub-menu">
                <a href="/record-petty-cash">
                  <div class="icon-w">
                    <div class="os-icon os-icon-folder"></div>
                  </div>
                  <span>Record</span></a>
                <ul class="sub-menu">
                  <li>
                    <a href="/record-klaim">Klaim</a>
                  </li>
                  <li>
                    <a href="/record-reimburse">Reimburse</a>
                  </li>
                  <li>
                    <a href="/record-kas">Kas</a>
                  </li>
                </ul>
              </li>
              <li class="has-sub-menu">
                <a href="/report-petty-cash">
                  <div class="icon-w">
                    <div class="os-icon os-icon-file-text"></div>
                  </div>
                  <span>Report</span></a>
                <ul class="sub-menu">
                  <li>
                    <a href="/report-petty-cash">Petty Cash</a>
                  </li>
                  <li>
                    <a href="/report-petty-cash-detail">Petty Cash Detail</a>
                  </li>
                </ul>
              </li>
              <li class="has-sub-menu">
                <a href="index.html">
                  <div class="icon-w">
                    <div class="os-icon os-icon-layout"></div>
                  </div>
                  <span>Master</span></a>
                <ul class="sub-menu">
                  <li>
                    <a href="/kota">City</a>
                  </li>
                  <li>
                    <a href="/area">Area</a>
                  </li>
                  <li>
                    <a href="/site">Site</a>
                  </li>
                  <li>
                    <a href="/petty-cash-group">Petty Cash Group</a>
                  </li>
                </ul>
              </li>
              <li class="has-sub-menu">
                <a href="/user-petty-cash">
                  <div class="icon-w">
                    <div class="os-icon os-icon-user"></div>
                  </div>
                  <span>User</span></a>
                <ul class="sub-menu">
                  <li>
                    <a href="/user-petty-cash">User</a>
                  </li>
                  <li>
                    <a href="/user-group">User Group</a>
                  </li>
                </ul>
              </li>
            </ul>
            <!--------------------
            END - Mobile Menu List
            -------------------->
          </div>
        </div>
        <!--------------------
        END - Mobile Menu
        --------------------><!--------------------
        START - Main Menu
        -------------------->
        <div class="menu-w color-scheme-light color-style-transparent menu-position-side menu-side-left menu-layout-compact sub-menu-style-over sub-menu-color-bright selected-menu-color-light menu-activated-on-hover menu-has-selected-link">
          <div class="logo-w">
            <a class="logo" href="index.html">
              <div class="logo-element"></div>
              <div class="logo-label">
                Pondok Lensa
              </div>
            </a>
          </div>
          <div class="logged-user-w avatar-inline">
            <div class="logged-user-i">
              <div class="avatar-w">
                <img alt="" src="<?php echo base_url(); ?>/img/avatar1.jpg">
              </div>
              <div class="logged-user-info-w">
                <div class="logged-user-name">
                  Adi Juliartha
                </div>
                <div class="logged-user-role">
                  Administrator
                </div>
              </div>
              <div class="logged-user-toggler-arrow">
                <div class="os-icon os-icon-chevron-down"></div>
              </div>
              <div class="logged-user-menu color-style-bright">
                <div class="logged-user-avatar-info">
                  <div class="avatar-w">
                    <img alt="" src="<?php echo base_url(); ?>/img/avatar1.jpg">
                  </div>
                  <div class="logged-user-info-w">
                    <div class="logged-user-name">
                      Adi Juliartha
                    </div>
                    <div class="logged-user-role">
                      Administrator
                    </div>
                  </div>
                </div>
                <div class="bg-icon">
                  <i class="os-icon os-icon-wallet-loaded"></i>
                </div>
                <ul>
                  <li>
                    <a href="users_profile_big.html"><i class="os-icon os-icon-user-male-circle2"></i><span>Profile Details</span></a>
                  <li>
                    <a href="#"><i class="os-icon os-icon-signs-11"></i><span>Logout</span></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <h1 class="menu-page-header">
            Page Header
          </h1>
          <ul class="main-menu">
            <li class="sub-header">
              <span>Record</span>
            </li>
            <li class="has-sub-menu">
              <a href="/record-klaim">
                <div class="icon-w">
                  <div class="os-icon os-icon-folder"></div>
                </div>
                <span>Klaim</span></a>
              <div class="sub-menu-w">
                <div class="sub-menu-header">
                  Klaim
                </div>
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-folder"></i>
                </div>
                <div class="sub-menu-i">
                  <ul class="sub-menu">
                    <li>
                      <a href="/record-klaim">Data Klaim</a>
                    </li>
                    <li>
                      <a href="/record-klaim/create">Tambah Klaim Baru</a>
                    </li>                    
                  </ul>
                </div>
              </div>               
            </li>
            <li class="has-sub-menu">
              <a href="/record-reimburse">
                <div class="icon-w">
                  <div class="os-icon os-icon-folder"></div>
                </div>
                <span>Reimburse</span></a>
              <div class="sub-menu-w">
                <div class="sub-menu-header">
                  Reimburse
                </div>
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-folder"></i>
                </div>
                <div class="sub-menu-i">
                  <ul class="sub-menu">
                    <li>
                      <a href="/record-reimburse">Data Reimburse</a>
                    </li>
                    <li>
                      <a href="/record-reimburse/create">Tambah Reimburse Baru</a>
                    </li>                    
                  </ul>
                </div>
              </div>              
            </li>
            <li class="has-sub-menu">
              <a href="/record-kas">
                <div class="icon-w">
                  <div class="os-icon os-icon-folder"></div>
                </div>
                <span>Kas</span></a>
              <div class="sub-menu-w">
                <div class="sub-menu-header">
                  Kas
                </div>
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-folder"></i>
                </div>
                <div class="sub-menu-i">
                  <ul class="sub-menu">
                    <li>
                      <a href="/record-kas">Data Kas</a>
                    </li>
                    <li>
                      <a href="/record-kas/create">Tambah Kas Baru</a>
                    </li>                    
                  </ul>
                </div>
              </div>

            </li>
            <li class="sub-header">
              <span>Report</span>
            </li>
            <li>
              <a href="/report-petty-cash">
                <div class="icon-w">
                  <div class="os-icon os-icon-file-text"></div>
                </div>
                <span>Petty Cash</span></a>              
            </li>
            <li>
              <a href="/report-petty-cash-detail">
                <div class="icon-w">
                  <div class="os-icon os-icon-file-text"></div>
                </div>
                <span>Petty Cash Detail</span></a>              
            </li>

            <li class="sub-header">
              <span>Master</span>
            </li> 



            <li class="has-sub-menu">
              <a href="/kota">
                <div class="icon-w">
                  <div class="os-icon os-icon-layout"></div>
                </div>
                <span>Kota</span></a>
              <div class="sub-menu-w">
                <div class="sub-menu-header">
                  Kota
                </div>
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-layout"></i>
                </div>
                <div class="sub-menu-i">
                  <ul class="sub-menu">
                    <li>
                      <a href="/kota">Data Kota</a>
                    </li>
                    <li>
                      <a href="/kota/create">Tambah Kota Baru</a>
                    </li>                    
                  </ul>
                </div>
              </div>

            </li> 
            <li class="has-sub-menu">
              <a href="/area">
                <div class="icon-w">
                  <div class="os-icon os-icon-layout"></div>
                </div>
                <span>Area</span></a>              
              <div class="sub-menu-w">
                <div class="sub-menu-header">
                  Area
                </div>
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-layout"></i>
                </div>
                <div class="sub-menu-i">
                  <ul class="sub-menu">
                    <li>
                      <a href="/area">Data Area</a>
                    </li>
                    <li>
                      <a href="/area/create">Tambah Area Baru</a>
                    </li>                    
                  </ul>
                </div>
              </div>
            </li>
            <li class="has-sub-menu">
              <a href="/site">
                <div class="icon-w">
                  <div class="os-icon os-icon-layout"></div>
                </div>
                <span>Site</span></a>
              <div class="sub-menu-w">
                <div class="sub-menu-header">
                  Site
                </div>
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-layout"></i>
                </div>
                <div class="sub-menu-i">
                  <ul class="sub-menu">
                    <li>
                      <a href="/site">Data Site</a>
                    </li>
                    <li>
                      <a href="/site/create">Tambah Site Baru</a>
                    </li>                    
                  </ul>
                </div>
              </div>              
            </li>
            <li class="has-sub-menu">
              <a href="/petty-cash-group">
                <div class="icon-w">
                  <div class="os-icon os-icon-layout"></div>
                </div>
                <span>Petty Cash Group</span></a> 

              <div class="sub-menu-w">
                <div class="sub-menu-header">
                  Petty Cash Group
                </div>
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-layout"></i>
                </div>
                <div class="sub-menu-i">
                  <ul class="sub-menu">
                    <li>
                      <a href="/petty-cash-group">Data Petty Cash Group</a>
                    </li>
                    <li>
                      <a href="/petty-cash-group/create">Tambah Petty Cash Group Baru</a>
                    </li>                    
                  </ul>
                </div>
              </div>              
            </li>

            

            <li class="sub-header">
              <span>User</span>
            </li>
            <li class="has-sub-menu">
              <a href="/user-petty-cash">
                <div class="icon-w">
                  <div class="os-icon os-icon-user"></div>
                </div>
                <span>User</span></a>
              <div class="sub-menu-w">
                <div class="sub-menu-header">
                  User
                </div>
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-user"></i>
                </div>
                <div class="sub-menu-i">
                  <ul class="sub-menu">
                    <li>
                      <a href="/user-petty-cash">Data User</a>
                    </li>
                    <li>
                      <a href="/user-petty-cash/create">Tambah User Baru</a>
                    </li>                    
                  </ul>
                </div>
              </div>              
            </li>  
            <li class="has-sub-menu">
              <a href="/user-group">
                <div class="icon-w">
                  <div class="os-icon os-icon-users"></div>
                </div>
                <span>User Group</span></a>
              <div class="sub-menu-w">
                <div class="sub-menu-header">
                  User Group
                </div>
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-users"></i>
                </div>
                <div class="sub-menu-i">
                  <ul class="sub-menu">
                    <li>
                      <a href="/user-group">Data User Group</a>
                    </li>
                    <li>
                      <a href="/user-group/create">Tambah User Group Baru</a>
                    </li>                    
                  </ul>
                </div>
              </div>             
            </li>
          </ul>
        </div>
        <!--------------------
        END - Main Menu
        -------------------->
        <div class="content-w">
          <!--------------------
          START - Top Bar
          -------------------->
          <div class="top-bar color-scheme-transparent">
            <!--------------------
            START - Top Menu Controls
            -------------------->
            <div class="top-menu-controls">
              <div class="element-search autosuggest-search-activator">
                <input placeholder="Start typing to search..." type="text">
              </div>
             <!--------------------
              START - User avatar and menu in secondary top menu
              -------------------->
              <div class="logged-user-w">
                <div class="logged-user-i">
                  <div class="avatar-w">
                    <img alt="" src="<?php echo base_url(); ?>/img/avatar1.jpg">
                  </div>
                  <div class="logged-user-menu color-style-bright">
                    <div class="logged-user-avatar-info">
                      <div class="avatar-w">
                        <img alt="" src="<?php echo base_url(); ?>/img/avatar1.jpg">
                      </div>
                      <div class="logged-user-info-w">
                        <div class="logged-user-name">
                          Adi Juliartha
                        </div>
                        <div class="logged-user-role">
                          Administrator
                        </div>
                      </div>
                    </div>
                    <div class="bg-icon">
                      <i class="os-icon os-icon-wallet-loaded"></i>
                    </div>
                    <ul>
                      <li>
                        <a href="users_profile_big.html"><i class="os-icon os-icon-user-male-circle2"></i><span>Profile Details</span></a>
                      </li>
                      <li>
                        <a href="#"><i class="os-icon os-icon-signs-11"></i><span>Logout</span></a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <!--------------------
              END - User avatar and menu in secondary top menu
              -------------------->
            </div>
            <!--------------------
            END - Top Menu Controls
            -------------------->
          </div>
          <!--------------------
          END - Top Bar
          --------------------><!--------------------
          START - Breadcrumbs
          -------------------->
          <ul class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.html">Home</a>
            </li>
            <li class="breadcrumb-item">
              <a href="index.html">Products</a>
            </li>
            <li class="breadcrumb-item">
              <span>Laptop with retina screen</span>
            </li>
          </ul>
          <!--------------------
          END - Breadcrumbs
          -------------------->
          


          <!-- START content -->
          <?= $this->renderSection('content'); ?>
          <!-- END content -->


        </div>
      </div>
    </div>
    <script src="<?php echo base_url(); ?>/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>/bower_components/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>/bower_components/moment/moment.js"></script>
    <script src="<?php echo base_url(); ?>/bower_components/chart.js/dist/Chart.min.js"></script>
    <script src="<?php echo base_url(); ?>/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo base_url(); ?>/bower_components/jquery-bar-rating/dist/jquery.barrating.min.js"></script>
    <script src="<?php echo base_url(); ?>/bower_components/ckeditor/ckeditor.js"></script>
    <script src="<?php echo base_url(); ?>/bower_components/bootstrap-validator/dist/validator.min.js"></script>
    <script src="<?php echo base_url(); ?>/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo base_url(); ?>/bower_components/ion.rangeSlider/js/ion.rangeSlider.min.js"></script>
    <script src="<?php echo base_url(); ?>/bower_components/dropzone/dist/dropzone.js"></script>
    <script src="<?php echo base_url(); ?>/bower_components/editable-table/mindmup-editabletable.js"></script>
    <script src="<?php echo base_url(); ?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="<?php echo base_url(); ?>/bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>/bower_components/tether/dist/js/tether.min.js"></script>
    <script src="<?php echo base_url(); ?>/bower_components/slick-carousel/slick/slick.min.js"></script>
    <script src="<?php echo base_url(); ?>/bower_components/bootstrap/js/dist/util.js"></script>
    <script src="<?php echo base_url(); ?>/bower_components/bootstrap/js/dist/alert.js"></script>
    <script src="<?php echo base_url(); ?>/bower_components/bootstrap/js/dist/button.js"></script>
    <script src="<?php echo base_url(); ?>/bower_components/bootstrap/js/dist/carousel.js"></script>
    <script src="<?php echo base_url(); ?>/bower_components/bootstrap/js/dist/collapse.js"></script>
    <script src="<?php echo base_url(); ?>/bower_components/bootstrap/js/dist/dropdown.js"></script>
    <script src="<?php echo base_url(); ?>/bower_components/bootstrap/js/dist/modal.js"></script>
    <script src="<?php echo base_url(); ?>/bower_components/bootstrap/js/dist/tab.js"></script>
    <script src="<?php echo base_url(); ?>/bower_components/bootstrap/js/dist/tooltip.js"></script>
    <script src="<?php echo base_url(); ?>/bower_components/bootstrap/js/dist/popover.js"></script>
    <script src="<?php echo base_url(); ?>/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>/js/demo_customizer.js?version=4.5.0"></script>
    <script src="<?php echo base_url(); ?>/js/main.js?version=4.5.0"></script>
    <script src="<?php echo base_url(); ?>/js/script.js?version=1.0"></script>
    <?php if(isset($appName) && $appName=='report') :?>
      <script src="<?php echo base_url(); ?>/js/scriptReport.js?version=1.0"></script>
    <?php endif;?>
    <?php if(isset($appName) && $appName=='report-detail') :?>
      <script src="<?php echo base_url(); ?>/js/scriptReportDetail.js?version=1.0"></script>
    <?php endif;?>  
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
      
      ga('create', 'UA-XXXXXXXX-9', 'auto');
      ga('send', 'pageview');
    </script>
  </body>
</html>
