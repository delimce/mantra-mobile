<?php session_start();

$profile = "admin";
include("../../../config/siteconfig.php");

$tool = new FactoryDAO('db');
$tool->setTable("tbl_despachador");

$id = Formulario::getvar("id", $_POST);


$tool->setBorradoPurgado($id); ////borra


$tool->cerrar();

?>
