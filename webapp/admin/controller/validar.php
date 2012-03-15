<?php session_start();

include("../../config/siteconfig.php");

$tools = new formulario('db');

$usuario = $tools->getvar("user",$_POST);
$clave = $tools->getvar("clave",$_POST);
$data = $tools->simple_db("select id,nombre,user from tbl_admin where user = '$usuario' and pass = md5('$clave') ");


if($tools->getNreg()>0){
    $_SESSION['PROFILE'] = "admin"; ///perfil requerido
    $_SESSION['USERID'] = $data["id"];
    $_SESSION['USERNAME'] = $data["nombre"];
}else{
    $_SESSION['PROFILE'] = "";
}
    


$is_login = ($_SESSION['PROFILE'] == "admin" ? 1 : 0);
    
echo $is_login;


$tools->cerrar();

?>
