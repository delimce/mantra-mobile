<?php

$tool = new tools("db");
$cuenta = $_SESSION['CUENTAID'];


    $queryc = factoryDAO::getComboClientByVendor($cuenta,$_SESSION['USERID']);
    if($_SESSION['PROFILE']=="admin"){
    $porDefecto = LANG_all;
    $seleccionado = $datos['vendedor_id'];
    $desactivado = false;
    }else{
    $porDefecto = LANG_select;
    $seleccionado = $_SESSION['PEDIDO_CLIENTEID'];
    $desactivado = false;

    }
    
    
    $querycp = factoryDAO::getComboCatProd($cuenta);

    
    $porDefecto2 = LANG_select;
    $seleccionado2 = 0;
    $desactivado2 = false;

    
    
    
    
    

?>
