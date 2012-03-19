<?php session_start();

$profile = "admin";
include("../../../config/siteconfig.php");

$tool = new formulario('db');

$cuenta = $_SESSION['CUENTAID'];
$id = $tool->getvar("id", $_POST);

$tool->query("update tbl_cliente set borrado = 1, fecha_borrado = NOW() where id = $id and cuenta_id = $cuenta ");

$tool->cerrar();

?>
