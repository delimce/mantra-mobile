<?php session_start();
////seguridad
$profile = "admin";
///titulo pagina y header

include("../../config/siteconfig.php");

include_once 'controller/loadVendors.php';

?>
 <?php $tituloCurrent = LANG_monitorSales; ?>  

<body>
<!--div de pagina-->
	<div data-role="page" id="accesos">
		<div data-role="header">
                        <a href="index.php" data-icon="back"><?php echo LANG_back ?></a>
			<h1><?php echo $tituloCurrent ?></h1>
                       
		</div>
		<div data-role="content">
                    
                     <p>
                     <div style="color:blue;font-weight: bold"><?php echo LANG_monitorSalesTotalByAccount.$_SESSION['CUENTA'] ?></div>
                     <div><?php echo LANG_monitorSalesTotal.$moneda.' '.number_format($total,2);  ?></div>
                </p>
                      
                   
               <ul data-role="listview" data-inset="true" data-filter="true">
                             <?php while ($row = $tool->db_vector_nom($tool->result)) { ?>
                                <li><a class="check" data-ajax="false" href="ordersDetail.php?id=<?php echo $row["id"] ?>">
                                    
                                        <div style="color:blue"><?php echo $row["nombre"] ?> (<?php echo $row["codigo"] ?>)<br></div>
                                        <div><?php echo LANG_monitorSales ?> <?php echo $row["procesados"] ?></div>
                                        <div>
                                            <b><?php echo LANG_ordersTotal.' '.$moneda ?>:</b> <?php echo number_format($row["total"],2); ?>
                                        </div>    
    
                                    </a></li>
                                
                              <?php } ?>  
                </ul> 
              
                
		</div>
            
                
		             
	</div>
<!--div de login-->    
   


                
 
</body>
</html>
<?php $tool->cerrar(); ?>