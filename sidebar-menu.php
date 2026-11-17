<ul class="sidebar-menu">
  <li class="header">MENÚ PRINCIPAL</li>
  <li class="<?php echo ($_GET['module']=='start')?'active':''; ?>">
    <a href="?module=start"><i class="fa fa-home"></i> <span>Inicio</span></a>
  </li>

  <?php if ($_SESSION['permisos_acceso'] == 'Super Admin' || $_SESSION['permisos_acceso'] == 'Compras') { ?>
  <li class="treeview <?php echo (in_array($_GET['module'], ['departamento','ciudad','cliente','proveedor','producto']))?'active':''; ?>">
    <a href="javascript:void(0);">
      <i class="fa fa-folder"></i> <span>Referenciales</span> <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
      <li><a href="?module=departamento"><i class="fa fa-circle-o"></i> Departamentos</a></li>
      <li><a href="?module=ciudad"><i class="fa fa-circle-o"></i> Ciudades</a></li>
      <li><a href="?module=cliente"><i class="fa fa-circle-o"></i> Clientes</a></li>
      <li><a href="?module=proveedor"><i class="fa fa-circle-o"></i> Proveedores</a></li>
      <li><a href="?module=producto"><i class="fa fa-circle-o"></i> Productos</a></li>
    </ul>
  </li>

  <li class="<?php echo (in_array($_GET['module'], ['compra','form_compra','det_compra']))?'active':''; ?>">
    <a href="?module=compra"><i class="fa fa-shopping-cart"></i> <span>Movimiento de Compras</span></a>
  </li>
  <?php } ?>

  <li class="<?php echo ($_GET['module']=='stock')?'active':''; ?>">
    <a href="?module=stock"><i class="fa fa-cubes"></i> <span>Stock de Productos</span></a>
  </li>

  <?php if ($_SESSION['permisos_acceso'] == 'Super Admin') { ?>
  <li class="<?php echo (in_array($_GET['module'], ['user','form_user']))?'active':''; ?>">
    <a href="?module=user"><i class="fa fa-users"></i> <span>Administrar Usuarios</span></a>
  </li>
  <?php } ?>

  <li class="<?php echo ($_GET['module']=='password')?'active':''; ?>">
    <a href="?module=password"><i class="fa fa-lock"></i> <span>Cambiar Contraseña</span></a>
  </li>
</ul>
