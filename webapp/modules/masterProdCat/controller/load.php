<?php 
$tool = new tools("db");

        $tool->query("SELECT 
                            cat.id,
                            cat.nombre,
                            cat.descripcion,
                            count(pc.producto_id) as cant
                            FROM
                            tbl_prodcategoria cat
                            LEFT JOIN tbl_producto_categoria pc ON (cat.id = pc.categoria_id)
                            AND (cat.cuenta_id = pc.cuenta_id)
                            WHERE
                            pc.cuenta_id = {$_SESSION['CUENTAID']} and borrado = 0
                            GROUP BY cat.id order by cat.nombre ");

?>
