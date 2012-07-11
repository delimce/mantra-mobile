<?php session_start();
$profile = "vendor";
include("../../../config/siteconfig.php");

$traer = new Formulario();

 $_SESSION['PEDIDO_CLIENTEID'] = $traer->getvar("id", $_POST);

require_once("resetOrder.php");


?>
