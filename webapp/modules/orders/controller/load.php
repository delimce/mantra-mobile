<?php 
$tool = new factoryDAO("db");


/////traer moneda
$moneda = $tool->getMoneda();

if($_SESSION['PROFILE']=="vendor")

    $tool->getAllDataOrder($_SESSION['USERID']);
else
    $tool->getAllDataOrder();

?>
