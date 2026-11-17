<?php
session_start();
require_once "../../config/database.php";
$act = $_GET['act'];
$session_id = session_id();

if ($act == 'insert') {
    $cod_proveedor = $_POST['cod_proveedor'];
    $cod_deposito  = $_POST['cod_deposito'];
    $nro_factura   = mysqli_real_escape_string($mysqli, trim($_POST['nro_factura']));
    $fecha         = $_POST['fecha'];
    $hora          = date("H:i:s");
    $total_compra  = intval($_POST['total_compra']);
    $id_user       = $_SESSION['id_user'];

    if ($total_compra <= 0) {
        header("Location: ../../main.php?module=form_compra");
        exit;
    }

    // 1. Obtener productos de tmp antes de insertar compra (porque el trigger borrar_temp limpia tmp al insertar compra)
    $tmp_items = [];
    $q_tmp = mysqli_query($mysqli, "SELECT * FROM tmp WHERE session_id='$session_id'");
    while ($r = mysqli_fetch_assoc($q_tmp)) {
        $tmp_items[] = $r;
    }

    // 2. Insertar cabecera de compra (dispara automáticamente el trigger borrar_temp)
    mysqli_query($mysqli, "INSERT INTO compra (cod_proveedor, cod_deposito, nro_factura, fecha, hora, total_compra, id_user)
                          VALUES ('$cod_proveedor', '$cod_deposito', '$nro_factura', '$fecha', '$hora', '$total_compra', '$id_user')")
    or die('Error: ' . mysqli_error($mysqli));

    $cod_compra = mysqli_insert_id($mysqli);

    // 3. Insertar detalle y actualizar stock
    foreach ($tmp_items as $item) {
        $cod_prod = $item['id_producto'];
        $cant     = $item['cantidad_tmp'];
        $precio   = $item['precio_tmp'];

        mysqli_query($mysqli, "INSERT INTO detalle_compra (cod_compra, cod_producto, precio, cantidad)
                              VALUES ('$cod_compra', '$cod_prod', '$precio', '$cant')");

        // Actualizar o insertar stock en el depósito seleccionado
        $q_stock = mysqli_query($mysqli, "SELECT * FROM stock WHERE cod_deposito='$cod_deposito' AND cod_producto='$cod_prod'");
        if (mysqli_num_rows($q_stock) > 0) {
            mysqli_query($mysqli, "UPDATE stock SET cantidad = cantidad + $cant WHERE cod_deposito='$cod_deposito' AND cod_producto='$cod_prod'");
        } else {
            mysqli_query($mysqli, "INSERT INTO stock (cod_deposito, cod_producto, cantidad) VALUES ('$cod_deposito', '$cod_prod', '$cant')");
        }
    }

    header("Location: ../../main.php?module=compra");

} elseif ($act == 'anular') {
    $cod_compra = intval($_GET['id']);
    $c = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * FROM compra WHERE cod_compra='$cod_compra'"));

    if ($c['estado'] == 'activo') {
        mysqli_query($mysqli, "UPDATE compra SET estado='anulado' WHERE cod_compra='$cod_compra'");
        $qd = mysqli_query($mysqli, "SELECT * FROM detalle_compra WHERE cod_compra='$cod_compra'");
        while ($d = mysqli_fetch_assoc($qd)) {
            mysqli_query($mysqli, "UPDATE stock SET cantidad = cantidad - $d[cantidad] WHERE cod_deposito='$c[cod_deposito]' AND cod_producto='$d[cod_producto]'");
        }
    }
    header("Location: ../../main.php?module=compra");
}
?>
