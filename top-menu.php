<?php
require_once "config/database.php";
$query = mysqli_query($mysqli, "SELECT id_user, name_user, foto, permisos_acceso FROM usuarios WHERE id_user='$_SESSION[id_user]'")
         or die('Error: ' . mysqli_error($mysqli));
$data = mysqli_fetch_assoc($query);
?>
<li class="dropdown user user-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-user-circle"></i>
    <span class="hidden-xs"><?php echo $data['name_user']; ?> <i style="margin-left:5px" class="fa fa-angle-down"></i></span>
  </a>
  <ul class="dropdown-menu">
    <li class="user-header">
      <i class="fa fa-user-circle fa-4x" style="color:#fff;"></i>
      <p>
        <?php echo $data['name_user']; ?>
        <small><?php echo $data['permisos_acceso']; ?></small>
      </p>
    </li>
    <li class="user-footer">
      <div class="pull-left">
        <a href="?module=profile" class="btn btn-default btn-flat">Perfil</a>
      </div>
      <div class="pull-right">
        <a data-toggle="modal" href="#logout" class="btn btn-default btn-flat">Salir</a>
      </div>
    </li>
  </ul>
</li>
