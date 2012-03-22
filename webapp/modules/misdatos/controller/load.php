<?php 
$tool = new tools("db");

$datos = $tool->simple_db("select * from tbl_admin where id = {$_SESSION['USERID']}");

$tool->cerrar();

?>
