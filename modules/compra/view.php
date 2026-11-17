<section class="content-header">
  <h1><i class="fa fa-shopping-cart"></i> Movimiento de Compras
    <a class="btn btn-primary btn-sm pull-right" href="?module=form_compra"><i class="fa fa-plus"></i> Registrar Compra</a>
  </h1>
</section>
<section class="content">
  <div class="box box-primary">
    <div class="box-body">
      <table id="dataTables1" class="table table-bordered table-striped">
        <thead>
          <tr><th>Cód.</th><th>Nro. Factura</th><th>Proveedor</th><th>Depósito</th><th>Fecha</th><th>Total (Gs.)</th><th>Estado</th><th>Acciones</th></tr>
        </thead>
        <tbody>
          <?php<section class="content-header">
  <h1><i class="fa fa-shopping-cart"></i> Movimiento de Compras
    <a class="btn btn-primary btn-sm pull-right" href="?module=form_compra"><i class="fa fa-plus"></i> Registrar Compra</a>
  </h1>
</section>
<section class="content">
  <div class="box box-primary">
    <div class="box-body">
      <table id="dataTables1" class="table table-bordered table-striped">
        <thead>
          <tr><th>Cód.</th><th>Nro. Factura</th><th>Proveedor</th><th>Depósito</th><th>Fecha</th><th>Total (Gs.)</th><th>Estado</th><th>Acciones</th></tr>
        </thead>
        <tbody>
          <?php
          $q = mysqli_query($mysqli, "SELECT * FROM v_compras ORDER BY cod_compra DESC");
          while($d = mysqli_fetch_assoc($q)){
              $badge = ($d['estado']=='activo') ? "<span class='label label-success'>Activo</span>" : "<span class='label label-danger'>Anulado</span>";
              $btn_anular = ($d['estado']=='activo') ? "<a class='btn btn-danger btn-xs' href='modules/compra/proses.php?act=anular&id=$d[cod_compra]' onclick='return confirm(\"¿Anular esta compra? Se descontará el stock.\")' title='Anular'><i class='fa fa-times'></i></a>" : "";
              
              echo "<tr>
                      <td>$d[cod_compra]</td>
                      <td>$d[nro_factura]</td>
                      <td>$d[razon_social]</td>
                      <td>$d[descrip]</td>
                      <td>$d[fecha]</td>
                      <td>".number_format($d['total_compra'],0,',','.')."</td>
                      <td>$badge</td>
                      <td>
                        <a class='btn btn-info btn-xs' href='?module=det_compra&id=$d[cod_compra]' title='Ver Detalle'><i class='fa fa-eye'></i></a>
                        <a class='btn btn-default btn-xs' href='modules/compra/print.php?id=$d[cod_compra]' target='_blank' title='Imprimir'><i class='fa fa-print'></i></a>
                        $btn_anular
                      </td>
                    </tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</section>
          $q = mysqli_query($mysqli, "SELECT * FROM v_compras ORDER BY cod_compra DESC");
          while($d = mysqli_fetch_assoc($q)){
              $badge = ($d['estado']=='activo') ? "<span class='label label-success'>Activo</span>" : "<span class='label label-danger'>Anulado</span>";
             $btn_anular = ($d['estado']=='activo') ? "<a class='btn btn-danger btn-xs' href='modules/compra/proses.php?act=anular&id=$d[cod_compra]' onclick='return confirm(\"¿Anular esta compra? Se descontará el stock.\")' title='Anular'><i class='fa fa-times'></i></a>" : "";
                      </td>
                    </tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</section>
