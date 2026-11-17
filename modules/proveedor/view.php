<section class="content-header"><h1><i class="fa fa-truck"></i> Proveedores</h1></section>
<section class="content">
  <div class="box box-primary"><div class="box-body">
    <form class="form-inline" method="POST" action="modules/proveedor/proses.php?act=insert" style="margin-bottom:15px;">
      <input type="text" class="form-control" name="razon_social" placeholder="Razón Social" required>
      <input type="text" class="form-control" name="ruc" placeholder="RUC" required>
      <input type="text" class="form-control" name="telefono" placeholder="Teléfono">
      <button type="submit" class="btn btn-primary">Agregar Proveedor</button>
    </form>
    <table id="dataTables1" class="table table-bordered">
      <thead><tr><th>ID</th><th>Razón Social</th><th>RUC</th><th>Teléfono</th></tr></thead>
      <tbody>
        <?php
        $q = mysqli_query($mysqli, "SELECT * FROM proveedor");
        while($d = mysqli_fetch_assoc($q)) echo "<tr><td>$d[cod_proveedor]</td><td>$d[razon_social]</td><td>$d[ruc]</td><td>$d[telefono]</td></tr>";
        ?>
      </tbody>
    </table>
  </div></div>
</section>
