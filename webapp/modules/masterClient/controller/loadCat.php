<?php

$queryc = "select nombre,id from tbl_clientcategoria where cuenta_id = $cuenta and borrado = 0 and activa = 1";

/////busqueda de las categorias del producto

    $cliCategoria = $tool->simple_db("SELECT 
                                        pc.categoria_id
                                        FROM
                                        tbl_cliente_categoria pc
                                        WHERE
                                        pc.cliente_id = '$id' AND 
                                        pc.cuenta_id = $cuenta  ");


////


$porDefectoc = false;
$seleccionadoc = $cliCategoria; ////para seleccionar la categoria
$desactivadoc = false;
    

?>
