<?php
require_once "config/database.php";

$module = isset($_GET['module']) ? $_GET['module'] : 'start';

switch ($module) {
    case 'start':        include "modules/start/view.php"; break;
    case 'user':         include "modules/user/view.php"; break;
    case 'form_user':    include "modules/user/form.php"; break;
    case 'profile':      include "modules/profile/view.php"; break;
    case 'form_profile': include "modules/profile/form.php"; break;
    case 'password':     include "modules/password/view.php"; break;
    case 'departamento': include "modules/departamento/view.php"; break;
    case 'ciudad':       include "modules/ciudad/view.php"; break;
    case 'cliente':      include "modules/cliente/view.php"; break;
    case 'form_cliente': include "modules/cliente/form.php"; break;
    case 'proveedor':    include "modules/proveedor/view.php"; break;
    case 'producto':     include "modules/producto/view.php"; break;
    case 'compra':       include "modules/compra/view.php"; break;
    case 'form_compra':  include "modules/compra/form.php"; break;
    case 'det_compra':   include "modules/compra/detalle.php"; break;
    case 'stock':        include "modules/stock/view.php"; break;
    default:             include "modules/start/view.php"; break;
}
?>
