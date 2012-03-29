<?php session_start();

$profile = "admin,vendor";
include("../../../config/siteconfig.php");

$tool = new formulario('db');

//////validaciones etc...
/////edicion de la tabla segun el perfil
if($_SESSION['PROFILE']=="admin")
    $tabla = "tbl_admin";
else
    $tabla = "tbl_vendedor";

///clave
$clave1 = $tool->simple_db("select pass from $tabla where id = {$_SESSION['USERID']} ");
$clave2 = $tool->getvar("clave",$_POST);
if($clave1!=$clave2) $_POST['r1pass'] = md5($clave2);

////cambiando nombre en variable de sesion
$_SESSION['USERNAME'] = $_POST['r1nombre'];

//////////////////////

$tool->update_data("r","1",$tabla,$_POST,"id = {$_SESSION['USERID']} ");

$tool->cerrar();

echo LANG_editSuccess;

?>
