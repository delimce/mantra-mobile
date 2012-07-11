<?php session_start();

$profile = "admin";
include("../../../config/siteconfig.php");

$tool = new FactoryDAO('db');
$tool->setTable("tbl_vendedor");

$id = Formulario::getvar("id", $_POST);


$tool->setBorradoPurgado($id); ////borra

$tool->cerrar();

?>
