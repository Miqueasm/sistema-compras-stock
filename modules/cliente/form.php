<?php
$form = $_GET['form'];
$d = ['cod_cliente'=>'','ci_ruc'=>'','cli_nombre'=>'','cli_apellido'=>'','cli_direccion'=>'','cli_telefono'=>'','cod_ciudad'=>''];
if ($form == 'edit') {
    $q = mysqli_query($mysqli, "SELECT * FROM cliente WHERE cod_cliente='$_GET[id]'");
    $d = mysqli_fetch_assoc($q);
}
?>
<section class="content-header"><h1><?php echo ($form=='add')?'Nuevo':'Editar'; ?> Cliente</h1></section>
<section class="content">
  <div class="box box-primary">
    <form class="form-horizontal" method="POST" action="modules/cliente/proses.php?act=<?php echo ($form=='add')?'insert':'update'; ?>">
      <div class="box-body">
        <input type="hidden" name="cod_cliente" value="<?php echo $d['cod_cliente']; ?>">
        <div class="form-group">
          <label class="col-sm-2 control-label">CI / RUC</label>
          <div class="col-sm-5"><input type="text" class="form-control" name="ci_ruc" value="<?php echo $d['ci_ruc']; ?>" required></div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Nombre</label>
          <div class="col-sm-5"><input type="text" class="form-control" name="cli_nombre" value="<?php echo $d['cli_nombre']; ?>" required></div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Apellido</label>
          <div class="col-sm-5"><input type="text" class="form-control" name="cli_apellido" value="<?php echo $d['cli_apellido']; ?>" required></div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Teléfono</label>
          <div class="col-sm-5"><input type="text" class="form-control" name="cli_telefono" value="<?php echo $d['cli_telefono']; ?>"></div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Dirección</label>
          <div class="col-sm-5"><input type="text" class="form-control" name="cli_direccion" value="<?php echo $d['cli_direccion']; ?>"></div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Ciudad</label>
          <div class="col-sm-5">
            <select class="form-control" name="cod_ciudad" required>
              <?php
              $qc = mysqli_query($mysqli, "SELECT * FROM ciudad");
              while($dc = mysqli_fetch_assoc($qc)){
                  $sel = ($dc['cod_ciudad']==$d['cod_ciudad'])?'selected':'';
                  echo "<option value='$dc[cod_ciudad]' $sel>$dc[descrip_ciudad]</option>";
              }
              ?>
            </select>
          </div>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="?module=cliente" class="btn btn-default">Cancelar</a>
      </div>
    </form>
  </div>
</section>
