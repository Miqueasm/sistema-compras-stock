<?php
require_once "../../config/database.php";
if ($_GET['act'] == 'insert') {
    mysqli_query($mysqli, "INSERT INTO proveedor(razon_social, ruc, telefono) VALUES('$_POST[razon_social]','$_POST[ruc]','$_POST[telefono]')");
}
header("Location: ../../main.php?module=proveedor");
?>
