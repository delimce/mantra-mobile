<?php 

$dirApp = "mantraweb"; //MUY IMPORTANTE!!! SE SETEA CON EL NOMBRE DEL DIRECTORIO DE LA APP


////NO CAMBIAR
require_once($_SERVER['DOCUMENT_ROOT']."/$dirApp/common/security.php"); //seguridad
require_once($_SERVER['DOCUMENT_ROOT']."/$dirApp/config/lang/castellano.php"); //lenguaje
require_once($_SERVER['DOCUMENT_ROOT']."/$dirApp/config/dbconfig.php"); //base de datos
require_once($_SERVER['DOCUMENT_ROOT']."/$dirApp/class/clases.php"); //clases
$tituloPage = $tituloCurrent; 
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $tituloPage ?></title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="stylesheet" href="/<?php echo $dirApp ?>/css/jquery.mobile-1.0.1.css" />
	<script src="/<?php echo $dirApp ?>/jquery/jquery-1.6.4.min.js"></script>
	<script src="/<?php echo $dirApp ?>/jquery/jquery.mobile-1.0.1.min.js"></script>
</head>