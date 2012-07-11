<?php

session_start();

$profile = "admin";
include("../../../config/siteconfig.php");

$id = Formulario::getvar("id", $_POST);

$tool = new FactoryDAO("db");

$tool->setTable("tbl_pedido");

$tool->setBorrado($id);

$tool->cerrar();

?>
