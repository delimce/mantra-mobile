<?php

$tool = new tools("db");
$cuenta = $_SESSION['CUENTAID'];


$queryv = factoryDAO::comboVendors($cuenta);

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
