<?php session_start();
$profile = "vendor";
include("../../../config/siteconfig.php");

$traer = new formulario();

 $_SESSION['PEDIDO_CLIENTEID'] = $traer->getvar("id", $_POST);

    

?>