<section class="content-header">
  <h1><i class="fa fa-map-marker"></i> Referencial Departamentos</h1>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-4">
      <div class="box box-primary">
        <div class="box-header with-border"><h3 class="box-title">Agregar Departamento</h3></div>
        <form method="POST" action="modules/departamento/proses.php?act=insert">
          <div class="box-body">
            <div class="form-group">
              <label>Descripción</label>
              <input type="text" class="form-control" name="depart_descripcion" required>
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
            <thead><tr><th>Código</th><th>Departamento</th><th>Acción</th></tr></thead>
            <tbody>
              <?php
              $q = mysqli_query($mysqli, "SELECT * FROM departamento ORDER BY id_departamento DESC");
              while($d = mysqli_fetch_assoc($q)){
                  echo "<tr><td>$d[id_departamento]</td><td>$d[depart_descripcion]</td>
                        <td><a class='btn btn-danger btn-xs' href='modules/departamento/proses.php?act=delete&id=$d[id_departamento]'><i class='fa fa-trash'></i></a></td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
