<?php 
$tool = new formulario("db");

$id = $tool->getvar("id",$_GET);

$datos = $tool->simple_db("select * from tbl_clientcategoria where cuenta_id = {$_SESSION['CUENTAID']} and id = $id ");

$tool->cerrar();

?>
