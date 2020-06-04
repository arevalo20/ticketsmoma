<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- quitamos la opción de zoom en móviles -->
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> -->

  <link rel="icon" sizes="16x16 32x32" href="<?= base_url('assets/img/omiico.png') ?>">
  <title>
    <?= NOMBRE_PROYECTO ?>
  </title>

  <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
  <!-- <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/all.css') ?>"> -->
  <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/solid.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/master.css') ?>">

  <script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
  </script>


  <script type="text/javascript" src="<?= base_url('assets/jquery/jquery-3.3.1.min.js') ?>"></script>
  <script type="text/javascript" src="<?= base_url('assets/jquery/jquery.validate.js') ?>"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script type="text/javascript" src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>


</head>

<body>

  <div class="container-log center-h center-v">

    <div class="child">
      <div class="card">
        <div class="card-body">

          <?= form_open('login/validar', array("id" => "form_login")) ?>

          <div class="row">
            <div class="col-12">
              <img src="<?= base_url('assets/img/logo-omi.png') ?>" alt="img login" class="img-log-tickets" style="height:200px;">
            </div>
          </div><!-- -row -->

          <div class="row">
            <div class="col-12">
              <h3 class="titulo-tickets">
                Sistema de tickets <!-- para Omi vende -->
              </h3>
            </div>
          </div><!-- row -->

          <div class="row">
            <div class="col-12">
              <?= $this->session->flashdata(FLASH_MESSAGE) ?>
            </div><!-- .col-12-->
          </div><!-- .row -->

          <div class="row pt-2">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="input-tickets input_user">
                <input name="itxt_login_username" type="text" class="form-control input-log-tickets" placeholder="Usuario" autofocus value="<?= (isset($array_errors) && count($array_errors) > 0) ? set_value('itxt_login_username') : '' ?>">
                <?php if (isset($array_errors) && isset($array_errors['itxt_login_username'])) { ?>
                <label class="error">
                  <?= $array_errors['itxt_login_username'] ?></label>
                <?php 
              } ?>
              </div>
            </div><!-- .col-12 -->
          </div><!-- .row -->

          <div class="row pt-2">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="input-tickets input_psw">
                <input name="itxt_login_clave" type="password" class="form-control input-log-tickets " placeholder="Contraseña" value="">
                <?php if (isset($array_errors) && isset($array_errors['itxt_login_clave'])) { ?>
                <label class="error">
                  <?= $array_errors['itxt_login_clave'] ?></label>
                <?php 
              } ?>
              </div>
            </div><!-- .col-lg-12 -->
          </div><!-- row -->

          <div class="row pt-2">
            <div class="col-6 col-sm-6 col-md-6 col-lg-6">
              <a id="btn_login" href="http://omivende.com/" target="_blank" class="btn btn-secondary btn-block" data-toggle="tooltip" data-placement="left" title="">
                Ir a Omi vende
              </a>
            </div><!-- .col-6 -->
            <div class="col-6 col-sm-6 col-md-6 col-lg-6">
              <button id="btn_login" type="submit" class="btn btn-default btn-block" data-toggle="tooltip" data-placement="left" title="">
                Iniciar sesión
              </button>
            </div><!-- .col-6 -->
          </div><!-- row -->

          <?= form_close() ?>

        </div><!-- .card-body -->
      </div><!-- .card -->
    </div><!-- .col-lg-4 -->
  </div><!-- .row -->
  <!-- </div> -->
  <!-- .container -->

</body>

</html>