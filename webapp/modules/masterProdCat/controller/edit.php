<?php session_start();

$profile = "admin";
include("../../../config/siteconfig.php");


//////validaciones etc...

$id = formulario::getvar("id", $_POST);

    
$tool = new factoryDAO("db");
    
$tool->abrir_transaccion();
    $tool->setTable("tbl_prodcategoria");
    $tool->saveData($id);
    if(!isset($_POST['r9activo'])) $tool->setActivo($id,false);
$tool->cerrar_transaccion();
    

$tool->cerrar();

echo LANG_editSuccess;

?>
