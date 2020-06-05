<div id="layoutSidenav_content">

  <main>
    <div class="container-fluid">
      <div class="card">
        <div class="card-header bg-titulo">
          <!-- bg-info -->
          <span class="text-uppercase font-weight-bold text-white">Nuevo ticket</span>
        </div><!-- .card-header -->

        <div class="card-body">

          <div class="row">
            <div class="col-12">
              <?= $this->session->flashdata(FLASH_MESSAGE) ?>
            </div><!-- .col-12 -->
          </div><!-- .row -->

          <div class="form-group">
            <?= form_open('ticket/guardar', array("id" => "form_ticket_create", 'enctype' => 'multipart/form-data')) ?>

            <input name="itxt_ticket_idticket" type="hidden" value="<?= $array_ticket['idticket'] ?>">

            <div class="row">
              <div class="col-12">
                <label>Título<span class="obligatorio">*</span></label>
                <input name="itxt_ticket_titulo" type="text" class="form-control" value="<?= (isset($array_errors) && count($array_errors) > 0) ? set_value('itxt_ticket_titulo') : '' ?>">
                <?php if (isset($array_errors) && isset($array_errors['itxt_ticket_titulo'])) { ?>
                  <label class="error">
                    <?= $array_errors['itxt_ticket_titulo'] ?></label>
                <?php } ?>
              </div><!-- .col-12 -->
            </div><!-- .row -->

            <div class="row">
              <div class="col-12 col-sm-12 col-md-6 col-lg-6 mt-3">
                <label>Seccion<span class="obligatorio">*</span></label>
                <select name="slc_ticket_idseccion" class="form-control">
                  <option value="0">SELECCIONE</option>
                  <?php foreach ($array_secciones as $key => $seccion) {
                    $selected = "";
                    if (isset($array_errors) && isset($array_errors['slc_ticket_idseccion'])) { // Si falló la validación tomarmos el valor enviado para conservarlo
                      if ($seccion['idseccion'] == set_value('slc_ticket_idseccion')) {
                        $selected =  'selected';
                      }
                    } else { // Edición o no hay errores en la validación
                      if ($array_ticket['idseccion'] == $seccion['idseccion']) {
                        $selected =  'selected';
                      }
                    }
                  ?>
                    <option value="<?= $seccion['idseccion'] ?>" <?= $selected ?>>
                      <?= $seccion['seccion'] ?>
                    </option>
                  <?php } ?>
                </select>
                <?php if (isset($array_errors) && isset($array_errors['slc_ticket_idseccion'])) { ?>
                  <label class="error">
                    <?= $array_errors['slc_ticket_idseccion'] ?></label>
                <?php } ?>
              </div>

              <div class="col-12 col-sm-12 col-md-6 col-lg-6 mt-3">
                <label>Prioridad<span class="obligatorio">*</span></label>
                <select name="itxt_ticket_idprioridad" name="itxt_ticket_idprioridad" class="form-control">
                  <?php foreach ($array_prioridades as $key => $prioridad) {
                    $selected = "";
                    if ($prioridad['idprioridad'] == set_value('slc_ticket_idseccion')) {
                      $selected =  'selected';
                    }
                  ?>
                    <option value="<?= $prioridad['idprioridad'] ?>" <?= $selected ?>>
                      <?= $prioridad['prioridad'] ?>
                    </option>
                  <?php } ?>
                </select>
              </div>

            </div><!-- row -->

            <div class="row">
              <div class="col-12 col-lg-6 mt-3">
                <label>Descripción<span class="obligatorio">*</span></label>
                <textarea name="itxt_ticket_descripcion" class="form-control" rows="5"><?= (isset($array_errors) && count($array_errors) > 0) ? set_value('itxt_ticket_descripcion') : '' ?></textarea>
                <?php if (isset($array_errors) && isset($array_errors['itxt_ticket_descripcion'])) { ?>
                  <label class="error">
                    <?= $array_errors['itxt_ticket_descripcion'] ?></label>
                <?php } ?>
              </div><!-- .col-6 -->

              <div class="col-12 col-lg-6 mt-3">
                <label>Captura de pantalla donde se muestre el error<span class="obligatorio">*</span></label>
                <input id="ifile_ticket_img" name="ifile_ticket_img" type="file" class="form-control">
                <?php if (isset($array_errors) && isset($array_errors['ifile_ticket_img'])) { ?>
                  <label class="error">
                    <?= $array_errors['ifile_ticket_img'] ?></label>
                <?php } ?>
              </div><!-- .col-6 -->
            </div><!-- .row -->


            <div class="row">
              <div class="col-12 mt-4">
                <div class="float-left">
                  <label class="text-info-omi font-weight-bold">Campos obligatorios<span class="obligatorio">*</span></label></div>
              </div><!-- .col-12 mt-4 -->
            </div><!-- .row -->

            <div class="row">
              <!-- <div class="col-0 col-sm-0 col-md-8 col-lg-8 mt-2"></div> -->
              <div class="col-md-2 offset-md-8 mt-2">
                <a class="btn btn-secondary btn-block float-right" href="<?= base_url('panel') ?>">Regresar</a>
              </div><!-- .col-lg-2 -->
              <div class="col-md-2 mt-2">
                <button id="btn_ticket_guardar" type="submit" class="btn btn-default btn-block">Guardar</button>
              </div><!-- col-2 -->
            </div><!-- .row -->

            <?= form_close() ?>

          </div><!-- .form-group -->


        </div><!-- .card-body -->
      </div><!-- .card -->
    </div>
  </main>