<?php
require_once "../../config/database.php";
$act = $_GET['act'];
if ($act == 'insert') {
    $desc = mysqli_real_escape_string($mysqli, trim($_POST['depart_descripcion']));
    mysqli_query($mysqli, "INSERT INTO departamento(depart_descripcion) VALUES('$desc')");
} elseif ($act == 'delete') {
    mysqli_query($mysqli, "DELETE FROM departamento WHERE id_departamento='$_GET[id]'");
}
header("Location: ../../main.php?module=departamento");
?>
