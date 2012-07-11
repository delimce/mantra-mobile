<?php

$tool = new Tools("db");
$cuenta = $_SESSION['CUENTAID'];


$queryv = FactoryDAO::comboVendors($cuenta);

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
