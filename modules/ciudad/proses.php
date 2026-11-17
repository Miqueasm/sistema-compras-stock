<?php
require_once "../../config/database.php";
$act = $_GET['act'];
if ($act == 'insert') {
    $desc = mysqli_real_escape_string($mysqli, trim($_POST['descrip_ciudad']));
    $dep  = $_POST['id_departamento'];
    mysqli_query($mysqli, "INSERT INTO ciudad(descrip_ciudad, id_departamento) VALUES('$desc','$dep')");
} elseif ($act == 'delete') {
    mysqli_query($mysqli, "DELETE FROM ciudad WHERE cod_ciudad='$_GET[id]'");
}
header("Location: ../../main.php?module=ciudad");
?>
