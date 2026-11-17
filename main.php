<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    header("Location: index.php?alert=1");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Sistema Web de Compras y Stock</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.11/css/AdminLTE.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.11/css/skins/skin-blue.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>
<body class="skin-blue fixed sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
      <a href="?module=start" class="logo">
        <span class="logo-mini"><b>C</b>&S</span>
        <span class="logo-lg"><b>Compras</b> & Stock</span>
      </a>
      <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Navegación</span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <?php include "top-menu.php"; ?>
          </ul>
        </div>
      </nav>
    </header>

    <aside class="main-sidebar">
      <section class="sidebar">
        <?php include "sidebar-menu.php"; ?>
      </section>
    </aside>

    <div class="content-wrapper">
      <?php 
      $module = isset($_GET['module']) ? $_GET['module'] : 'start';
      
      $nivel = isset($_SESSION['nivel']) ? strtolower(trim($_SESSION['nivel'])) : ''; 
      $permisos = isset($_SESSION['permisos']) ? strtolower(trim($_SESSION['permisos'])) : '';
      $username = isset($_SESSION['username']) ? trim($_SESSION['username']) : '';

      // Identificación de perfiles
      $es_admin = ($username == 'admin' || strpos($nivel, 'admin') !== false || strpos($nivel, 'super') !== false || strpos($nivel, 'general') !== false);
      $es_almacen = ($username == 'operador1' || strpos($nivel, 'almacen') !== false || strpos($nivel, 'almacén') !== false);
      $es_compras = ($username == 'operador2' || strpos($nivel, 'compra') !== false);

      // Bloqueos estrictos por rol
      $bloquear = false;
      $mensaje_bloqueo = "";

      if ($es_almacen) {
          // Almacén SOLO puede ver: inicio, stock, cambiar contraseña y password
          $permitidos_almacen = ['start', 'stock', 'password'];
          if (!in_array($module, $permitidos_almacen)) {
              $bloquear = true;
              $mensaje_bloqueo = "Tu rol de Almacén solo permite acceder al Stock de Productos y a la página de Inicio.";
          }
      } elseif ($es_compras) {
          // Compras NO puede ver gestión de usuarios ni referenciales de administración profunda
          $prohibidos_compras = ['user', 'form_user'];
          if (in_array($module, $prohibidos_compras)) {
              $bloquear = true;
              $mensaje_bloqueo = "Tu rol de Compras no tiene permisos para acceder al módulo de gestión de usuarios.";
          }
      }

      // Si intenta entrar a un módulo no autorizado, se le niega el acceso
      if ($bloquear) {
          echo '
          <section class="content-header">
            <h1>Acceso Denegado</h1>
          </section>
          <section class="content">
            <div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-ban"></i> ¡Atención!</h4>
              ' . $mensaje_bloqueo . '
            </div>
          </section>';
      } else {
          // Si pasa las validaciones, carga el contenido con normalidad
          include "content.php";
      }
      ?>

      <div class="modal fade" id="logout">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><i class="fa fa-sign-out"></i> Salir del Sistema</h4>
            </div>
            <div class="modal-body"><p>¿Seguro que quieres cerrar sesión?</p></div>
            <div class="modal-footer">
              <a class="btn btn-danger" href="logout.php">Sí, Salir</a>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <footer class="main-footer">
      <strong>Copyright &copy; <?php echo date('Y'); ?> Sistema Web de Compras y Stock</strong>
    </footer>
  </div>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.11/js/app.min.js"></script>
  <script>
    $(function () {
      $("#dataTables1").DataTable({
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        }
      });
    });
  </script>
</body>
</html>