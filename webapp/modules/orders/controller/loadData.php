<?php

$tool = new tools("db");
$cuenta = $_SESSION['CUENTAID'];


    $queryc = "select nombre,id from tbl_cliente where cuenta_id = $cuenta and activo = 1 and borrado = 0 and vendedor_id in (0,{$_SESSION['USERID']})";

    if($_SESSION['PROFILE']=="admin"){
    $porDefecto = LANG_all;
    $seleccionado = $datos['vendedor_id'];
    $desactivado = false;
    }else{
    $porDefecto = LANG_select;
    $seleccionado = 0;
    $desactivado = false;

    }
    
    
    $querycp = "select nombre,id from tbl_prodcategoria where cuenta_id = $cuenta and activa = 1 and borrado = 0 order by nombre";

    
    $porDefecto2 = LANG_select;
    $seleccionado2 = 0;
    $desactivado2 = false;

    
    
    
    
    

?>
