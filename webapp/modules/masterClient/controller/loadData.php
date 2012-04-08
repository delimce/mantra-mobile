<?php 
$tool = new formulario();

$id = $tool->getvar("id",$_GET);

$factory = new factoryDAO("db");
$factory->setTable("tbl_cliente");

$datos = $factory->getAllDataByPk($id);

$factory->cerrar();
?>
