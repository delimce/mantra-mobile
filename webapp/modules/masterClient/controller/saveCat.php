<?php

///guardar las categorias del producto

/////caso de categoria unica.
$catego = $tool->getvar("categoriac",$_POST);
$tool->query("delete from tbl_cliente_categoria where cliente_id = $id and cuenta_id = {$_SESSION['CUENTAID']} ");
//////////
$vector[0] = $_SESSION['CUENTAID'];
$vector[1] = $id;
$vector[2] = $catego;


$tool->insertar2("tbl_cliente_categoria","cuenta_id,cliente_id,categoria_id",$vector);


?>
