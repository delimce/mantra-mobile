<?php

session_start();

$profile = "admin";
include("../../../config/siteconfig.php");

$id = formulario::getvar("id", $_POST);

$tool = new factoryDAO("db");

$tool->setTable("tbl_pedido");

$tool->setBorrado($id);

$tool->cerrar();

?>
