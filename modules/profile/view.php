<?php
$q = mysqli_query($mysqli, "SELECT * FROM usuarios WHERE id_user='$_SESSION[id_user]'");
$d = mysqli_fetch_assoc($q);
?>
<section class="content-header">
  <h1><i class="fa fa-user"></i> Perfil de Usuario</h1>
</section>
<section class="content">
  <div class="box box-primary">
    <form class="form-horizontal" method="POST" action="modules/profile/proses.php">
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label">Usuario</label>
          <div class="col-sm-5"><input type="text" class="form-control" name="username" value="<?php echo $d['username']; ?>" required></div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Nombre</label>
          <div class="col-sm-5"><input type="text" class="form-control" name="name_user" value="<?php echo $d['name_user']; ?>" required></div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Email</label>
          <div class="col-sm-5"><input type="email" class="form-control" name="email" value="<?php echo $d['email']; ?>"></div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Teléfono</label>
          <div class="col-sm-5"><input type="text" class="form-control" name="telefono" value="<?php echo $d['telefono']; ?>"></div>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary" name="save">Actualizar Perfil</button>
      </div>
    </form>
  </div>
</section>
