<?php
require_once "../../config/database.php";
?>
<!DOCTYPE html>
<html>
<head><title>Reporte de Clientes</title>
<style>body{font-family:Arial;} table{width:100%;border-collapse:collapse;} th,td{border:1px solid #000;padding:8px;text-align:left;}</style>
</head>
<body onload="window.print()">
  <h2>Reporte General de Clientes - Sistema Web de Compras y Stock</h2>
  <table>
    <thead><tr><th>Cód.</th><th>CI/RUC</th><th>Nombre y Apellido</th><th>Teléfono</th><th>Ciudad</th></tr></thead>
    <tbody>
      <?php
      $q = mysqli_query($mysqli, "SELECT cl.*, ci.descrip_ciudad FROM cliente cl JOIN ciudad ci ON cl.cod_ciudad=ci.cod_ciudad");
      while($d = mysqli_fetch_assoc($q)){
          echo "<tr><td>$d[cod_cliente]</td><td>$d[ci_ruc]</td><td>$d[cli_nombre] $d[cli_apellido]</td><td>$d[cli_telefono]</td><td>$d[descrip_ciudad]</td></tr>";
      }
      ?>
    </tbody>
  </table>
</body>
</html>
