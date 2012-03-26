<?php session_start();

$profile = "admin";
include("../../../config/siteconfig.php");

$tool = new formulario('db');

//////validaciones etc...

$cuenta = $_SESSION['CUENTAID'];
$id = $tool->getvar("id", $_POST);

$tool->abrir_transaccion();
    $tool->update_data("r","9","tbl_producto",$_POST,"id = $id  and cuenta_id = $cuenta ");

    if(!isset($_POST['r9activo']))
        $tool->query("update tbl_producto set activo = 0 where id = $id  and cuenta_id = $cuenta ");
    
    if(!isset($_POST['r9paga_impuesto']))
        $tool->query("update tbl_producto set paga_impuesto = 0 where id = $id  and cuenta_id = $cuenta ");

    
    require_once("saveCat.php");
    
    
$tool->cerrar_transaccion();

$tool->cerrar();

echo LANG_editSuccess;

?>
