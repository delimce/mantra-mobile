<?php 
$tool = new formulario("db");

$id = $tool->getvar("id",$_GET);

//////en caso de recarga de pagina
if(empty($id))$tool->redirect ('index.php');


        
        $producto = $tool->simple_db("SELECT 
                                        p.descripcion,
                                        u.titulo as unidad
                                        FROM
                                        tbl_producto p
                                        INNER JOIN tbl_unidad u ON (p.unidad_med = u.id)
                                        AND (p.cuenta_id = u.cuenta_id)
                                        WHERE
                                        p.id = $id AND 
                                        p.cuenta_id = {$_SESSION['CUENTAID']}");
  
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
