<?php
require_once "../../config/database.php";
$act = $_GET['act'];

if ($act == 'insert') {
    $username = mysqli_real_escape_string($mysqli, trim($_POST['username']));
    $name     = mysqli_real_escape_string($mysqli, trim($_POST['name_user']));
    $pass     = md5(trim($_POST['password']));
    $perm     = $_POST['permisos_acceso'];
    mysqli_query($mysqli, "INSERT INTO usuarios(username, name_user, password, permisos_acceso) VALUES('$username','$name','$pass','$perm')");
} elseif ($act == 'update') {
    $id       = $_POST['id_user'];
    $username = mysqli_real_escape_string($mysqli, trim($_POST['username']));
    $name     = mysqli_real_escape_string($mysqli, trim($_POST['name_user']));
    $perm     = $_POST['permisos_acceso'];
    mysqli_query($mysqli, "UPDATE usuarios SET username='$username', name_user='$name', permisos_acceso='$perm' WHERE id_user='$id'");
} elseif ($act == 'on') {
    mysqli_query($mysqli, "UPDATE usuarios SET status='activo' WHERE id_user='$_GET[id]'");
} elseif ($act == 'off') {
    mysqli_query($mysqli, "UPDATE usuarios SET status='bloqueado' WHERE id_user='$_GET[id]'");
}
header("Location: ../../main.php?module=user");
?>
