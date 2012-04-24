<?php 
$tool = new factoryDAO("db");
$tool->setTable("tbl_despachador");

$id = formulario::getvar("id",$_GET);

$datos = $tool->getAllDataByPk($id);

$tool->cerrar();

?>
