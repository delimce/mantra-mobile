<?php session_start();
////seguridad
$profile = "admin";
///titulo pagina y header

include("../../config/siteconfig.php");

include_once 'controller/loadAccess.php';

?>
 <?php $tituloCurrent = LANG_monitorAccessByPerson; ?>  

<body>
<!--div de pagina-->
	<div data-role="page" id="inventariop">
		<div data-role="header">
                        <a href="visit.php" data-icon="back"><?php echo LANG_back ?></a>
			<h1><?php echo $tituloCurrent ?></h1>
                       
		</div>
		<div data-role="content">
                    
                     <p>
                     <div style="color:blue;font-weight: bold"><?php echo $nombre ?></div>
                     <div id="titulo2"><?php echo LANG_monitorAccessOf ?></div>
                    </p>
                      
                    
                <?php while ($row = $tool->db_vector_nom()) {  ?>
                   <div class="ui-grid-b" style="font-size: 13px;font-weight: bold">
                            <div class="ui-block-a"><?php echo $row["fecha"] ?> </div>
                            <div class="ui-block-b"><?php echo $row["ip"] ?> </div>
                            <div class="ui-block-c"><?php echo $row["sesion"] ?></div>
                                                      
                    </div><!-- /grid-b -->
                 <?php } ?>   
                                   
             
                
		</div>
            
                
		             
	</div>
<!--div de login-->    
   


                
 
</body>
</html>
<?php $tool->cerrar(); ?>