<?php
session_start();
if (!empty($_SESSION['username']) && !empty($_SESSION['password'])) {
    header("Location: main.php?module=start");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login | Sistema Web de Compras y Stock</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.11/css/AdminLTE.min.css">
</head>
<body class="login-page" style="background: #222d32;">
  <div class="login-box">
    <div class="login-logo" style="color: #fff;">
      <i class="fa fa-cubes"></i> <b>Compras</b> & Stock
    </div>
    <?php
    if (isset($_GET['alert'])) {
        if ($_GET['alert'] == 1) {
            echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button><h4><i class='icon fa fa-times-circle'></i> Error de Acceso!</h4>Usuario o contraseña incorrectos, o cuenta bloqueada.</div>";
        } elseif ($_GET['alert'] == 2) {
            echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button><h4><i class='icon fa fa-check-circle'></i> Sesión Cerrada!</h4>Has salido correctamente del sistema.</div>";
        }
    }
    ?>
    <div class="login-box-body">
      <p class="login-box-msg"><i class="fa fa-user icon-title"></i> Inicie sesión para ingresar</p>
      <form action="login-check.php" method="POST">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" name="username" placeholder="Usuario (ej: admin)" autocomplete="off" required />
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" name="password" placeholder="Contraseña (ej: admin)" required />
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <input type="submit" class="btn btn-primary btn-lg btn-block btn-flat" name="login" value="Ingresar" />
          </div>
        </div>
      </form>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
