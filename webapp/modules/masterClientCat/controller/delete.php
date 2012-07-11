<?php session_start();

$profile = "admin";
include("../../../config/siteconfig.php");

$tool = new Formulario();


$id = $tool->getvar("id", $_POST);


$factory = new FactoryDAO('db');
$factory->setTable("tbl_clientcategoria");

$factory->setBorrado($id);

$factory->cerrar();

?>
