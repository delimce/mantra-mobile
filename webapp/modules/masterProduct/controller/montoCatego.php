<?php session_start();

$profile = "admin";
include("../../../config/siteconfig.php");

$tool = new formulario("db");

$id = $tool->getvar("id", $_POST);
echo $tool->simple_db(factoryDAO::getMontocatProd($id,$_SESSION['CUENTAID']));

$tool->cerrar();


?>
