<?php

///guardar las categorias del producto

/////caso de categoria unica.
$catego = $tool2->getvar("categoriac",$_POST);
$tool->setTable("tbl_cliente_categoria");

$tool->deleteData($id,"cliente_id");

//////////
$vector[0] = $_SESSION['CUENTAID'];
$vector[1] = $id;
$vector[2] = $catego;


$tool->insertar2("tbl_cliente_categoria","cuenta_id,cliente_id,categoria_id",$vector);


?>
