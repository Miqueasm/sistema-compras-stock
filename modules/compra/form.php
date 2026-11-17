<section class="content-header">
  <h1><i class="fa fa-plus"></i> Registrar Nueva Compra</h1>
</section>
<section class="content">
  <div class="box box-primary">
    <form class="form-horizontal" method="POST" action="modules/compra/proses.php?act=insert">
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label">Nro. Factura</label>
          <div class="col-sm-4"><input type="text" class="form-control" name="nro_factura" placeholder="001-001-0000123" required></div>
          <label class="col-sm-2 control-label">Fecha</label>
          <div class="col-sm-4"><input type="date" class="form-control" name="fecha" value="<?php echo date('Y-m-d'); ?>" required></div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Proveedor</label>
          <div class="col-sm-4">
            <select class="form-control" name="cod_proveedor" required>
              <?php
              $qp = mysqli_query($mysqli, "SELECT * FROM proveedor");
              while($dp = mysqli_fetch_assoc($qp)) echo "<option value='$dp[cod_proveedor]'>$dp[razon_social]</option>";
              ?>
            </select>
          </div>
          <label class="col-sm-2 control-label">Depósito</label>
          <div class="col-sm-4">
            <select class="form-control" name="cod_deposito" required>
              <?php
              $qd = mysqli_query($mysqli, "SELECT * FROM deposito");
              while($dd = mysqli_fetch_assoc($qd)) echo "<option value='$dd[cod_deposito]'>$dd[descrip]</option>";
              ?>
            </select>
          </div>
        </div>
        <hr>
        <div class="col-sm-12">
          <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#myModal">
            <i class="fa fa-search"></i> Buscar y Agregar Productos
          </button>
        </div>
        <div id="resultados" class="col-md-12" style="margin-top:15px;"></div>
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Guardar Compra</button>
        <a href="?module=compra" class="btn btn-default">Cancelar</a>
      </div>
    </form>
  </div>
</section>

<!-- Modal Productos -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Buscar Productos</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <input type="text" class="form-control" id="q" placeholder="Escriba el nombre del producto..." onkeyup="load(1)">
        </div>
        <div id="loader"></div>
        <div class="outer_div"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
    load(1);
    cargarTablaTemp();
});

function load(page){
    var q = $("#q").val();
    $("#loader").html("Cargando...");
    $.ajax({
        url: 'modules/compra/productos_pedidos.php?action=ajax&page='+page+'&q='+encodeURIComponent(q),
        success: function(data){
            $(".outer_div").html(data);
            $("#loader").html("");
        }
    });
}

function agregar(id){
    var precio = document.getElementById('precio_'+id).value;
    var cantidad = document.getElementById('cantidad_'+id).value;
    if (isNaN(cantidad) || cantidad <= 0) { alert('Cantidad inválida'); return; }
    if (isNaN(precio) || precio <= 0) { alert('Precio inválido'); return; }

    $.ajax({
        type: "POST",
        url: "modules/compra/agregar_compra.php",
        data: {id: id, precio: precio, cantidad: cantidad},
        success: function(datos){
            $("#resultados").html(datos);
        }
    });
}

function eliminar(id){
    $.ajax({
        type: "GET",
        url: "modules/compra/agregar_compra.php",
        data: {id: id},
        success: function(datos){
            $("#resultados").html(datos);
        }
    });
}

function cargarTablaTemp(){
    $.ajax({
        url: "modules/compra/agregar_compra.php",
        success: function(datos){
            $("#resultados").html(datos);
        }
    });
}
</script>
