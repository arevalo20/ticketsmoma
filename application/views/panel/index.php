<div class="container">

  <div class="row">
    <div class="col-12">
      <?= $this->session->flashdata(FLASH_MESSAGE) ?>
    </div>
  </div><!-- row -->

  <input type="hidden" id="itxt_ticket_offsset" value="0">

  <form id="form_tickets">
  </form>

  <div class="row mb-1">
    <div class="col-0 col-sm-0 col-md-10 col-lg-10"></div>
    <div class="col-12 col-sm-12 col-m2-2 col-lg-2">
      <a class="btn btn-info btn-sm btn-block" href="<?= base_url('ticket/nuevo') ?>">NUEVO</a>
    </div><!-- .col-lg-2 -->
  </div><!-- .row -->

  <div class="row">
    <div class="col-12">
      <div id="grid_tickets">
        <?= $str_grid ?>
      </div>
    </div><!-- .col-12 -->
  </div><!-- .row -->

</div><!-- .container -->

<script type="text/javascript" src="<?= base_url('assets/js/tickets/tickets.js') ?>"></script>
