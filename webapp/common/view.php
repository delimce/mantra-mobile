<?php 

////NO CAMBIAR
include($_SERVER['DOCUMENT_ROOT']."/".$dirApp."common/controller.php"); //seguridad

$tituloPage = $tituloCurrent; 
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $tituloPage ?></title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="stylesheet" href="/<?php echo $dirApp ?>css/jquery.mobile-1.0.1.css" />
	<script src="/<?php echo $dirApp ?>jquery/jquery-1.6.4.min.js"></script>
	<script src="/<?php echo $dirApp ?>jquery/jquery.mobile-1.0.1.min.js"></script>
        <script src="/<?php echo $dirApp ?>jquery/jPrintArea.js"></script>
        <script type="text/javascript" src="/<?php echo $dirApp ?>jquery/jquery.validate.min.js"></script>

</head>