<?php session_start();

$profile = "admin,vendor";
include("../../../config/siteconfig.php");

$tool = new factoryDAO("db");

$codigo = formulario::getvar("codigo", $_POST);

$id = formulario::getvar("id", $_POST);

////en caso de que no venga id
if(empty($id)) $id = false;

$tool->setTable("tbl_producto");

if($tool->isCodigoExist($codigo,$id))
    echo 1;
else 
    echo 0;

$tool->cerrar();


?>

