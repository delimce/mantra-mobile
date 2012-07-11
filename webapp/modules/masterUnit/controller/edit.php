<?php session_start();

$profile = "admin";
include("../../../config/siteconfig.php");

$tool = new Formulario('db');

//////validaciones etc...


$cuenta = $_SESSION['CUENTAID'];
$id = $tool->getvar("id", $_POST);

    $tool->update_data("r","9","tbl_unidad",$_POST,"id = $id  and cuenta_id = $cuenta ");


$tool->cerrar();

echo LANG_editSuccess;

?>
