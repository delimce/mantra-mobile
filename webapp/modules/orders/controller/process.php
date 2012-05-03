<?php

session_start();

$profile = "dispatch";
include("../../../config/siteconfig.php");


$id = formulario::getvar("id", $_POST);

$tool = new factoryDAO("db");

$tool->processOrder($id,$_SESSION['USERID']);

$tool->cerrar();

?>
