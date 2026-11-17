<?php
require_once "../../config/database.php";
if ($_GET['act'] == 'insert') {
    mysqli_query($mysqli, "INSERT INTO producto(cod_tipo_prod, id_u_medida, p_descrip, precio) VALUES(1, 1, '$_POST[p_descrip]', '$_POST[precio]')");
}
header("Location: ../../main.php?module=producto");
?>
