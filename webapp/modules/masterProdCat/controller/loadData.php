<?php 
$tool = new formulario("db");

$id = $tool->getvar("id",$_GET);

if(!empty($id))
$datos = $tool->simple_db("select * from tbl_prodcategoria where cuenta_id = {$_SESSION['CUENTAID']} and id = $id ");

$tool->cerrar();


///////para el cargo en productos

$tipoLabel = $tool->llenar_array(LANG_prodCatExtraLabel);
$tipovalues = $tool->llenar_array("N/A,recargo,descuento");

$seleccionado = $datos['tipo_cargo'];

?>
