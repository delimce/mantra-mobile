<?php
session_start();

$profile = "admin";
include("../../../config/siteconfig.php");


while(list($key, $value) = each($_POST))
{

    echo $value;

}


$tool = new FactoryDAO("db");

$tool->setTable("tbl_pedido");

//$tool->setBorrado($id);

$tool->cerrar();

?>
