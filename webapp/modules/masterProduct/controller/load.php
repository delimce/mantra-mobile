<?php 
$tool = new factoryDAO("db");
$tool->setTable("tbl_producto");
$tool->getAllDataProd();


//////para q los vendedores puedan visualizarlos
if($_SESSION['PROFILE']!="admin"){
    
    $regreso = "../lobi.php";
    $link = "readOnly.php?id=";
    
}else{
    $regreso = "../lobiMaster.php";
    $link = "editar.php?id=";
    
    
}



?>
