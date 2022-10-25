<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="BAT Foundation.">
  <meta name="keywords" content="bat, bat foundation, events, news, projects, games">
  <meta name="author" content="Metro">
  <title>BAT Foundation</title>
  <link rel="apple-touch-icon" href="<?=base_url()?>/app-assets/images/ico/apple-icon-120.png">
  <link rel="shortcut icon" type="image/x-icon" href="<?=base_url()?>/app-assets/images/ico/favicon.ico">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i"
  rel="stylesheet">
  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>/app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>/app-assets/vendors/css/forms/icheck/icheck.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>/app-assets/vendors/css/forms/icheck/custom.css">
  <!-- END VENDOR CSS-->
  <!-- BEGIN STACK CSS-->
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>/app-assets/css/app.css">
  <!-- END STACK CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>/app-assets/css/core/menu/menu-types/horizontal-menu.css">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/css/style.css">
  <!-- END Custom CSS-->
</head>
<body class="horizontal-layout horizontal-menu 1-column  bg-full-screen-image menu-expanded blank-page blank-page"
data-open="click" data-menu="horizontal-menu" data-col="1-column">
  <div class="app-content container center-layout mt-2">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <section class="flexbox-container">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0">
              <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                <div class="card-header border-0">
                  <div class="card-title text-center">
                    <img src="<?=base_url()?>/app-assets/images/logo/stack-logo-dark.png" alt="branding logo">
                  </div>
                </div>
                  <div class="card-body">
                  <?php echo form_open('Admin/login', ['class' => 'form-horizontal']); ?>
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="text" class="form-control" name="identity" placeholder="Your email">
                        <div class="form-control-position">
                          <i class="ft-mail"></i>
                        </div>
                      </fieldset>
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="password" class="form-control" name="password" placeholder="Enter Password">
                        <div class="form-control-position">
                          <i class="fa fa-key"></i>
                        </div>
                      </fieldset>
                      <div class="form-group row">
                        <div class="col-md-6 col-12 text-center text-sm-left">
                          <fieldset>
                            <input type="checkbox" name="remember" value="1" class="chk-remember">
                            <label for="remember-me"> Remember Me</label>
                          </fieldset>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-outline-secondary btn-block"><i class="ft-unlock"></i> Login</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <!-- BEGIN VENDOR JS-->
  <script src="<?=base_url()?>/app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <script type="text/javascript" src="<?=base_url()?>/app-assets/vendors/js/ui/jquery.sticky.js"></script>
  <script type="text/javascript" src="<?=base_url()?>/app-assets/vendors/js/charts/jquery.sparkline.min.js"></script>
  <script src="<?=base_url()?>/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"
  type="text/javascript"></script>
  <script src="<?=base_url()?>/app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN STACK JS-->
  <script src="<?=base_url()?>/app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="<?=base_url()?>/app-assets/js/core/app.js" type="text/javascript"></script>
  <script src="<?=base_url()?>/app-assets/js/scripts/customizer.js" type="text/javascript"></script>
  <!-- END STACK JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  <script type="text/javascript" src="<?=base_url()?>/app-assets/js/scripts/ui/breadcrumbs-with-stats.js"></script>
  <script src="<?=base_url()?>/app-assets/js/scripts/forms/form-login-register.js" type="text/javascript"></script>
  <!-- END PAGE LEVEL JS-->
</body>
</html>