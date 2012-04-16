<?php

$traer = new formulario();

$id = $traer->getvar("id");
$tool = new factoryDAO("db");

$cabecera = $tool->getDataOrder($id);

$tool->getDataOrderDetail($id);


?>
