<?php

$queryc = FactoryDAO::comboClientCat($cuenta);

/////busqueda de las categorias del producto

$cliCategoria = $tool->simple_db(FactoryDAO::getIdCatCli($cuenta));
        
////

$porDefectoc = false;
$seleccionadoc = $cliCategoria; ////para seleccionar la categoria
$desactivadoc = false;
    

////cargar tipo de cargo

$tipoLabel = Formulario::llenar_array(LANG_prodCatExtraLabel);
$tipovalues = Formulario::llenar_array("N/A,recargo,descuento");
$seleccionadoP = $datos['tipo_cargo'];

?>
