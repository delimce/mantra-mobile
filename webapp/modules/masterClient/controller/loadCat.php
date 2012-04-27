<?php

$queryc = factoryDAO::comboClientCat($cuenta);

/////busqueda de las categorias del producto

$cliCategoria = $tool->simple_db(factoryDAO::getIdCatCli($cuenta));
        
////

$porDefectoc = false;
$seleccionadoc = $cliCategoria; ////para seleccionar la categoria
$desactivadoc = false;
    

////cargar tipo de cargo

$tipoLabel = formulario::llenar_array(LANG_prodCatExtraLabel);
$tipovalues = formulario::llenar_array("N/A,recargo,descuento");
$seleccionadoP = $datos['tipo_cargo'];

?>
