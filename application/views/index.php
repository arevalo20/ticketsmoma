<!DOCTYPE html>
<html lang="">
<head>
  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- quitamos la opción de zoom en móviles -->
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> -->

  <link rel="icon" sizes="16x16 32x32" href="<?= base_url('assets/img/athan_favicon.png') ?>">
  <title>Login</title>

  <link rel="stylesheet" href=" <?= base_url('assets/css/font-awesome.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/sweetalert2/sweetalert2.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/master.css') ?>">

</head>
<body>

  <div class="row mt-4">

    <div class="col-12 col-sm-12 col-md-4 col-l-4"></div>

    <div class="col-12 col-sm-12 col-md-4 col-l-4">

      <div class="card box-shadow">
        <!-- <img class="card-img-top" src="{{ asset('assets/img/batman.jpg') }} " class="img-fluid"  alt="Responsive image Card image cap"> -->
        <div class="card-body">

            <form method="post" id="form_login" action="#">
              <div class="div_white">

                <div class="row">
                  <div class="col-sm-12">
                    <img src="<?= base_url('assets/img/athan_logotipo_circle.png') ?>" alt="img login" class="img-fluid mx-auto d-block" style="height:200px;">
                  </div>
                </div><!-- row -->
                <div class="row">
                  <div class="col-sm-12">
                    <p class="text-center" style="font-size: 18px;">
                    <b>Sistema de incidencias para <a href="http://omivende.com/" target="_blank">Omi vende</a></b>
                  </p>
                  </div>
                </div><!-- row -->

                <div class="row pt-2">
                  <div class="col-sm-12">
                    <i class="fa fa-user-o" aria-hidden="true"></i>
                    <input name="itxt_login_username" type="text" class="form-control" placeholder="usuario" autofocus>
                  </div>
                </div><!-- row -->

                <div class="row pt-2">
                  <div class="col-sm-12">
                    <i class="fa fa-key" aria-hidden="true"></i>
                    <input name="itxt_login_clave" type="password" class="form-control" placeholder="contraseña">
                  </div>
                </div><!-- row -->

                <div class="row">
                  <div class="col-0 col-sm-0 col-md-3 col-lg-3 pt-3"></div>
                  <div class="col-12 col-sm-12 col-md-6 col-lg-6 pt-3">
                    <button id="btn_login" type="submit" class="btn btn-outline-success btn-block float-right" data-toggle="tooltip" data-placement="left" title="">
                      Iniciar sesión
                    </button>
                  </div>
                  <div class="col-0 col-sm-0 col-md-3 col-lg-3 pt-3"></div>
                </div><!-- row -->
              </div>
            </form>

        </div>
      </div>

    </div>
    <div class="col-12 col-sm-12 col-md-4 col-l-4"></div>
  </div><!-- row -->

  <script type="text/javascript" src="<?= base_url('assets/jquery/jquery-3.2.1.min.js') ?>" ></script>
  <script type="text/javascript" src="<?= base_url('assets/jquery/jquery.validate.js') ?>" ></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script type="text/javascript" src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
</body>
</html>
