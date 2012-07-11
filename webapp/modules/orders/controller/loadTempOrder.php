<?php 

/////validar no poder ver el temp si no existen items creados 
//if(!isset($_SESSION['PEDIDO_PRODID']) || empty($_SESSION['PEDIDO_PRODID'])){
//    
//    header("location: crear.php");
//    
//}

///////////

$tool = new FactoryDAO("db");
$cliente = $tool->getNameClient($_SESSION['PEDIDO_CLIENTEID']);
$vendedor = $tool->getNameVendor($_SESSION['USERID']);
$dataPref = $tool->getdataOrderPref();

///traigo la data de los productos
$tool->getOrderTempData($_SESSION['PEDIDO_PRODID']);
$totalIva=0;
$totalNeto=0;

function getCantByIdProd($idProd){
    
    $pos = array_search($idProd, $_SESSION['PEDIDO_PRODID']);
    return $_SESSION['PEDIDO_PRODCANT'][$pos];
     
}


?>
