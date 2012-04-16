<?php 
$tool = new factoryDAO("db");

if($_SESSION['PROFILE']=="vendor")

    $tool->getAllDataOrder($_SESSION['USERID']);
else
    $tool->getAllDataOrder();

?>
