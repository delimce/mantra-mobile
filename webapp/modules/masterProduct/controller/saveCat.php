<?php

///guardar las categorias del producto

/////caso de categoria unica.
$catego = $tool->getvar("categoriap",$_POST);
$tool->query("delete from tbl_producto_categoria where producto_id = $id and cuenta_id = {$_SESSION['CUENTAID']} ");
//////////
$vector[0] = $_SESSION['CUENTAID'];
$vector[1] = $id;
$vector[2] = $catego;


$tool->insertar2("tbl_producto_categoria","cuenta_id,producto_id,categoria_id",$vector);


?>
