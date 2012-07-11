<?php session_start();

$profile = "admin";
include("../../../config/siteconfig.php");

$tool = new FactoryDAO('db');
//////validaciones etc...
 $tool->setTable ("tbl_cuenta");
$tool->saveDataOnlyId($_SESSION['CUENTAID']);

$tool->cerrar();

echo LANG_editSuccess;

?>
