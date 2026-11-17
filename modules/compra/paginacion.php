<?php
function paginate($reload, $page, $tpages, $adjacents) {
    $out = '<ul class="pagination pagination-sm no-margin pull-right">';
    if ($page > 1) {
        $out .= "<li><a href='javascript:void(0);' onclick='load(".($page-1).")'>&laquo; Anterior</a></li>";
    }
    for ($i = 1; $i <= $tpages; $i++) {
        $active = ($i == $page) ? "class='active'" : "";
        $out .= "<li $active><a href='javascript:void(0);' onclick='load($i)'>$i</a></li>";
    }
    if ($page < $tpages) {
        $out .= "<li><a href='javascript:void(0);' onclick='load(".($page+1).")'>Siguiente &raquo;</a></li>";
    }
    $out .= "</ul>";
    return $out;
}
?>
