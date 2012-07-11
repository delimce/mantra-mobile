<?php

session_start();

$profile = "admin";
include("../../../config/siteconfig.php");

$tool = new FactoryDAO("db");

$traer = new Formulario();

$id = $traer->getvar("id",$_POST);
$motivo = $traer->getvar("motivo",$_POST);

$tool->cancelOrder($id,$motivo);

$tool->cerrar();


echo LANG_ordersCanceledText;
?>
