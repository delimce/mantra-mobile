<?php

$tool = new tools("db");
$cuenta = $_SESSION['CUENTAID'];


$queryv = "select nombre,id from tbl_vendedor where cuenta_id = $cuenta and activo = 1 and borrado = 0";

if($_SESSION['PROFILE']=="admin"){
$porDefecto = LANG_all;
$seleccionado = $datos['vendedor_id'];
$desactivado = false;
}else{
$porDefecto = LANG_all;
$seleccionado = $_SESSION['USERID'];
$desactivado = true;
    
}

?>
