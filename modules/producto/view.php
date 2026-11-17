<section class="content-header"><h1><i class="fa fa-tags"></i> Productos</h1></section>
<section class="content">
  <div class="box box-primary"><div class="box-body">
    <form class="form-inline" method="POST" action="modules/producto/proses.php?act=insert" style="margin-bottom:15px;">
      <input type="text" class="form-control" name="p_descrip" placeholder="Descripción Producto" required>
      <input type="number" class="form-control" name="precio" placeholder="Precio Gs." required>
      <button type="submit" class="btn btn-primary">Agregar Producto</button>
    </form>
    <table id="dataTables1" class="table table-bordered">
      <thead><tr><th>Código</th><th>Producto</th><th>Tipo</th><th>U. Medida</th><th>Precio</th></tr></thead>
      <tbody>
        <?php
        $q = mysqli_query($mysqli, "SELECT p.*, t.t_p_descrip, u.u_descrip FROM producto p JOIN tipo_producto t ON p.cod_tipo_prod=t.cod_tipo_prod JOIN u_medida u ON p.id_u_medida=u.id_u_medida");
        while($d = mysqli_fetch_assoc($q)) echo "<tr><td>$d[cod_producto]</td><td>$d[p_descrip]</td><td>$d[t_p_descrip]</td><td>$d[u_descrip]</td><td>".number_format($d['precio'],0,',','.')."</td></tr>";
        ?>
      </tbody>
    </table>
  </div></div>
</section>
