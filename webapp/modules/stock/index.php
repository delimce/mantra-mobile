<?php session_start();
////seguridad
$profile = "admin";
///titulo pagina y header

include("../../config/siteconfig.php");

include_once 'controller/load.php';

?>

    <?php $tituloCurrent = LANG_masterStock; ?>    
<!--div de pagina-->
	<div data-role="page" id="inventariop">
		<div data-role="header">
                        <a href="../lobi.php" data-icon="back"><?php echo LANG_back ?></a>
			<h1><?php echo $tituloCurrent ?></h1>
                        
		</div>
		<div data-role="content">
                     <p><div id="titulo2"><?php echo LANG_textStock ?></div></p>
                         <ul data-role="listview" data-inset="true" data-filter="true">
                             <?php while ($row = $tool->db_vector_nom($tool->result)) { ?>
                                <li><a class="check" data-ajax="false" href="detalle.php?id=<?php echo $row["id"] ?>">
                                    
                                        <div style="color:blue"><?php echo $row["descripcion"] ?><br></div>
                                    <fieldset style="font-size: 12px">
                                        <div style="<?php if($row["cantidad"]<=0) echo 'color: red'; ?>"> <b>cantidad:</b> <?php echo $row["cantidad"] ?></div>
                                                                   
                                        
                                    </fieldset>
                                    </a></li>
                                
                              <?php } ?>  
                        </ul>
                                    
                    
		</div>
		             
	</div>
<!--div de login-->    
   
 
</body>
</html>
<?php $tool->cerrar(); ?>