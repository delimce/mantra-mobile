<?php

    $idvendor = Formulario::getvar("id",$_GET);

    $tool = new FactoryDAO("db");

    $vendedor = strtolower($tool->getNamebyProfile($idvendor,"vendor"));


    ///trayendo las ordenes por vendedor
    $tool->getOrdersByVendor($idvendor);

?>