<?php session_start();

$profile = "admin";
include("../../../config/siteconfig.php");

$tool = new Formulario('db');

//////validaciones etc...

$_POST['r9cuenta_id'] = $_SESSION['CUENTAID'];
//////////////////////

$tool->insert_data("r","9","tbl_unidad",$_POST);

$tool->cerrar();

echo 1;

?>
