<?php session_start();
////seguridad
$profile = "admin,vendor,dispatch";
///titulo pagina y header

include("../../config/siteconfig.php");

include_once 'controller/load.php';

?>

    <?php $tituloCurrent = LANG_ordersList; ?>    
<!--div de pagina-->
	<div data-role="page" id="OrderList">
		<div data-role="header">
                        <a href="../lobi.php" data-icon="back"><?php echo LANG_back ?></a>
			<h1><?php echo $tituloCurrent ?></h1>
                                               
		</div>
		<div data-role="content">
                        <p><?php echo LANG_totalReg.$tool->getNreg(); ?></p>
                         <ul data-role="listview" data-inset="true" data-filter="true">
                             <?php while ($row = $tool->db_vector_nom($tool->result)) { ?>
                                <li><a class="check" data-ajax="false" href="orderDetails.php?id=<?php echo $row["id"] ?>">
                                        <div><b><?php echo LANG_ordersNumber ?></b> <?php echo $row["id"] ?></div>
                                        <div><b><?php echo LANG_ordersDate ?> </b><?php echo $row["fecha"] ?> <b>  <?php echo LANG_ordersClient ?> </b> <?php echo $row["cnombre"] ?>  <b> <?php echo LANG_ordersTotal.' '.$moneda ?> </b> <?php echo $row["total"] ?></div>
                                        <div><b><?php echo LANG_ordersStatus ?> </b><?php switch ($row["estatus"]) {
                                                                                                    case 1:
                                                                                                        echo LANG_ordersStatus1;
                                                                                                        break;
                                                                                                    case 2:
                                                                                                        echo LANG_ordersStatus2;
                                                                                                        break;
                                                                                                    case 10:
                                                                                                        echo LANG_ordersStatus10;
                                                                                                        break;
                                                                                                } ?></div>
                                    </a></li>
                                
                              <?php } ?>  
                        </ul>
                                    
                    
		</div>
		             
	</div>
   
 
</body>
</html>
<?php $tool->cerrar(); ?>