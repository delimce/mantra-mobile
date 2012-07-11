<?php

session_start();

$profile = "dispatch";
include("../../../config/siteconfig.php");


$id = Formulario::getvar("id", $_POST);

$tool = new FactoryDAO("db");

$tool->processOrder($id,$_SESSION['USERID']);

$tool->cerrar();

?>
