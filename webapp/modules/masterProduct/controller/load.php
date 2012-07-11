<?php
$tool = new FactoryDAO("db");


////filtro por categoria


$tool->setTable("tbl_podcategoria");
$seleccionado = $tool->getDataFilter();

$querycat = $tool->getComboCatProd2($seleccionado);


$tool->setTable("tbl_producto");
$tool->getAllDataProd($seleccionado);


//////para q los vendedores puedan visualizarlos
if ($_SESSION['PROFILE'] != "admin") {

    $regreso = "../lobi.php";
    $link = "readOnly.php?id=";

} else {
    $regreso = "../lobiMaster.php";
    $link = "editar.php?id=";


}






?>
