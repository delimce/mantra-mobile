<?php 
$tool = new tools("db");

        $tool->query("SELECT 
                        cat.id,
                        cat.nombre,
                        cat.descripcion,
                        count(cliente_id) as cant
                        FROM
                        tbl_clientcategoria cat
                        left JOIN tbl_cliente_categoria ON (cat.id = tbl_cliente_categoria.categoria_id)
                        AND (cat.cuenta_id = tbl_cliente_categoria.cuenta_id)
                        WHERE
                        cat.borrado = 0 and cat.cuenta_id = {$_SESSION['CUENTAID']}
                        GROUP BY
                        cat.id
                        ORDER BY
                        cat.nombre");

?>
