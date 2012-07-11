<?php

session_start();

$profile = "vendor";
include("../../../config/siteconfig.php");

$tool = new Tools("db");

////////crear registro de pedido
$dataPedido[0] = $_SESSION['CUENTAID'];
$dataPedido[1] = $_SESSION['USERID']; ///vendedor
$dataPedido[2] = $_SESSION['PEDIDO_CLIENTEID']; ///cliente
$dataPedido[3] = @date("Y-m-d H:i:s"); ///fecha creado

$subtotal = 0;
$totalIva = 0;

$tool->abrir_transaccion();

////traer siguiente correlativo de pedido
$dataPedido[4] = $tool->simple_db(FactoryDAO::getOrderNumber($_SESSION['CUENTAID']));

$tool->insertar2("tbl_pedido", "cuenta_id,vendedor_id,cliente_id,fecha_creado,codigo", $dataPedido);

$idPedido = $tool->getUltimoId(); ///id del pedido a insertar


$dataDetalle[0] = $dataPedido[0]; ///cuenta id
$dataDetalle[1] = $idPedido;


////productos con iva
$prodIva = $tool->array_query(FactoryDAO::getProdsIva($_SESSION['PEDIDO_PRODID'],$_SESSION['CUENTAID']));
$iva1 = $tool->simple_db(FactoryDAO::getIva($_SESSION['CUENTAID'])); ///valor del iva

foreach ($_SESSION['PEDIDO_PRODID'] as $i => $value) {
    
    $dataDetalle[2] = $_SESSION['PEDIDO_PRODID'][$i]; ///prod id
    $dataDetalle[3] = $_SESSION['PEDIDO_PRODCANT'][$i]; ///cant
    $dataDetalle[4] = $_SESSION['PEDIDO_PRODPRECIO'][$i]; ///precio
    $dataDetalle[5] = $_SESSION['PEDIDO_PRODCANT'][$i]*$_SESSION['PEDIDO_PRODPRECIO'][$i]; ///sub total
    
    $tool->insertar2("tbl_pedido_detalle", "cuenta_id,pedido_id,producto_id,cantidad,precio,subtotal", $dataDetalle);
    
   
    /////subtotal sin Iva
    $subtotal+=$dataDetalle[5];
    
    /////calculo de iva
    if(in_array($_SESSION['PEDIDO_PRODID'][$i], $prodIva)){
        
        $totalIva+= $dataDetalle[5];
    }
    
    
    
    ////////descuento en inventario
    $dataStock[0] = $dataPedido[0]; ///cuenta_id
    $dataStock[1] = $dataDetalle[2]; ///prod_id
    $dataStock[2] = $dataPedido[3]; //fecha pedido
    $dataStock[3] = "venta"; //accion
    $dataStock[4] = "res"; //operacion
    $dataStock[5] = $dataDetalle[3]; //cantidad
    $dataStock[6] = $idPedido; ///ref pedido
    $tool->insertar2("tbl_inventario", "cuenta_id,producto_id,fecha,accion,operacion,cantidad,ref_pedido", $dataStock);
 
    ///////////////////
    
}

    $campos[0] = "subtotal"; $vector[0] = $subtotal;
    $campos[1] = "subtotaliva"; $vector[1] = $totalIva*($iva1/100);
    $campos[2] = "total"; $vector[2] = $subtotal+$vector[1];
    /////////actualizar totales de pedido
    $tool->update("tbl_pedido", $campos, $vector, "id = $idPedido and cuenta_id = $dataPedido[0]");


$tool->cerrar_transaccion();

include("resetOrder.php"); ///resetiando los datos temporales del pedido
unset($_SESSION['PEDIDO_CLIENTEID']); ///limpiando la variable de cliente

$tool->cerrar();


echo $idPedido;

?>
