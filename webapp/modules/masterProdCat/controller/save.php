<?php session_start();

$profile = "admin";
include("../../../config/siteconfig.php");

$tool = new Formulario('db');

//////validaciones etc...

$_POST['r9cuenta_id'] = $_SESSION['CUENTAID'];
$_POST['r9fecha_creado'] = @date("Y-m-d H:i:s");
$tool->insert_data("r","9","tbl_prodcategoria",$_POST);

$tool->cerrar();

echo 1;

?>
