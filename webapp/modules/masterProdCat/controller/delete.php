<?php session_start();

$profile = "admin";
include("../../../config/siteconfig.php");

$id = formulario::getvar("id", $_POST);

$factory = new factoryDAO('db');
$factory->setTable("tbl_prodcategoria");

$factory->setBorrado($id);

$factory->cerrar();

?>