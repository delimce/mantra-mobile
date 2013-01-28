<?php
session_start();

$profile = "admin";
include("../../../config/siteconfig.php");

 $i=0;
while(list($key, $value) = each($_POST))
{
    $ids[$i] = $value;
    $i++;
}
$ids = implode(",",$ids);


$tool = new FactoryDAO("db");

$tool->deleteOrderBatch($ids);


  ///////////para mostrar de nuevo los pedidos

/////traer moneda
$moneda = $tool->getMoneda();

if ($_SESSION['PROFILE'] == "vendor")

    $tool->getAllDataOrder($_SESSION['USERID']);
else if ($_SESSION['PROFILE'] == "dispatch")

    $tool->getDataOrderDispath();

else
    $tool->getAllDataOrder();




while ($row = $tool->db_vector_nom($tool->result)) {

    switch ($row["estatus"]) { case 1: $est =  LANG_ordersStatus1; break; case 2: $est = LANG_ordersStatus2; break; case 10: $est = LANG_ordersStatus10;  break; }


    echo "<li>";

   // echo '<input type="checkbox" id="check_'.$row["id"].'" name="check_'. $row["id"].'" value="'. $row["id"].'"';

    echo '<a style="font-size: 15px;" data-ajax="false" href="orderDetails.php?id='.$row["id"].'">';
    echo '<div><b>'.LANG_ordersNumber.'</b>'.$row["pcodigo"].'</b></div>';
    echo '<div><b>'.LANG_ordersDate.'</b> '.$row["fecha"].' <b>'.LANG_ordersClient.'</b> '.$row["cnombre"].'</div>';
    echo '<div><b>'.LANG_ordersTotal.' '.$moneda.' </b>'.$row["total"].'</div>';
    echo '<div><b>'. LANG_ordersStatus.'</b> '.$est.'</div>';

  echo "</a>
  </li>";

 }



$tool->cerrar();

?>
