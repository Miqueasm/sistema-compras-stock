<sidebar class="sidebar">
  <ul class="sidebar-menu">
    <li class="header">MENÚ PRINCIPAL</li>

    <!-- Inicio (Visible para todos) -->
    <li class="<?php if ($_GET['module'] == 'start') { echo 'active'; } ?>">
      <a href="?module=start"><i class="fa fa-home"></i> <span>Inicio</span></a>
    </li>

    <?php 
    // Capturamos el rol, permisos y usuario de la sesión de manera segura
    $nivel_usuario = isset($_SESSION['nivel']) ? strtolower(trim($_SESSION['nivel'])) : '';
    $permisos_usuario = isset($_SESSION['permisos']) ? strtolower(trim($_SESSION['permisos'])) : '';
    $user_actual = isset($_SESSION['username']) ? trim($_SESSION['username']) : '';

    // Detección exacta de perfiles
    $es_admin = ($user_actual == 'admin' || strpos($nivel_usuario, 'admin') !== false || strpos($nivel_usuario, 'super') !== false || strpos($nivel_usuario, 'general') !== false);
    
    $es_almacen = ($user_actual == 'operador1' || strpos($nivel_usuario, 'almacen') !== false || strpos($nivel_usuario, 'almacén') !== false);
    
    $es_compras = ($user_actual == 'operador2' || strpos($nivel_usuario, 'compra') !== false);

    // 1. MENÚ REFERENCIALES (VISIBLE SOLO PARA EL ADMINISTRADOR)
    if ($es_admin) {
    ?>
      <li class="treeview <?php if (in_array($_GET['module'], ['cliente', 'proveedor', 'producto', 'departamento'])) { echo 'active'; } ?>">
        <a href="#">
          <i class="fa fa-folder"></i> <span>Referenciales</span>
          <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
          <li><a href="?module=cliente"><i class="fa fa-circle-o"></i> Clientes</a></li>
          <li><a href="?module=proveedor"><i class="fa fa-circle-o"></i> Proveedores</a></li>
          <li><a href="?module=producto"><i class="fa fa-circle-o"></i> Productos</a></li>
          <li><a href="?module=departamento"><i class="fa fa-circle-o"></i> Departamentos</a></li>
        </ul>
      </li>
    <?php 
    } 
    ?>

    <?php 
    // 2. MOVIMIENTO DE COMPRAS (Visible para Administrador y Compras. OCULTO para Almacén)
    if (!$es_almacen) {
    ?>
      <li class="<?php if ($_GET['module'] == 'compra' || $_GET['module'] == 'form_compra' || $_GET['module'] == 'det_compra') { echo 'active'; } ?>">
        <a href="?module=compra"><i class="fa fa-shopping-cart"></i> <span>Movimiento de Compras</span></a>
      </li>
    <?php 
    } 
    ?>

    <!-- 3. STOCK DE PRODUCTOS (Visible para todos los roles) -->
    <li class="<?php if ($_GET['module'] == 'stock') { echo 'active'; } ?>">
      <a href="?module=stock"><i class="fa fa-cubes"></i> <span>Stock de Productos</span></a>
    </li>

    <?php 
    // 4. ADMINISTRAR USUARIOS (VISIBLE SOLO PARA EL ADMINISTRADOR)
    if ($es_admin) {
    ?>
      <li class="<?php if ($_GET['module'] == 'user' || $_GET['module'] == 'form_user') { echo 'active'; } ?>">
        <a href="?module=user"><i class="fa fa-users"></i> <span>Administrar Usuarios</span></a>
      </li>
    <?php 
    } 
    ?>

    <!-- 5. CAMBIAR CONTRASEÑA (Visible para todos) -->
    <li class="<?php if ($_GET['module'] == 'password') { echo 'active'; } ?>">
      <a href="?module=password"><i class="fa fa-lock"></i> <span>Cambiar Contraseña</span></a>
    </li>

    <!-- BOTÓN SALIR (Visible para todos) -->
    <li>
      <a href="#" data-toggle="modal" data-target="#logout"><i class="fa fa-sign-out"></i> <span>Salir del Sistema</span></a>
    </li>
  </ul>
</sidebar>