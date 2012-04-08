<?php 
$tool = new formulario();

$id = $tool->getvar("id",$_GET);

$factory = new factoryDAO("db");
$factory->setTable("tbl_clientcategoria");

$datos = $factory->getAllDataByPk($id);

$factory->cerrar();

?>
