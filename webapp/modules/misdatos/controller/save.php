<?php session_start();

$profile = "admin,vendor";
include("../../../config/siteconfig.php");

$tool = new formulario('db');

//////validaciones etc...

///clave
$clave1 = $tool->simple_db("select pass from tbl_admin where id = {$_SESSION['USERID']} ");
$clave2 = $tool->getvar("clave",$_POST);
if($clave1!=$clave2) $_POST['r1pass'] = md5($clave2);

//////////////////////

$tool->update_data("r","1","tbl_admin",$_POST,"id = {$_SESSION['USERID']} ");

$tool->cerrar();

echo LANG_editSuccess;

?>
