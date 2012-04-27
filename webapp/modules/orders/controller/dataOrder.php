<?php

$traer = new formulario();

$id = $traer->getvar("id");
$tool = new factoryDAO("db");

$cabecera = $tool->getDataOrder($id);

$moneda = $tool->getMoneda();

$tool->getDataOrderDetail($id);


?>
