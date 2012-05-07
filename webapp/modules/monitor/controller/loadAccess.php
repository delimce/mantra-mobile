<?php
    
    $iduser = formulario::getvar("id");
    $perfil = formulario::getvar("perfil");
    $tool = new factoryDAO("db");
    
    $nombre = $tool->getNamebyProfile($iduser, $perfil); //nombre del sujeto
        
    $tool->getDataVisitor($iduser, $perfil);


?>
