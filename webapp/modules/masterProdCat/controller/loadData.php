<?php 
$tool2 = new Formulario();

$id = $tool2->getvar("id",$_GET);

$tool = new FactoryDAO("db");
$tool->setTable("tbl_prodcategoria");

if(!empty($id))
$datos = $tool->getAllDataByPk ($id);

$tool->cerrar();


///////para el cargo en productos

$tipoLabel = $tool2->llenar_array(LANG_prodCatExtraLabel);
$tipovalues = $tool2->llenar_array("N/A,recargo,descuento");

$seleccionado = $datos['tipo_cargo'];

?>
