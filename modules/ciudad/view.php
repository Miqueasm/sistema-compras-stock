<section class="content-header">
  <h1><i class="fa fa-building"></i> Referencial Ciudades
    <a class="btn btn-info btn-sm pull-right" href="modules/ciudad/print.php" target="_blank"><i class="fa fa-print"></i> Imprimir Reporte</a>
  </h1>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-4">
      <div class="box box-primary">
        <div class="box-header with-border"><h3 class="box-title">Agregar Ciudad</h3></div>
        <form method="POST" action="modules/ciudad/proses.php?act=insert">
          <div class="box-body">
            <div class="form-group">
              <label>Ciudad</label>
              <input type="text" class="form-control" name="descrip_ciudad" required>
            </div>
            <div class="form-group">
              <label>Departamento</label>
              <select class="form-control" name="id_departamento" required>
                <?php
                $qd = mysqli_query($mysqli, "SELECT * FROM departamento");
                while($dd = mysqli_fetch_assoc($qd)) echo "<option value='$dd[id_departamento]'>$dd[depart_descripcion]</option>";
                ?>
              </select>
            </div>
          </div>
          <div class="box-footer"><button type="submit" class="btn btn-primary">Guardar</button></div>
        </form>
      </div>
    </div>
    <div class="col-md-8">
      <div class="box box-primary">
        <div class="box-body">
          <table id="dataTables1" class="table table-bordered table-striped">
            <thead><tr><th>Código</th><th>Ciudad</th><th>Departamento</th><th>Acción</th></tr></thead>
            <tbody>
              <?php
              $q = mysqli_query($mysqli, "SELECT c.*, d.depart_descripcion FROM ciudad c JOIN departamento d ON c.id_departamento=d.id_departamento ORDER BY c.cod_ciudad DESC");
              while($d = mysqli_fetch_assoc($q)){
                  echo "<tr><td>$d[cod_ciudad]</td><td>$d[descrip_ciudad]</td><td>$d[depart_descripcion]</td>
                        <td><a class='btn btn-danger btn-xs' href='modules/ciudad/proses.php?act=delete&id=$d[cod_ciudad]'><i class='fa fa-trash'></i></a></td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
