<?php 
$tool = new Formulario();

$id = $tool->getvar("id",$_GET);

$factory = new FactoryDAO("db");
$factory->setTable("tbl_clientcategoria");

$datos = $factory->getAllDataByPk($id);

$factory->cerrar();

?>
