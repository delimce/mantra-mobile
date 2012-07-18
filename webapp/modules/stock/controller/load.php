<?php
$tool = new FactoryDAO("db");


///filtro por categoria
$tool->setTable("tbl_inventario");
$selectedStock = $tool->getDataFilter();

////combo de categorias
$querycat = $tool->getComboCatProd2($selectedStock);


$tool->getInventario($selectedStock);

?>
