<?php
require_once "../../config/database.php";
?>
<!DOCTYPE html>
<html>
<head><title>Reporte de Ciudades</title>
<style>body{font-family:Arial;} table{width:100%;border-collapse:collapse;} th,td{border:1px solid #000;padding:8px;text-align:left;}</style>
</head>
<body onload="window.print()">
  <h2>Reporte de Ciudades</h2>
  <table>
    <thead><tr><th>Código</th><th>Ciudad</th><th>Departamento</th></tr></thead>
    <tbody>
      <?php
      $q = mysqli_query($mysqli, "SELECT c.*, d.depart_descripcion FROM ciudad c JOIN departamento d ON c.id_departamento=d.id_departamento");
      while($d = mysqli_fetch_assoc($q)){
          echo "<tr><td>$d[cod_ciudad]</td><td>$d[descrip_ciudad]</td><td>$d[depart_descripcion]</td></tr>";
      }
      ?>
    </tbody>
  </table>
</body>
</html>
