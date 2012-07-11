<?php 
$tool = new FactoryDAO("db");

/////consulta de la tabla segun el perfil
if ($_SESSION['PROFILE'] == "admin") {

    $datos = $tool->getAllDataAdminByPk($_SESSION['USERID']);
} else if ($_SESSION['PROFILE'] == "vendor") {
    $tool->setTable("tbl_vendedor");
    $datos = $tool->getAllDataByPk($_SESSION['USERID']);
} else {
    $tool->setTable("tbl_despachador");
    $datos = $tool->getAllDataByPk($_SESSION['USERID']);
}


$tool->cerrar();

?>
