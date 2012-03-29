<?php session_start();


//////////guardar el cierre de sesion

include("../../config/siteconfig.php");

$tools = new tools('db');

$id = $_SESSION['SESIONID'];
$cuenta_id = $_SESSION['CUENTAID'];
$tools->query("update tbl_acceso set sesion = 'Finalizada' where id = $id and cuenta_id = $cuenta_id ");

$tools->cerrar();

///////////////



 session_destroy();

header("location: ../../index.php");

?>