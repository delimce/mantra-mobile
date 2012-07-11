<?php
    
    $iduser = Formulario::getvar("id");
    $perfil = Formulario::getvar("perfil");
    $tool = new FactoryDAO("db");
    
    $nombre = $tool->getNamebyProfile($iduser, $perfil); //nombre del sujeto
        
    $tool->getDataVisitor($iduser, $perfil);


?>
