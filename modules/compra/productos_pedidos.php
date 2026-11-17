<?php
require_once "../../config/database.php";
include 'paginacion.php';

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
if ($action == 'ajax') {
    $q = mysqli_real_escape_string($mysqli, strip_tags($_REQUEST['q'], ENT_QUOTES));
    $sWhere = "";
    if ($q != "") {
        $sWhere = "WHERE p.p_descrip LIKE '%$q%'";
    }
    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
    $per_page = 5;
    $offset = ($page - 1) * $per_page;

    $count_query = mysqli_query($mysqli, "SELECT count(*) AS numrows FROM producto p $sWhere");
    $row = mysqli_fetch_array($count_query);
    $numrows = $row['numrows'];
    $total_pages = ceil($numrows / $per_page);

    $sql = "SELECT p.*, t.t_p_descrip, u.u_descrip FROM producto p
            JOIN tipo_producto t ON p.cod_tipo_prod=t.cod_tipo_prod
            JOIN u_medida u ON p.id_u_medida=u.id_u_medida
            $sWhere LIMIT $offset, $per_page";
    $query = mysqli_query($mysqli, $sql);

    if ($numrows > 0) {
        echo "<div class='table-responsive'><table class='table table-bordered table-hover'>
                <thead><tr><th>Cód.</th><th>Producto</th><th>Tipo</th><th>Medida</th><th>Cant.</th><th>Precio</th><th>Agregar</th></tr></thead><tbody>";
        while ($row = mysqli_fetch_array($query)) {
            $id = $row['cod_producto'];
            echo "<tr>
                    <td>$id</td>
                    <td>$row[p_descrip]</td>
                    <td>$row[t_p_descrip]</td>
                    <td>$row[u_descrip]</td>
                    <td class='col-xs-2'><input type='number' class='form-control input-sm' id='cantidad_$id' value='1' min='1'></td>
                    <td class='col-xs-2'><input type='number' class='form-control input-sm' id='precio_$id' value='$row[precio]'></td>
                    <td><button type='button' class='btn btn-success btn-sm' onclick='agregar($id)'><i class='fa fa-plus'></i></button></td>
                  </tr>";
        }
        echo "<tr><td colspan='7'><span class='pull-right'>" . paginate('index.php', $page, $total_pages, 4) . "</span></td></tr>";
        echo "</tbody></table></div>";
    } else {
        echo "<div class='alert alert-warning'>No se encontraron productos.</div>";
    }
}
?>
