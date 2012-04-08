<?php

$queryc = "select nombre,id from tbl_prodcategoria where cuenta_id = $cuenta and borrado = 0 and activo = 1";

/////busqueda de las categorias del producto

    $prodCategoria = $tool->simple_db("SELECT 
                                        pc.categoria_id
                                        FROM
                                        tbl_producto_categoria pc
                                        WHERE
                                        pc.producto_id = '$id' AND 
                                        pc.cuenta_id = $cuenta  ");


////


$porDefectoc = false;
$seleccionadoc = $prodCategoria; ////para seleccionar la categoria
$desactivadoc = false;
    


?>
