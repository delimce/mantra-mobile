<?php 
$tool = new tools("db");

$tool->query("select * from tbl_unidad where cuenta_id = {$_SESSION['CUENTAID']} and borrado = 0 order by titulo ");

?>
