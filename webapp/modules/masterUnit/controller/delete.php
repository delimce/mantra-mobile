<?php session_start();

$profile = "admin";
include("../../../config/siteconfig.php");

$tool = new formulario();


$id = $tool->getvar("id", $_POST);


$factory = new factoryDAO('db');
$factory->setTable("tbl_unidad");

$factory->setBorrado($id);

$factory->cerrar();

?>
