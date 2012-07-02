<?php

/**
 *Uso de la variable que define el nombre del directorio de la aplicacion, desde la raiz del webserver
 */
$dirApp = "mantraweb/"; //MUY IMPORTANTE!!! SE SETEA CON EL NOMBRE DEL DIRECTORIO DE LA APP (comentar en caso de que sea la raiz del servidor)
$lang = "castellano.php"; //archivo del lenguaje a usar /config/lang/

/** NO CAMBIAR**/
if (basename(dirname($_SERVER['PHP_SELF'])) == "controller") {

    return include_once ($_SERVER['DOCUMENT_ROOT'] . "/" . $dirApp . "common/controller.php"); //controller;
} else {

    return include_once ($_SERVER['DOCUMENT_ROOT'] . "/" . $dirApp . "common/view.php"); //view;
}


?>
