<?php 
$tool = new tools("db");


/////consulta de la tabla segun el perfil
if($_SESSION['PROFILE']=="admin")
    $tabla = "tbl_admin";
else
    $tabla = "tbl_vendedor";

$datos = $tool->simple_db("select * from $tabla where id = {$_SESSION['USERID']}");

$tool->cerrar();

?>
