<?php
$id = $_GET['id'];
$q = mysqli_query($mysqli, "SELECT * FROM v_compras WHERE cod_compra='$id'");
$c = mysqli_fetch_assoc($q);
?>
<section class="content-header">
  <h1>Detalle de Compra #<?php echo $c['cod_compra']; ?>
    <a class="btn btn-default btn-sm pull-right" href="?module=compra"><i class="fa fa-arrow-left"></i> Volver</a>
  </h1>
</section>
<section class="content">
  <div class="box box-primary">
    <div class="box-body">
      <div class="row">
        <div class="col-md-4"><strong>Proveedor:</strong> <?php echo $c['razon_social']; ?></div>
        <div class="col-md-4"><strong>Factura:</strong> <?php echo $c['nro_factura']; ?></div>
        <div class="col-md-4"><strong>Depósito:</strong> <?php echo $c['descrip']; ?></div>
      </div>
      <hr>
      <table class="table table-bordered">
        <thead><tr><th>Código</th><th>Producto</th><th>Tipo</th><th>Medida</th><th>Cantidad</th><th>Precio</th><th>Subtotal</th></tr></thead>
        <tbody>
          <?php
          $qd = mysqli_query($mysqli, "SELECT * FROM v_det_compra WHERE cod_compra='$id'");
          while($d = mysqli_fetch_assoc($qd)){
              $sub = $d['precio'] * $d['cantidad'];
              echo "<tr><td>$d[cod_producto]</td><td>$d[p_descrip]</td><td>$d[t_p_descrip]</td><td>$d[u_descrip]</td><td>$d[cantidad]</td><td>".number_format($d['precio'],0,',','.')."</td><td>".number_format($sub,0,',','.')."</td></tr>";
          }
          ?>
        </tbody>
        <tfoot><tr><th colspan="6" class="text-right">TOTAL COMPRA:</th><th>Gs. <?php echo number_format($c['total_compra'],0,',','.'); ?></th></tr></tfoot>
      </table>
    </div>
  </div>
</section>
