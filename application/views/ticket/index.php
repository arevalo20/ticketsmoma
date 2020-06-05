<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid">

      <div class="row no_se_ve">
        <div class="col-12">
          <?= $this->session->flashdata(FLASH_MESSAGE) ?>
        </div>
      </div>

      <div class="row no_se_ve">
        <input type="hidden" id="itxt_ticket_offsset" value="0">
      </div>

      <div class="row no_se_ve">
        <form id="form_tickets">
        </form>
      </div>

      <div class="mt-4">
        <div class="form-group">
          <?php if ($idtipousuario == USUARIO_TIPO_SISTEMAS) { ?>
            <?= form_open('Reporte/actividades', array("id" => "form_reporte_xmes", "target" => "_blank")); ?>
            <div class="row">
              <div class="col-8 col-sm-8 col-md-6 col-lg-6">
                <label>Reporte de actividades por mes</label>
                <div id="div_reporte_xmes" class="input-group-prepend date datepicker" data-date="" data-date-format="MM yyyy" data-link-field="itxt_reporte_mes" data-link-format="yyyy-mm">
                  <span class="input-group-text input-group-addon"><i class="fa fa-calendar"></i></span>
                  <input type="text" value="" class="form-control" readonly>
                </div><!-- col-lg-3 -->
                <input id="itxt_reporte_mes" name="itxt_reporte_mes" type="hidden" value="">
              </div><!-- .col-lg-10 -->
              <div class="col-4 col-sm-4 col-md-2 col-lg-2">
                <label>&nbsp;</label>
                <button id="btn_reporte_mes" type="submit" class="btn btn-primary btn-block"> Reporte </button>
              </div><!-- .col-lg-2 -->
            </div><!-- row -->
            <?= form_close() ?>
          <?php } ?>
        </div><!-- .form-group -->
      </div>


      <div class="mt-4">
        <div class="row">
          <div class="col-12 col-md-10 info-btn">
            <div class="info-btn center-h center-v">
              <span>Información de los iconos</span>
              <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
              <span class="info-detalles"><i class="fa fa-info-circle"></i> Detalles</span>
              <span class="info-secondary"><i class="fa fa-envelope"></i> Mensajes</span>
              <!-- <span class="info-autorizar"><i class="fa fa-check"></i> Autorizar</span>
            <span class="info-realizado"><i class="fa fa-check-double"></i> Realizado</span> -->
            </div>
          </div>
          <div class="col-12 col-md-2">
            <a class="btn btn-primary btn-block" href="<?= base_url('ticket/nuevo') ?>"><i class="fa fa-plus" aria-hidden="true"></i> NUEVO</a>
          </div><!-- .col-md-2 .offset-md-10 -->
        </div><!-- .row -->
      </div>

      <div class="mt-3">
        <div class="row">
          <div class="col-12">
            <div id="grid_tickets">
              <?= $str_grid ?>
            </div>
          </div><!-- .col-12 -->
        </div><!-- .row -->
      </div>

    </div>
  </main>