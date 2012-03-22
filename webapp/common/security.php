<?php

///la variable $profile debe llamarse igual a la carpeta del entorno de usuario (admin,vendor)

if(!empty($profile)){
    
    if($_SESSION['PROFILE'] != $profile){
        
        session_destroy();
        header("location: /$dirApp/index.php");
        
    }
    
}

?>
