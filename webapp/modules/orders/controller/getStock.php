<?php

session_start();

$profile = "vendor";
include("../../../config/siteconfig.php");


$prod = Formulario::getvar("id", $_POST);

if ($prod > 0) {
    $tool = new FactoryDAO("db");
    $lista = $tool->getProdStock($prod);
    $tool->cerrar();
    echo '<label style="font-weight:bold" class="select">'.LANG_stockActual.'</label>&nbsp;';
    echo $lista;
} 

?>
