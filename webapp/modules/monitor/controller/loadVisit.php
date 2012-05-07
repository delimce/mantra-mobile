<?php 
$tool = new factoryDAO("db");
$tool->getAllVistByAcount();

//opteniendo el total
while ($row2 = $tool->db_vector_nom($tool->result)) {
    echo $total+= $row2["total"];
}

///devolviendo el puntero
$tool->setPointerResult(0);

    function mostrarPerfil($perfil){
        
        switch ($perfil) {
            case "admin":
               $result = LANG_admin;
               break;

           case "vendor":
               $result = LANG_vendor;
               break;
           
            default:
                $result = LANG_dispatch;
                break;
        }
        
        echo $result;
        
    }

?>
