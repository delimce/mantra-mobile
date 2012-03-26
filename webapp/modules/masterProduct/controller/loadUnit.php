<?php

$tool = new tools("db");
$cuenta = $_SESSION['CUENTAID'];


$queryu = "select titulo,id from tbl_unidad where cuenta_id = $cuenta and borrado = 0";

$porDefecto = false;
$seleccionado = $datos['unidad_med'];
$desactivado = false;
    


?>
