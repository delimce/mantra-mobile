<?php session_start();

$profile = "admin,dispatch";
include("../../../config/siteconfig.php");

$tool = new Formulario("db");

$id = $tool->getvar("id", $_POST);
echo $tool->simple_db(FactoryDAO::getMontocatProd($id,$_SESSION['CUENTAID']));

$tool->cerrar();


?>
