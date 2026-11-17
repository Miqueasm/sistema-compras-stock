<?php
require_once "../../config/database.php";
$act = $_GET['act'];
if ($act == 'insert') {
    mysqli_query($mysqli, "INSERT INTO cliente(ci_ruc, cli_nombre, cli_apellido, cli_direccion, cli_telefono, cod_ciudad)
                          VALUES('$_POST[ci_ruc]','$_POST[cli_nombre]','$_POST[cli_apellido]','$_POST[cli_direccion]','$_POST[cli_telefono]','$_POST[cod_ciudad]')");
} elseif ($act == 'update') {
    mysqli_query($mysqli, "UPDATE cliente SET ci_ruc='$_POST[ci_ruc]', cli_nombre='$_POST[cli_nombre]', cli_apellido='$_POST[cli_apellido]',
                          cli_direccion='$_POST[cli_direccion]', cli_telefono='$_POST[cli_telefono]', cod_ciudad='$_POST[cod_ciudad]'
                          WHERE cod_cliente='$_POST[cod_cliente]'");
} elseif ($act == 'delete') {
    mysqli_query($mysqli, "DELETE FROM cliente WHERE cod_cliente='$_GET[id]'");
}
header("Location: ../../main.php?module=cliente");
?>
