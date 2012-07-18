<?php
session_start();

$profile = "admin,dispatch";
include("../../../config/siteconfig.php");

$link = "detalle.php?id=";

////////

$catid = Formulario::getvar("id", $_POST);

$tool = new FactoryDAO("db");

$tool->setTable("tbl_inventario");


$tool->setDataFilter($catid);

$tool->getInventario($catid);

while ($row = $tool->db_vector_nom($tool->result)) {

    echo '<li><a class="check" data-ajax="false" href="' . $link . $row["id"] . '">
            <div style="color:blue">' . $row["descripcion"] . '<br></div>
            <fieldset style="font-size: 12px">';

    if ($row["cantidad"] <= 0) $color = "color: red"; else $color = "color: back";

    echo '   <div style="' . $color . '"> <b>cantidad:</b> ' . $row["cantidad"] . '</div>';

    echo '</fieldset> </a></li>';


}


$tool->cerrar();


?>