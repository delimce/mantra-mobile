<?php 
$tool = new formulario("db");

$id = $tool->getvar("id",$_GET);

//////en caso de recarga de pagina
if(empty($id))$tool->redirect ('index.php');


        $producto = $tool->simple_db(factoryDAO::getProdUnit($id,$_SESSION['CUENTAID']));
  
       
        $tool->query(factoryDAO::getCant($id,$_SESSION['CUENTAID']));
        
        

$total = 0;

?>
