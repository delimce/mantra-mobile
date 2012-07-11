<?php


$id = Formulario::getvar("id");
$tool = new FactoryDAO("db");

$cabecera = $tool->getDataOrder($id);

$moneda = $tool->getMoneda();

$tool->getDataOrderDetail($id);


?>
