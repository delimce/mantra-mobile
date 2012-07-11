<?php 
$tool = new Tools("db");

$queryc = "select * from tbl_cliente where cuenta_id = {$_SESSION['CUENTAID']} and borrado = 0 ";


//////para q los vendedores puedan visualizarlos
if($_SESSION['PROFILE']!="admin"){
    
    $queryc.=" and activo = 1 and vendedor_id in (0,{$_SESSION['USERID']})";
    $regreso = "../lobi.php";
    $link = "readOnly.php?id=";
    
}else{
    $regreso = "../lobiMaster.php";
    $link = "editar.php?id=";
    
    
}
//////ordenamiento    
 $queryc.=" order by nombre ";   

$tool->query($queryc);

?>
