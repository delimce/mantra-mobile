<?php session_start();

$profile = "vendor";
include("../../../config/siteconfig.php");

$traer = new formulario();

$idProd = $traer->getvar("producto", $_POST);

////***********valido que existe el elemento para borrarlo
if(in_array($idProd, $_SESSION['PEDIDO_PRODID'])){ ////si no ha sido añadido el producto
    
    $pos = array_search($idProd, $_SESSION['PEDIDO_PRODID']);
    
   $_SESSION['PEDIDO_PRODID'] = $traer->eliminar_de($_SESSION['PEDIDO_PRODID'],$_SESSION['PEDIDO_PRODID'][$pos]);
   $_SESSION['PEDIDO_PRODNOMBRE'] = $traer->eliminar_de($_SESSION['PEDIDO_PRODNOMBRE'],$_SESSION['PEDIDO_PRODNOMBRE'][$pos]);
   $_SESSION['PEDIDO_PRODCANT'] = $traer->eliminar_de($_SESSION['PEDIDO_PRODCANT'],$_SESSION['PEDIDO_PRODCANT'][$pos]); 
   $_SESSION['PEDIDO_PRODPRECIO'] = $traer->eliminar_de($_SESSION['PEDIDO_PRODPRECIO'],$_SESSION['PEDIDO_PRODPRECIO'][$pos]);
   
}

require_once 'printOrder.php';

?>
