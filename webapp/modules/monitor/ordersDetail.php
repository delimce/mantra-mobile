<?php session_start();
////seguridad
$profile = "admin";
///titulo pagina y header

include("../../config/siteconfig.php");

include_once 'controller/loadOrdersInfo.php';

?>
 <?php $tituloCurrent = LANG_monitorSales; ?>

<body>
<!--div de pagina-->
	<div data-role="page" id="inventariop">
		<div data-role="header">
                        <a href="ordersByVendor.php" data-icon="back"><?php echo LANG_back ?></a>
			<h1><?php echo $tituloCurrent ?></h1>
                       
		</div>
		<div data-role="content">
                    
                     <p>
                     <div style="color:blue;font-weight: bold"><?php echo $nombre ?></div>
                     <div id="titulo2"><?php echo LANG_monitorSalesBy.' '.$vendedor; ?></div>
                    </p>


            <div class="ui-grid-b" style="font-size: 13px;font-weight: bold">
                     <div class="ui-grid-b" style="font-size: 12px;">
                     <div class="ui-block-a"><?php echo LANG_ordersDate ?></div>
                     <div class="ui-block-b"><?php echo LANG_ordersClient ?></div>
                     <div class="ui-block-c"><?php echo LANG_ordersTotal ?> (Bsf)</div>
                </div>
                <p></p>
                <?php while ($row = $tool->db_vector_nom()) {  ?>
                   <div class="ui-grid-b" style="font-size: 12px;">
                            <div class="ui-block-a"><?php echo $row["fecha"] ?> </div>
                            <div class="ui-block-b"><?php echo $row["nombre"] ?> </div>
                            <div class="ui-block-c"><?php echo number_format($row["total"],2) ?></div>

                    </div><!-- /grid-b -->
                 <?php } ?>   
                                   

		</div>
            
                
		             
	</div>
<!--div de login-->    
   

 
</body>
</html>
<?php $tool->cerrar(); ?>