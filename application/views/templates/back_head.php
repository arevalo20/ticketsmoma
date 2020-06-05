<!DOCTYPE html>
<html lang="es" class="h-100">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- quitamos la opción de zoom en móviles -->
  <link rel="icon" sizes="16x16 32x32" href="<?= base_url('assets/img/favicon-blco.png') ?>">
  <title><?= NOMBRE_PROYECTO ?></title>
  <!-- <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>"> -->
  <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/all.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/solid.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/sweetalert2/sweetalert2.min.css') ?>">

  <script src="https://kit.fontawesome.com/674bbcc1f8.js" crossorigin="anonymous"></script>

  <link href="<?= base_url('assets/datepicker/datepicker.min.css'); ?>" rel="stylesheet" media="screen">

  <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/master-panel.css') ?>">
  <script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
  </script>
  <script type="text/javascript" src="<?= base_url('assets/jquery/jquery.js') ?>"></script>
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

  <header>

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-red-dark " role="navigation">

      <a class="navbar-brand" href="<?= base_url('panel') ?>"><?= NOMBRE_PROYECTO ?></a>
      <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>

      <!-- Top Menu Items -->
      <ul class="d-none d-lg-inline-flex navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <!-- <li class="nav-item">
          <a href="<?= base_url('Login/cerrar_sesion') ?>" class="nav-link sesion"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
        </li> -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i>
            <?= $this->user_logueado ?> <b class="caret"></b></a>
          <ul class="dropdown-menu sesion dropdown-menu-right rounded-0 shadow-sm border-0 m-0">
            <a class="dropdown-item" href="#"><i class="fa fa-fw fa-user"></i> Perfil</a>
            <a href="<?= base_url('Login/cerrar_sesion') ?>" class="dropdown-item sesion"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
          </ul>
        </li>
      </ul>

      <ul class="d-lg-none d-inline-flex navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-caret-square-down"></i></a>
          <div class="dropdown-menu sesion dropdown-menu-right rounded-0 shadow-lg border-0 m-0" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#"><i class="fa fa-fw fa-user"></i> Perfil</a>
            <a class="dropdown-item sesion" href="<?= base_url('Login/cerrar_sesion') ?>"><i class="fa fa-fw fa-power-off"></i> Cerrar Sesión</a>
          </div>
        </li>
      </ul>

    </nav>

  </header>

  <div id="layoutSidenav">
    <?php require_once "admin_sidenav.php"; ?>