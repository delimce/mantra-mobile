<?php session_start();

$profile = "admin";
include("../../../config/siteconfig.php");

$tool = new formulario('db');

//////validaciones etc...


$cuenta = $_SESSION['CUENTAID'];
$id = $tool->getvar("id", $_POST);

$tool->abrir_transaccion();

    ///clave
    $clave1 = $tool->simple_db("select pass from tbl_despachador where id = $id and cuenta_id = $cuenta ");
    $clave2 = $tool->getvar("clave",$_POST);
    if($clave1!=$clave2) $_POST['r9pass'] = md5($clave2);



    $tool->update_data("r","9","tbl_despachador",$_POST,"id = $id  and cuenta_id = $cuenta ");

    if(!isset($_POST['r9activo']))
        $tool->query("update tbl_despachador set activo = 0 where id = $id  and cuenta_id = $cuenta ");

$tool->cerrar_transaccion();

$tool->cerrar();

echo LANG_editSuccess;

?>
