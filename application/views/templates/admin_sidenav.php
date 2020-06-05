<div id="layoutSidenav_nav">
  <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
      <div class="nav">
        <!-- <div class="sb-sidenav-menu-heading">Core</div> -->
        <a class="nav-link" href="<?= base_url('ticket/index') ?>">
          <div class="sb-nav-link-icon">
            <i class="fa fa-fw fa-dashboard"></i>
          </div> Escritorio
        </a>

        <!-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#posts_dropdown">
          <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
          Entradas
          <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="posts_dropdown">
          <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="entradas.php"> Todas las entradas</a>
            <a class="nav-link" href="entradas.php?accion=add_entrada">Añadir nueva entrada</a>
          </nav>
        </div> -->

        <!-- <a class="nav-link" href="categorias.php">
          <div class="sb-nav-link-icon">
            <i class="fa fa-fw fa-wrench"></i>
          </div> Categorías
        </a> -->

        <!-- <a class="nav-link" href="comentarios.php">
          <div class="sb-nav-link-icon">
            <i class="fa fa-fw fa-comments"></i>
          </div> Comentarios
        </a> -->

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#usuario_dropdown">
          <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
          Usuarios
          <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="usuario_dropdown">
          <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="<?= base_url('ticket/usuarios') ?> ">Todos los usuarios</a>
            <a class="nav-link" href="ticket/usuarios.php?accion=add_usuario">Añadir usuario</a>
          </nav>
        </div>

        <a class="nav-link" href="<?= base_url('ticket/perfil') ?> ">
          <div class="sb-nav-link-icon">
            <i class="fa fa-fw fa-user"></i>
          </div> Perfil
        </a>
      </div>
    </div>
    <div class="sb-sidenav-footer">
      <div class="small">Logged in as:</div>
      <?= $this->user_logueado ?>
    </div>
  </nav>
</div>