<?php
session_start();
require_once "../../config/database.php";
if (isset($_POST['save'])) {
    $id       = $_SESSION['id_user'];
    $username = mysqli_real_escape_string($mysqli, trim($_POST['username']));
    $name     = mysqli_real_escape_string($mysqli, trim($_POST['name_user']));
    $email    = mysqli_real_escape_string($mysqli, trim($_POST['email']));
    $tel      = mysqli_real_escape_string($mysqli, trim($_POST['telefono']));
    mysqli_query($mysqli, "UPDATE usuarios SET username='$username', name_user='$name', email='$email', telefono='$tel' WHERE id_user='$id'");
    $_SESSION['name_user'] = $name;
}
header("Location: ../../main.php?module=profile");
?>
