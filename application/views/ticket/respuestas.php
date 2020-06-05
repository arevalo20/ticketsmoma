<div class="container contenedor">

  <div class="card">
    <div class="card-header bg-titulo">
      <span class="text-uppercase font-weight-bold text-white">Respuestas de ticket</span>
    </div><!-- .card-header -->
    <div class="card-body">

      <div class="row">
        <div class="col-12 col-lg-12">
          <h5><label class="text-info-omi">Ticket: </label>
            <span class="text-secondary">
              <?= $array_ticket['titulo'] ?></span></h5>
        </div><!-- .col-lg-12 -->
      </div><!-- .row -->

      <div class="row">
        <div class="col-12 col-lg-12">
          <label class="text-info-omi font-weight-bold">Descripción:</label>
          <span class="text-secondary">
            <?= $array_ticket['descripcion'] ?></span>
        </div><!-- .col-lg-12 -->
      </div><!-- .row -->

      <hr>

      <div class="row">
        <div class="col-12">
          <?= $this->session->flashdata(FLASH_MESSAGE) ?>
        </div>
      </div>

      <div class="conversacion">

        <?php if (count($array_mensajes)) { ?>
          <?php foreach ($array_mensajes as $key => $mensaje) { ?>

            <?php if ($mensaje['idusuario'] == $mi_idusuario) { ?>
              <div class="vW7d1 message-out">
                <div class="_3_7SH _3DFk6 _2wOlC">
                  <span data-icon="tail-out" class="_1JfxZ">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 13" width="8" height="13">
                      <path opacity=".13" d="M5.188 1H0v11.193l6.467-8.625C7.526 2.156 6.958 1 5.188 1z"></path>
                      <path fill="currentColor" d="M5.188 0H0v11.193l6.467-8.625C7.526 1.156 6.958 0 5.188 0z"></path>
                    </svg>
                  </span>
                  <div class="MVjBr _3e2jK">
                    <div class="Tkt2p">
                      <div class="copyable-text">
                        <div class="_3zb-j">

                          <span class="_3FXB1 selectable-text invisible-space copyable-text">
                            <span class="text-primary"><?= ($mensaje['idusuario'] == $mi_idusuario) ? $mensaje['nombre_completo'] : $mensaje['nombre_completo'] ?></span>

                            <span class="text-secondary">
                              <?= $mensaje['mensaje'] ?>
                            </span>

                            <span class="ZhF0n WyHOW"></span>
                          </span>
                        </div>
                      </div>
                      <div class="_2f-RV">
                        <div class="_1DZAH">
                          <div class="_3EFt_">
                            <span class="text-secondary"><?= $mensaje['fcreacion'] ?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            <?php } else { ?>
              <div class="vW7d1 message-in">
                <div class="_3_7SH _3DFk6 _2wOlC">
                  <span data-icon="tail-in" class="_1JfxZ">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 13" width="8" height="13">
                      <path opacity=".13" fill="#0000000" d="M1.533 3.568L8 12.193V1H2.812C1.042 1 .474 2.156 1.533 3.568z"></path>
                      <path fill="currentColor" d="M1.533 2.568L8 11.193V0H2.812C1.042 0 .474 1.156 1.533 2.568z"></path>
                    </svg>
                  </span>
                  <div class="MVjBr _3e2jK">
                    <div class="Tkt2p">
                      <div class="copyable-text">
                        <div class="_3zb-j">

                          <span class="_3FXB1 selectable-text invisible-space copyable-text">
                            <span class="text-primary"><?= ($mensaje['idusuario'] == $mi_idusuario) ? $mensaje['nombre_completo'] : $mensaje['nombre_completo'] ?></span>

                            <span class="text-secondary">
                              <?= $mensaje['mensaje'] ?>
                            </span>
                          </span>
                          <span class="ZhF0n WyHOW"></span>
                        </div>
                      </div>

                      <div class="_2f-RV">
                        <div class="_1DZAH">
                          <div class="_3EFt_">
                            <span class="text-secondary"><?= $mensaje['fcreacion'] ?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            <?php }  ?>

          <?php } ?>

        <?php } else { ?>

          <div class="row conver">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-2">
              <div class="card">
                <div class="card-body">
                  <span class="text-primary">Este ticket aún no tiene respuestas</span>
                </div><!-- .card-body -->
              </div><!-- .card -->
            </div><!-- .col-lg-12 -->
          </div><!-- .row -->
        <?php } ?>
      </div>


      <div class="row">
        <div class="col-12 col-sm-10 col-md-10 col-lg-10 mt-3">
          <textarea id="itxt_ticket_mensaje" class="form-control" rows="2" placeholder="Agregar respuesta"></textarea>
        </div><!-- .col-lg-10 -->
        <div class="col-12 col-sm-12 col-md-2 col-lg-2 mt-3">
          <input type="hidden" id="itxt_ticket_idticket" value="<?= $idticket ?>">
          <button id="btn_ticket_mensaje" type="button" name="button" class="btn btn-info btn-block">Guardar respuesta</button>
        </div><!-- .col-lg-2 -->
      </div><!-- .row -->

      <hr>

      <div class="row">
        <div class="col-md-2 offset-md-10">
          <a class="btn btn-secondary btn-block float-right" href="<?= base_url('tickets') ?>">Regresar</a>
        </div>
      </div><!-- .row -->

    </div><!-- .card-body -->
  </div><!-- .card -->

</div><!-- .container -->


<script type="text/javascript" src="<?= base_url('assets/js/tickets/mensajes.js') ?>"></script>