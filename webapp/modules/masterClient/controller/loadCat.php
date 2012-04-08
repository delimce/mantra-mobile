<?php

$queryc = factoryDAO::comboClientCat($cuenta);

/////busqueda de las categorias del producto

$cliCategoria = $tool->simple_db(factoryDAO::getIdCatCli($cuenta));
        
////


$porDefectoc = false;
$seleccionadoc = $cliCategoria; ////para seleccionar la categoria
$desactivadoc = false;
    

?>
