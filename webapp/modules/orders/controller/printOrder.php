<?php


    if(isset($_SESSION['PEDIDO_PRODID'])){
        foreach ($_SESSION['PEDIDO_PRODID'] as $i => $value) {


            echo '<li>
            <b>Producto:</b> <span style="color:blue">'.$_SESSION['PEDIDO_PRODNOMBRE'][$i].'</span>
            <fieldset style="font-size: 12px">
            <b>cantidad:</b> '.$_SESSION['PEDIDO_PRODCANT'][$i].' <b>Precio</b> Bs '.$_SESSION['PEDIDO_PRODPRECIO'][$i].'                                         
            </fieldset>
            </li>';

        }
    }

?>
