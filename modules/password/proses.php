<?php
session_start();
require_once "../../config/database.php";

if (isset($_POST['save'])) {
    $id_user     = $_SESSION['id_user'];
    $old_pass    = md5(trim($_POST['old_pass']));
    $new_pass    = md5(trim($_POST['new_pass']));
    $retype_pass = md5(trim($_POST['retype_pass']));

    $q = mysqli_query($mysqli, "SELECT password FROM usuarios WHERE id_user='$id_user'");
    $d = mysqli_fetch_assoc($q);

    if ($d['password'] == $old_pass && $new_pass == $retype_pass) {
        mysqli_query($mysqli, "UPDATE usuarios SET password='$new_pass' WHERE id_user='$id_user'");
        header("Location: ../../main.php?module=password&alert=1");
    } else {
        header("Location: ../../main.php?module=password&alert=2");
    }
}
?>
