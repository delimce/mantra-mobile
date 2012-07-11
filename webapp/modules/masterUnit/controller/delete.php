<?php session_start();

$profile = "admin";
include("../../../config/siteconfig.php");

$id = Formulario::getvar("id", $_POST);


$factory = new FactoryDAO('db');
$factory->setTable("tbl_unidad");

$factory->setBorrado($id);

$factory->cerrar();

?>
