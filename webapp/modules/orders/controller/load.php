<?php 
$tool = new FactoryDAO("db");


/////traer moneda
$moneda = $tool->getMoneda();

if($_SESSION['PROFILE']=="vendor")

    $tool->getAllDataOrder($_SESSION['USERID']);
else if ($_SESSION['PROFILE']=="dispatch")
    
    $tool->getDataOrderDispath ();
    
else    
    $tool->getAllDataOrder();

?>
