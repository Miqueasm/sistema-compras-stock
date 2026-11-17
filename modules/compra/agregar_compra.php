<?php
session_start();
require_once "../../config/database.php";
$session_id = session_id();

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $cantidad = intval($_POST['cantidad']);
    $precio = intval($_POST['precio']);
    mysqli_query($mysqli, "INSERT INTO tmp (id_producto, cantidad_tmp, precio_tmp, session_id) VALUES ('$id', '$cantidad', '$precio', '$session_id')");
}

if (isset($_GET['id'])) {
    $id_tmp = intval($_GET['id']);
    mysqli_query($mysqli, "DELETE FROM tmp WHERE id_tmp='$id_tmp'");
}
?>
<table class="table table-bordered table-striped">
  <thead>
    <tr><th>Cód.</th><th>Producto</th><th>Cantidad</th><th>Precio Unit.</th><th>Subtotal</th><th>Acción</th></tr>
  </thead>
  <tbody>
    <?php
    $sumador_total = 0;
    $sql = mysqli_query($mysqli, "SELECT * FROM producto p JOIN tmp t ON p.cod_producto=t.id_producto WHERE t.session_id='$session_id'");
    while ($row = mysqli_fetch_array($sql)) {
        $id_tmp = $row['id_tmp'];
        $subtotal = $row['precio_tmp'] * $row['cantidad_tmp'];
        $sumador_total += $subtotal;
        echo "<tr>
                <td>$row[cod_producto]</td>
                <td>$row[p_descrip]</td>
                <td>$row[cantidad_tmp]</td>
                <td>".number_format($row['precio_tmp'],0,',','.')."</td>
                <td>".number_format($subtotal,0,',','.')."</td>
                <td><button type='button' class='btn btn-danger btn-xs' onclick='eliminar($id_tmp)'><i class='fa fa-trash'></i></button></td>
              </tr>";
    }
    ?>
    <tr>
      <th colspan="4" class="text-right">TOTAL COMPRA (Gs.):</th>
      <th><?php echo number_format($sumador_total,0,',','.'); ?>
          <input type="hidden" name="total_compra" value="<?php echo $sumador_total; ?>">
      </th>
      <th></th>
    </tr>
  </tbody>
</table>
