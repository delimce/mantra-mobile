<?php 
$tool = new formulario("db");

$id = $tool->getvar("id",$_GET);

//////en caso de recarga de pagina
if(empty($id))$tool->redirect ('index.php');


        $producto = $tool->simple_db("select descripcion from tbl_producto where id = $id and cuenta_id = {$_SESSION['CUENTAID']} ");
        $tool->query("SELECT 
                            date(i.fecha) as fecha,
                            i.accion,
                            i.operacion,
                            i.cantidad,
                            i.ref_pedido
                            FROM
                            tbl_inventario i
                            where i.cuenta_id = {$_SESSION['CUENTAID']} and i.producto_id = $id 
                            order by fecha ");

$total = 0;

?>
