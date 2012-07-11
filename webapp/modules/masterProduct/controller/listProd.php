<?php
session_start();

$profile = "admin,dispatch";
include("../../../config/siteconfig.php");


//////para q los vendedores puedan visualizarlos
if ($_SESSION['PROFILE'] != "admin")
    $link = "readOnly.php?id=";
else
    $link = "editar.php?id=";

////////

$catid = Formulario::getvar("id", $_POST);

$tool = new FactoryDAO("db");

$tool->setTable("tbl_podcategoria");


$tool->setDataFilter($catid);

$tool->getAllDataProd($catid);

while ($row = $tool->db_vector_nom($tool->result)) {

    echo ' <li><a class="check" data-ajax="false" href="' . $link . $row["id"] . '">
               <div style="color:blue">' . $row["descripcion"] . '<br></div>
                     <fieldset style="font-size: 12px">';
    //  echo $row["presentacion"].'&nbsp';
    echo LANG_prodPrice . '&nbsp;' . $_SESSION['MONEDA1'] . '&nbsp';
    echo number_format($row["precio1"], 2) . '&nbsp';
    echo LANG_prodSug . '&nbsp;' . $_SESSION['MONEDA1'] . '&nbsp';
    echo number_format($row["precio3"], 2);
    echo  '</fieldset> </a></li>';
}


$tool->cerrar();


?>