<?php

///la variable $profile debe llamarse igual a la carpeta del entorno de usuario (admin,vendor)

if(!empty($profile)){
    
    ////vector con el o los modulos requeridos
    $perfilAcceso = explode(",",$profile);
        
    if(!in_array($_SESSION['PROFILE'], $perfilAcceso)){
        
        session_destroy();
        
        header("location: /$dirApp/index.php");
        die();
    }
    
}

?>
