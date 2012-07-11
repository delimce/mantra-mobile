<?php 
$tool = new Formulario();

$id = $tool->getvar("id",$_GET);

$factory = new FactoryDAO("db");
$factory->setTable("tbl_cliente");

$datos = $factory->getAllDataByPk($id);

$factory->cerrar();
?>
