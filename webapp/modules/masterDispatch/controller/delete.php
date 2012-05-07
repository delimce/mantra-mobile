<?php session_start();

$profile = "admin";
include("../../../config/siteconfig.php");

$tool = new factoryDAO('db');
$tool->setTable("tbl_despachador");

$id = formulario::getvar("id", $_POST);


$tool->setBorradoPurgado($id); ////borra


$tool->cerrar();

?>
