<?php
$form = $_GET['form'];
$data = ['id_user'=>'', 'username'=>'', 'name_user'=>'', 'email'=>'', 'telefono'=>'', 'permisos_acceso'=>'Compras'];
if ($form == 'edit' && isset($_GET['id'])) {
    $q = mysqli_query($mysqli, "SELECT * FROM usuarios WHERE id_user='$_GET[id]'");
    $data = mysqli_fetch_assoc($q);
}
?>
<section class="content-header">
  <h1><i class="fa fa-edit"></i> <?php echo ($form=='add')?'Agregar':'Editar'; ?> Usuario</h1>
</section>
<section class="content">
  <div class="box box-primary">
    <form class="form-horizontal" method="POST" action="modules/user/proses.php?act=<?php echo ($form=='add')?'insert':'update'; ?>">
      <div class="box-body">
        <input type="hidden" name="id_user" value="<?php echo $data['id_user']; ?>">
        <div class="form-group">
          <label class="col-sm-2 control-label">Usuario</label>
          <div class="col-sm-5"><input type="text" class="form-control" name="username" value="<?php echo $data['username']; ?>" required></div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Nombre Completo</label>
          <div class="col-sm-5"><input type="text" class="form-control" name="name_user" value="<?php echo $data['name_user']; ?>" required></div>
        </div>
        <?php if($form == 'add') { ?>
        <div class="form-group">
          <label class="col-sm-2 control-label">Contraseña</label>
          <div class="col-sm-5"><input type="password" class="form-control" name="password" required></div>
        </div>
        <?php } ?>
        <div class="form-group">
          <label class="col-sm-2 control-label">Nivel de Acceso</label>
          <div class="col-sm-5">
            <select class="form-control" name="permisos_acceso">
              <option value="Super Admin" <?php echo ($data['permisos_acceso']=='Super Admin')?'selected':''; ?>>Super Admin</option>
              <option value="Compras" <?php echo ($data['permisos_acceso']=='Compras')?'selected':''; ?>>Compras</option>
              <option value="Almacen" <?php echo ($data['permisos_acceso']=='Almacen')?'selected':''; ?>>Almacén</option>
            </select>
          </div>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="?module=user" class="btn btn-default">Cancelar</a>
      </div>
    </form>
  </div>
</section>
