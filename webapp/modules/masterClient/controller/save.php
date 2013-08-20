<?php session_start();

$profile = "admin,vendor";
include("../../../config/siteconfig.php");

$tool2 = new Formulario();

//////en caso de que cree el cliente el vendor
if($_SESSION['PROFILE']=="vendor") $_POST['r9vendedor_id'] = $_SESSION['USERID'];
////////////////

$tool = new FactoryDAO("db");
$tool->setTable("tbl_cliente");

$tool->abrir_transaccion();

$_POST['r9cuenta_id'] = $_SESSION['CUENTAID'];
$_POST['r9fecha_creado'] = $tool->getCurrentDate();

$tool->addData();

echo $id = $tool->getUltimoId(); ////para insertar las categorias

require_once("saveCat.php");


$tool->cerrar_transaccion();

$tool->cerrar();

echo 1;

?>
