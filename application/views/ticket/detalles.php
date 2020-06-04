<div class="container">

  <div class="card">
    <div class="card-header bg-titulo">
      <span class="text-uppercase font-weight-bold text-white">Detalles de ticket</span>
    </div><!-- .card-header -->
    <div class="card-body">

      <div class="row">

        <div class="col-12 col-lg-6">
          <div>
            <h5><label class="text-info-omi">Ticket: </label>
              <span class="text-secondary">
                <?= $array_ticket['titulo'] ?></span></h5>
          </div>
          <hr>
          <div>
            <label class="text-info-omi font-weight-bold">Descripción:</label>
            <span class="text-secondary">
              <?= $array_ticket['descripcion'] ?></span>
          </div>
          <hr>
          <div>
            <label class="text-info-omi font-weight-bold">Sección:</label>
            <span class="text-secondary">
              <?= $array_ticket['seccion'] ?></span>
          </div>
          <hr>
          <div>
            <label class="text-info-omi font-weight-bold">Prioridad:</label>
            <span class="text-secondary">
              <?= $array_ticket['prioridad'] ?></span>
          </div>
          <hr>
          <div>
            <label class="text-info-omi font-weight-bold">Estatus:</label>
            <span class="text-secondary">
              <?= $array_ticket['estatus'] ?></span>
          </div>
          <hr>
          <div>
            <label class="text-info-omi font-weight-bold">Fecha de registro:</label>
            <span class="text-secondary">
              <?= $array_ticket['fcreacion'] ?></span>
          </div>
          <hr>
          <div>
            <label class="text-info-omi font-weight-bold">Fecha de autorización:</label>
            <span class="text-secondary">
              <?= $array_ticket['fautorizacion'] ?></span>
          </div>
        </div><!-- .col-6 -->

        <div class="col-12 col-lg-6">
          <label class="text-info-omi font-weight-bold">Imagen (evidencia):</label>
          <img src="<?= base_url($array_ticket['imgurl']) ?>" alt="img login" class="img-fluid d-block" style="height:400px;">
        </div><!-- .col-6 -->

      </div><!-- .row principal -->

      <div class="row">
        <div class="col-md-2 offset-md-10 mt-4">
          <a class="btn btn-secondary btn-block float-right" href="<?= base_url('panel') ?>">Regresar</a>
        </div><!-- .col-md-2 offset-md-10 mt-4 -->
      </div><!-- .row -->

    </div><!-- .card-body -->
  </div><!-- .card -->


</div><!-- .container -->
