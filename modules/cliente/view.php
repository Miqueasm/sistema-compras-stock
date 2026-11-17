<section class="content-header">
  <h1><i class="fa fa-user"></i> Gestión de Clientes
    <div class="pull-right">
      <a class="btn btn-info btn-sm" href="modules/cliente/print.php" target="_blank"><i class="fa fa-print"></i> Reporte PDF</a>
      <a class="btn btn-primary btn-sm" href="?module=form_cliente&form=add"><i class="fa fa-plus"></i> Nuevo Cliente</a>
    </div>
  </h1>
</section>
<section class="content">
  <div class="box box-primary">
    <div class="box-body">
      <table id="dataTables1" class="table table-bordered table-striped">
        <thead>
          <tr><th>Cód.</th><th>CI / RUC</th><th>Nombre y Apellido</th><th>Teléfono</th><th>Ciudad</th><th>Acciones</th></tr>
        </thead>
        <tbody>
          <?php
          $q = mysqli_query($mysqli, "SELECT cl.*, ci.descrip_ciudad FROM cliente cl JOIN ciudad ci ON cl.cod_ciudad=ci.cod_ciudad ORDER BY cl.cod_cliente DESC");
          while($d = mysqli_fetch_assoc($q)){
              echo "<tr>
                      <td>$d[cod_cliente]</td>
                      <td>$d[ci_ruc]</td>
                      <td>$d[cli_nombre] $d[cli_apellido]</td>
                      <td>$d[cli_telefono]</td>
                      <td>$d[descrip_ciudad]</td>
                      <td>
                        <a class='btn btn-primary btn-xs' href='?module=form_cliente&form=edit&id=$d[cod_cliente]' title='Modificar'><i class='fa fa-edit'></i></a>
                        <a class='btn btn-danger btn-xs' href='modules/cliente/proses.php?act=delete&id=$d[cod_cliente]' onclick='return confirm(\"¿Desea eliminar este cliente?\")' title='Eliminar'><i class='fa fa-trash'></i></a>
                      </td>
                    </tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</section>