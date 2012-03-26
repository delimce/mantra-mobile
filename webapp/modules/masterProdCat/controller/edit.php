<?php session_start();

$profile = "admin";
include("../../../config/siteconfig.php");

$tool = new formulario('db');

//////validaciones etc...


$cuenta = $_SESSION['CUENTAID'];
$id = $tool->getvar("id", $_POST);

    
    $tool->abrir_transaccion();
    $tool->update_data("r","9","tbl_prodcategoria",$_POST,"id = $id  and cuenta_id = $cuenta ");

    if(!isset($_POST['r9activa']))
        $tool->query("update tbl_prodcategoria set activa = 0 where id = $id  and cuenta_id = $cuenta ");

$tool->cerrar_transaccion();
    

$tool->cerrar();

echo LANG_editSuccess;

?>
