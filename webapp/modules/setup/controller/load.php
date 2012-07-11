<?php 
$tool = new FactoryDAO("db");

/////consulta de la tabla segun el perfil
 $tool->setTable ("tbl_cuenta");
 $datos = $tool->getAllDataByPkOnlyId($_SESSION['CUENTAID']);


$tool->cerrar();

?>
