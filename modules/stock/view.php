<section class="content-header">
  <h1><i class="fa fa-cubes"></i> Stock de Productos en Depósitos</h1>
</section>
<section class="content">
  <div class="box box-primary">
    <div class="box-body">
      <table id="dataTables1" class="table table-bordered table-striped">
        <thead>
          <tr><th>Depósito</th><th>Cód. Prod.</th><th>Producto</th><th>Tipo</th><th>Unidad Medida</th><th>Existencia Actual</th></tr>
        </thead>
        <tbody>
          <?php
          $q = mysqli_query($mysqli, "SELECT s.cantidad, d.descrip AS deposito, p.cod_producto, p.p_descrip, t.t_p_descrip, u.u_descrip
                                      FROM stock s
                                      JOIN deposito d ON s.cod_deposito = d.cod_deposito
                                      JOIN producto p ON s.cod_producto = p.cod_producto
                                      JOIN tipo_producto t ON p.cod_tipo_prod = t.cod_tipo_prod
                                      JOIN u_medida u ON p.id_u_medida = u.id_u_medida
                                      ORDER BY d.descrip ASC, p.p_descrip ASC");
          while($d = mysqli_fetch_assoc($q)){
              $label = ($d['cantidad'] <= 5) ? "label-danger" : "label-success";
              echo "<tr>
                      <td>$d[deposito]</td>
                      <td>$d[cod_producto]</td>
                      <td>$d[p_descrip]</td>
                      <td>$d[t_p_descrip]</td>
                      <td>$d[u_descrip]</td>
                      <td><span class='label $label' style='font-size:13px;'>$d[cantidad]</span></td>
                    </tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</section>
