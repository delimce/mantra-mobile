<?php session_start();

$profile = "admin";
include("../../../config/siteconfig.php");

$tool = new formulario('db');

//////////////actualizando el inventario con una compra del producto
$_POST['r9producto_id'] = $tool->getvar("id", $_POST);
$_POST['r9fecha'] = @date("Y-m-d H:i:s");
$_POST['r9cuenta_id'] = $_SESSION['CUENTAID'];
$_POST['r9accion'] = 'compra';
$_POST['r9operacion'] = 'sum';

$tool->insert_data("r","9","tbl_inventario",$_POST);

$tool->cerrar();


?>