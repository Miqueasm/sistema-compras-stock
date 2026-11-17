<?php
$server   = "localhost";
$username = "root";
$password = "";
$database = "sistema_compras_stock";

$mysqli = new mysqli($server, $username, $password, $database);

if ($mysqli->connect_error) {
    die('Error de Conexión a la Base de Datos: ' . $mysqli->connect_error);
}
$mysqli->set_charset("utf8");
?>
