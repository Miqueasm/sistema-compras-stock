<?php
require_once "../../config/database.php";
$id = $_GET['id'];
$c = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * FROM v_compras WHERE cod_compra='$id'"));
?>
<!DOCTYPE html>
<html>
<head><title>Comprobante de Compra #<?php echo $id; ?></title>
<style>body{font-family:Arial;} table{width:100%;border-collapse:collapse;} th,td{border:1px solid #000;padding:8px;}</style>
</head>
<body onload="window.print()">
  <h2>Comprobante de Compra #<?php echo $c['cod_compra']; ?></h2>
  <p><strong>Proveedor:</strong> <?php echo $c['razon_social']; ?> | <strong>Factura:</strong> <?php echo $c['nro_factura']; ?> | <strong>Fecha:</strong> <?php echo $c['fecha']; ?></p>
  <table>
    <thead><tr><th>Producto</th><th>Medida</th><th>Cantidad</th><th>Precio</th><th>Subtotal</th></tr></thead>
    <tbody>
      <?php
      $qd = mysqli_query($mysqli, "SELECT * FROM v_det_compra WHERE cod_compra='$id'");
      while($d = mysqli_fetch_assoc($qd)){
          $sub = $d['precio'] * $d['cantidad'];
          echo "<tr><td>$d[p_descrip]</td><td>$d[u_descrip]</td><td>$d[cantidad]</td><td>".number_format($d['precio'],0,',','.')."</td><td>".number_format($sub,0,',','.')."</td></tr>";
      }
      ?>
    </tbody>
  </table>
  <h3>Total: Gs. <?php echo number_format($c['total_compra'],0,',','.'); ?></h3>
</body>
</html>
