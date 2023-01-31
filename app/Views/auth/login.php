<!DOCTYPE html>
<html>
  <head>
    <title>Login | Petty Cash</title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="template language" name="keywords">
    <meta content="Tamerlan Soziev" name="author">
    <meta content="Admin dashboard html template" name="description">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="favicon.png" rel="shortcut icon">
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
  </head>
  <body class="auth-wrapper">
    <div class="all-wrapper menu-side with-pattern">
      <div class="auth-box-w">
        <div class="logo-w">
          <a href="index.html"><img alt="" src="<?php echo base_url(); ?>/img/logo-big.png"></a>
        </div>
        <h4 class="auth-header">
          <?=lang('Auth.loginTitle')?>
        </h4>
        <?= view('Myth\Auth\Views\_message_block') ?>
        <form action="<?= url_to('login') ?>" method="post">
          <?= csrf_field() ?>

          <?php if ($config->validFields === ['email']): ?>
          <div class="form-group">
            <label for=""><?=lang('Auth.email')?></label>
            <input type="email" name="login" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.email')?>">
            <div class="pre-icon os-icon os-icon-user-male-circle"></div>
            <div class="invalid-feedback">
              <?= session('errors.login') ?>
            </div>
          </div>
          <?php else: ?>
          <div class="form-group">
            <label for=""><?=lang('Auth.emailOrUsername')?></label>
            <input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>"
                   name="login" placeholder="<?=lang('Auth.emailOrUsername')?>">  
            <div class="pre-icon os-icon os-icon-user-male-circle"></div>
            <div class="invalid-feedback">
                <?= session('errors.login') ?>
            </div>
          </div>
          <?php endif; ?>

          <div class="form-group">
            <label for=""><?=lang('Auth.password')?></label>
            <input type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.password')?>">
            <div class="pre-icon os-icon os-icon-fingerprint"></div>
            <div class="invalid-feedback">
              <?= session('errors.password') ?>
            </div>
          </div>
          <div class="buttons-w">
            <button type="submit" class="btn btn-primary"><?=lang('Auth.loginAction')?></button>
            <?php if ($config->allowRemembering): ?>
            <div class="form-check-inline">
              <label class="form-check-label">
              <input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>><?=lang('Auth.rememberMe')?></label>
            </div>
            <?php endif; ?>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
