<?php session_start();

$profile = "admin,vendor";
include("../../../config/siteconfig.php");

$tool = new formulario('db');

//////en caso de que cree el cliente el vendor
if($_SESSION['PROFILE']=="vendor") $_POST['r9vendedor_id'] = $_SESSION['USERID'];
////////////////

$tool->abrir_transaccion();

$_POST['r9cuenta_id'] = $_SESSION['CUENTAID'];
$_POST['r9fecha_creado'] = @date("Y-m-d H:i:s");
$tool->insert_data("r","9","tbl_cliente",$_POST);


$id = $tool->getUltimoId(); ////para insertar las categorias

require_once("saveCat.php");


$tool->cerrar_transaccion();

$tool->cerrar();

echo 1;

?>
