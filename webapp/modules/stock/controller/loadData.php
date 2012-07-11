<?php 
$tool = new Formulario("db");

$id = $tool->getvar("id",$_GET);

//////en caso de recarga de pagina
if(empty($id)) header("location: index.php");


        $producto = $tool->simple_db(FactoryDAO::getProdUnit($id,$_SESSION['CUENTAID']));
  
       
        $tool->query(FactoryDAO::getCant($id,$_SESSION['CUENTAID']));
        
        

$total = 0;

?>
