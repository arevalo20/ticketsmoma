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

      <div class="row no_se_ve">
        <div class="col-12">
          <?= $this->session->flashdata(FLASH_MESSAGE) ?>
        </div>
      </div>

      <div class="conversacion">

        <?php if (count($array_mensajes)) { ?>
        <?php foreach ($array_mensajes as $key => $mensaje) { ?>


        <div class="row conver">
          <?php if ($mensaje['idusuario'] == $mi_idusuario) { ?>
          <div class="col-12 col-sm-12 col-md-2 col-lg-2"></div>
          <?php 
          } ?>
          <div class="col-12 col-sm-12 col-md-10 col-lg-10">
            <div class="mensajes">
              <div class="mensajes-body">
                <div class="text-usuario">
                  <span class="text-primary">
                    <?= ($mensaje['idusuario'] == $mi_idusuario) ? 'YO' : $mensaje['nombre_completo'] ?></span>
                  <!-- <span class="text-secondary"> <?= $mensaje['fcreacion'] ?></span> -->
                </div>

                <div class="respuesta">
                  <div class="text-secondary">
                    <span class="font-weight-bold">Respuesta:</span>
                    <span><?= $mensaje['mensaje'] ?></span>
                  </div>
                </div>

                <div class="fecha">
                  <span class="text-secondary"><?= $mensaje['fcreacion'] ?></span>
                </div>
              </div><!-- .mensajes-body -->
            </div><!-- .mensajes -->
          </div><!-- .col-lg-12 -->
        </div><!-- .row -->

        <?php 
      } ?>
      <!-- </div> -->

      <?php 
      } else { ?>

      <div class="row conver">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-2">
          <div class="card">
            <div class="card-body">
              <span class="text-primary">Este ticket aún no tiene respuestas</span>
            </div><!-- .card-body -->
          </div><!-- .card -->
        </div><!-- .col-lg-12 -->
      </div><!-- .row -->
      <?php 
      } ?>
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
