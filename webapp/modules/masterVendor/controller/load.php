<?php 
$tool = new Tools("db");

$tool->query("select * from tbl_vendedor where cuenta_id = {$_SESSION['CUENTAID']} and borrado = 0 order by nombre ");

?>
