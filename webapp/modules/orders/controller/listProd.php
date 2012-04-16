<?php

session_start();

$profile = "vendor";
include("../../../config/siteconfig.php");

$traer = new formulario();

$catid = $traer->getvar("id", $_POST);

if ($catid > 0) {
    $tool = new factoryDAO("db");
    $lista = $tool->getComboProdByCatId($catid);
    $tool->cerrar();
    echo $lista;
} else {

    echo LANG_SelectCatProd;
}
?>
