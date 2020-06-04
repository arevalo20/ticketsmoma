<!DOCTYPE html>
<html lang="es" class="h-100">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- quitamos la opción de zoom en móviles -->
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">-->
  <link rel="icon" sizes="16x16 32x32" href="<?= base_url('assets/img/omiico.png') ?>">
  <title>
    <?= NOMBRE_PROYECTO ?>
  </title>
  <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/all.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/solid.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/sweetalert2/sweetalert2.min.css') ?>">

  <link href="<?= base_url('assets/datepicker/datepicker.min.css'); ?>" rel="stylesheet" media="screen">

  <link rel="stylesheet" href="<?= base_url('assets/css/master.css') ?>">
  <script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
  </script>
  <script type="text/javascript" src="<?= base_url('assets/jquery/jquery-3.3.1.min.js') ?>"></script>
  <script type="text/javascript" src="<?= base_url('assets/jquery/jquery.validate.js') ?>"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script type="text/javascript" src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
  <script type="text/javascript" src="<?= base_url('assets/sweetalert2/sweetalert2.min.js') ?>"></script>
  <script type="text/javascript" src="<?= base_url('') ?>"></script>

  <script type="text/javascript" src="<?= base_url('assets/datepicker/bootstrap-datepicker.min.js') ?>"></script>
  <script type="text/javascript" src="<?= base_url('assets/datepicker/bootstrap-datepicker.es.min.js') ?>"></script>
  
  <script type="text/javascript" src="<?= base_url('assets/js/message.js') ?>"></script>
  <script type="text/javascript" src="<?= base_url('assets/js/grid.js') ?>"></script>
</head>

<body class="d-flex flex-column h-100">

  <header class="main-header">
    <!-- class="mb-3" -->

    <nav class="navbar navbar-expand-lg bg-omivende">
      <!-- bg-light -->

      <a class="navbar-brand" href="<?= base_url('panel') ?>"><?= $this->user_logueado ?></a>

      <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button> -->

      <div class="navbar-collapse" id="navbarTogglerDemo02"><!-- collapse -->
        <ul class="navbar-nav mr-auto"></ul>
        <ul class="nav justify-content-end" style="display: block;">
          <li class="nav-item center-v center-h">
            <a href="<?= base_url('Login/cerrar_sesion') ?>" class="btn btn-danger "><i class="fas fa-sign-out-alt"></i> CERRAR SESIÓN</a>
          </li>
        </ul>
      </div>
    </nav>

  </header>
