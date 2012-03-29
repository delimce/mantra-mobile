<?php session_start();

include("../../config/siteconfig.php");

$tools = new formulario('db');

$usuario = $tools->getvar("user",$_POST);
$clave = $tools->getvar("clave",$_POST);

$queryLogin = "(SELECT
				a.id,
				a.nombre,
				a.user,
				c.nombre as cnombre,
				c.site_titulo,
				c.banner_titulo,
				c.footer_titulo,
				c.moneda1,
				c.id as cid,
				'admin' as profile
				FROM
				tbl_admin AS a
				INNER JOIN tbl_cuenta_admin AS ca ON a.id = ca.admin_id
				INNER JOIN tbl_cuenta AS c ON ca.cuenta_id = c.id
				where a.user='$usuario' and a.pass = md5('$clave') and c.activa=1
				)
				UNION
				(SELECT
				v.id,
				v.nombre,
				v.user,
				c.nombre as cnombre,
				c.site_titulo,
				c.banner_titulo,
				c.footer_titulo,
				c.moneda1,
				c.id as cid,
				'vendor' as profile
				FROM
				tbl_vendedor AS v
				INNER JOIN tbl_cuenta AS c ON v.cuenta_id = c.id
				where v.user='$usuario' and v.pass = md5('$clave') and c.activa=1 and v.activo = 1 AND v.borrado = 0
				)";


$data = $tools->simple_db($queryLogin);


if($tools->getNreg()>0){
    
    $_SESSION['PROFILE'] = $data["profile"]; ///perfil requerido
    $_SESSION['USERID'] = $data["id"];
    $_SESSION['USERNAME'] = $data["nombre"];
    $_SESSION['CUENTAID'] = $data["cid"];
    $_SESSION['MONEDA1'] = $data["moneda1"];
    $_SESSION['CUENTA'] = $data["cnombre"];
    
    /////registro de acceso efectivo
    $vector[0] =  $_SESSION['CUENTAID'];
    $vector[1] = $_SERVER['REMOTE_ADDR'];
    $vector[2] = $_SESSION['PROFILE'];
    $vector[3] = $_SESSION['USERID'];
    $vector[4] =  @date("Y-m-d H:i:s");
    
    
    $tools->insertar2("tbl_acceso", "cuenta_id,ipaddress,perfil,userid,fecha", $vector);
    
    $_SESSION['SESIONID'] = $tools->getUltimoId(); ///id del acceso
    
    
    ///////////////
    
    
}else{
    $_SESSION['PROFILE'] = "";
}
    


$is_login = (!empty($_SESSION['PROFILE']) ? 1 : 0);
    
echo $is_login;


$tools->cerrar();

?>
