<?php

$cuenta = $_SESSION['CUENTAID'];

$tool = new formulario("db");

$queryu = "select titulo,id from tbl_unidad where cuenta_id = $cuenta and borrado = 0";

$porDefecto = false;
$seleccionado = $datos['unidad_med'];
$desactivado = false;
    


?>
