<?php 
$tool = new FactoryDAO("db");
$tool->setTable("tbl_despachador");

$id = Formulario::getvar("id",$_GET);

$datos = $tool->getAllDataByPk($id);

$tool->cerrar();

?>
