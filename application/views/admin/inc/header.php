<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="BAT Foundation">
  <meta name="keywords" content="bat, bat foundation, events, news, projects, games">
  <meta name="author" content="Metro">
  <title>BAT Foundation</title>
  <link rel="apple-touch-icon" href="<?=base_url()?>/app-assets/images/ico/apple-icon-120.png">
  <link rel="shortcut icon" type="image/x-icon" href="<?=base_url()?>/app-assets/images/ico/favicon.ico">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i"
  rel="stylesheet">
  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>/app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>/app-assets/vendors/css/extensions/unslider.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>/app-assets/vendors/css/weather-icons/climacons.min.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>/app-assets/fonts/meteocons/style.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>/app-assets/vendors/css/charts/morris.css">
  <!-- END VENDOR CSS-->
  <!-- datatable -->
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>/app-assets/vendors/css/tables/datatable/datatables.min.css">
  <!-- BEGIN STACK CSS-->
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>/app-assets/css/app.css">
  <!-- END STACK CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>/app-assets/css/core/menu/menu-types/horizontal-menu.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>/app-assets/fonts/simple-line-icons/style.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>/app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>/app-assets/css/pages/timeline.css">
  <!--datetime picker -->
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>/app-assets/vendors/css/pickers/daterange/daterangepicker.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>/app-assets/vendors/css/pickers/datetime/bootstrap-datetimepicker.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>/app-assets/vendors/css/pickers/pickadate/pickadate.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>/app-assets/css/plugins/pickers/daterange/daterange.css">
 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/css/style.css">
  <!-- END Custom CSS-->
</head>
<body class="horizontal-layout horizontal-menu 2-columns   menu-expanded" data-open="click"
data-menu="horizontal-menu" data-col="2-columns">
  <!-- fixed-top-->
  <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-static-top navbar-light navbar-border navbar-brand-center">
    <div class="navbar-wrapper">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
          <li class="nav-item">
            <a class="navbar-brand" href="javascript:void(0)">
              <img class="brand-logo" alt="BAT Logo" src="<?=base_url()?>/app-assets/images/logo/stack-logo.png">
              <h2 class="brand-text">Admin Portal</h2>
            </a>
          </li>
          <li class="nav-item d-md-none">
            <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="fa fa-ellipsis-v"></i></a>
          </li>
        </ul>
      </div>
      <div class="navbar-container container center-layout">
        <div class="collapse navbar-collapse" id="navbar-mobile">
          <ul class="nav navbar-nav mr-auto float-left">
            <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
          </ul>
          <ul class="nav navbar-nav float-right">
            <li class="dropdown dropdown-user nav-item">
              <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <span class="avatar avatar-online">
                  <img src="<?=base_url()?>/app-assets/images/portrait/small/avatar-s-1.png" alt="avatar"><i></i></span>
                <span class="user-name">Welcome, <?php echo $this->session->userdata('full_name'); ?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="<?=site_url('admin/logout')?>"><i class="ft-power"></i>Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- Horizontal navigation-->
  <div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-light navbar-without-dd-arrow navbar-shadow menu-border"
  role="navigation" data-menu="menu-wrapper">
    <!-- Horizontal menu content-->
    <div class="navbar-container main-menu-content container center-layout" data-menu="menu-container">
      <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
        <li class="" data-menu="">
          <a class="nav-link" href="<?=site_url('dashboard/index')?>"><i class="ft-home"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="ft-box"></i><span>Modules</span></a>
          <ul class="dropdown-menu">
            <li data-menu="dropdown-submenu"><a class="dropdown-item" href="<?=site_url('dashboard/events')?>" data-toggle="dropdown">Events Arena</a>
            </li>
            <li data-menu="dropdown-submenu"><a class="dropdown-item" href="<?=site_url('dashboard/projects')?>" data-toggle="dropdown">Projects Arena</a>
            </li>
            <li data-menu="dropdown-submenu"><a class="dropdown-item" href="<?=site_url('dashboard/newsitem')?>" data-toggle="dropdown">News Articles</a>
            </li>
            <li data-menu="dropdown-submenu"><a class="dropdown-item" href="#" data-toggle="dropdown">Games</a>
            </li>
            <li data-menu="dropdown-submenu"><a class="dropdown-item" href="#" data-toggle="dropdown">Promotions</a>
            </li>
          </ul>
        </li>
        <li class="" data-menu=""><a class="nav-link" href="<?=site_url('dashboard/adminusers') ?>"><i class="ft-user"></i><span>User Account</span></a>
        </li>
      </ul>
    </div>
    <!-- /horizontal menu content-->
  </div>