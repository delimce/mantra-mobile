<?php session_start();

$profile = "admin";
include("../../../config/siteconfig.php");

$tool = new Formulario('db');

//////validaciones etc...

///clave
$clave2 = $tool->getvar("clave",$_POST);
$_POST['r9cuenta_id'] = $_SESSION['CUENTAID'];
$_POST['r9pass'] = md5($clave2);
$_POST['r9fecha_creado'] = @date("Y-m-d H:i:s");
//////////////////////

$tool->insert_data("r","9","tbl_vendedor",$_POST);

$tool->cerrar();

echo 1;

?>
