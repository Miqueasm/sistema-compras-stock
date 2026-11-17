<section class="content-header">
  <h1><i class="fa fa-home icon-title"></i> Inicio</h1>
</section>
<section class="content">
  <div class="row">
    <div class="col-lg-12">
      <div class="alert alert-info">
        Bienvenido <strong><?php echo $_SESSION['name_user']; ?></strong> al Sistema Web de Compras y Stock.
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>Clientes</h3>
          <p>Gestión de Clientes</p>
        </div>
        <div class="icon"><i class="fa fa-users"></i></div>
        <a href="?module=cliente" class="small-box-footer">Ir al módulo <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-green">
        <div class="inner">
          <h3>Compras</h3>
          <p>Registro y Detalle</p>
        </div>
        <div class="icon"><i class="fa fa-shopping-cart"></i></div>
        <a href="?module=compra" class="small-box-footer">Ir al módulo <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>Stock</h3>
          <p>Existencias en Depósito</p>
        </div>
        <div class="icon"><i class="fa fa-cubes"></i></div>
        <a href="?module=stock" class="small-box-footer">Ir al módulo <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-red">
        <div class="inner">
          <h3>Usuarios</h3>
          <p>Control de Acceso</p>
        </div>
        <div class="icon"><i class="fa fa-user-plus"></i></div>
        <a href="?module=user" class="small-box-footer">Ir al módulo <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>
</section>
