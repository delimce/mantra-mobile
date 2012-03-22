<?php 
$tool = new tools("db");



$tool->query("SELECT 
                p.id,
                p.descripcion,
                SUM(CASE WHEN i.operacion = 'sum' THEN i.cantidad ELSE 0 END) - SUM(CASE WHEN i.operacion = 'res' THEN i.cantidad ELSE 0 END) AS cantidad
                FROM
                tbl_producto p
                LEFT OUTER JOIN tbl_inventario i ON (p.id = i.producto_id)
                AND (p.cuenta_id = i.cuenta_id)
                where p.cuenta_id = {$_SESSION['CUENTAID']} and p.borrado = 0
                GROUP BY p.id ");

?>
