<?php
    
    $tool = new factoryDAO("db");
    
    $moneda = $tool->getMoneda();
    
    
    
    
    $tool->getOrderSales(); //ventas por vendedores
        
    //opteniendo el total
    while ($row2 = $tool->db_vector_nom($tool->result)) {
        echo $total+= $row2["total"];
    }

    
    ///devolviendo el puntero
    $tool->setPointerResult(0);
?>