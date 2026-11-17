<section class="content-header">
  <h1><i class="fa fa-lock icon-title"></i> Cambiar Contraseña</h1>
</section>
<section class="content">
  <div class="box box-primary">
    <form class="form-horizontal" method="POST" action="modules/password/proses.php">
      <div class="box-body">
        <?php if(isset($_GET['alert']) && $_GET['alert']==1) echo "<div class='alert alert-success'>Contraseña actualizada correctamente.</div>"; ?>
        <?php if(isset($_GET['alert']) && $_GET['alert']==2) echo "<div class='alert alert-danger'>La contraseña actual no coincide o las nuevas no son iguales.</div>"; ?>
        <div class="form-group">
          <label class="col-sm-2 control-label">Contraseña Actual</label>
          <div class="col-sm-5"><input type="password" class="form-control" name="old_pass" required></div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Nueva Contraseña</label>
          <div class="col-sm-5"><input type="password" class="form-control" name="new_pass" required></div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Repetir Nueva</label>
          <div class="col-sm-5"><input type="password" class="form-control" name="retype_pass" required></div>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary" name="save">Guardar Cambios</button>
      </div>
    </form>
  </div>
</section>
