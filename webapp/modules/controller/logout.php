<?php session_start();


//////////guardar el cierre de sesion

include("../../config/siteconfig.php");

$tools = new FactoryDAO('db');

$id = $_SESSION['SESIONID'];

if(!empty($id))
$tools->setFinSesion($id);

$tools->cerrar();

///////////////

 session_destroy();

header("location: ../../index.php");

?>