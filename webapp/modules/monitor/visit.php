<?php session_start();
////seguridad
$profile = "admin";
///titulo pagina y header

include("../../config/siteconfig.php");

include_once 'controller/loadVisit.php';

?>
 <?php $tituloCurrent = LANG_monitorAccess; ?>  

<body>
<!--div de pagina-->
	<div data-role="page" id="accesos">
		<div data-role="header">
                        <a href="index.php" data-icon="back"><?php echo LANG_back ?></a>
			<h1><?php echo $tituloCurrent ?></h1>
                       
		</div>
		<div data-role="content">
                    
                     <p>
                     <div style="color:blue;font-weight: bold"><?php echo LANG_monitorAccessbyCount.$_SESSION['CUENTA'] ?></div>
                     <div><?php echo LANG_monitorTotalAccess.$total  ?></div>
                </p>
                      
                   
               <ul data-role="listview" data-inset="true" data-filter="true">
                             <?php while ($row = $tool->db_vector_nom($tool->result)) { ?>
                                <li><a class="check" data-ajax="false" href="visitDetail.php?id=<?php echo $row["id"] ?>&perfil=<?php echo $row["perfil"]  ?>">
                                    
                                        <div style="color:blue"><?php echo $row["nombre"] ?><br></div>
                                        <div style="font-size: 11px;"><?php mostrarPerfil($row["perfil"]) ?></div>
                                        <div>
                                            <b><?php echo LANG_monitorAccess ?>:</b> <?php echo $row["total"] ?>
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