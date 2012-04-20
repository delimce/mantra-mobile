<?php session_start();
////seguridad
$profile = "admin,vendor";
///titulo pagina y header

include("../../config/siteconfig.php");

include_once 'controller/load.php';

?>

    <?php $tituloCurrent = LANG_masterClient; ?>    
<!--div de pagina-->
	<div data-role="page" id="maestroc">
		<div data-role="header">
                        <a href="<?php echo $regreso ?>" data-icon="back"><?php echo LANG_back ?></a>
			<h1><?php echo $tituloCurrent ?></h1>
                        <a href="agregar.php" data-icon="pluss" data-ajax="false" data-theme="b"><?php echo LANG_addNew ?></a>                    
                        
		</div>
		<div data-role="content">
                        <p><?php echo LANG_totalReg.$tool->getNreg(); ?></p>
                         <ul data-role="listview" data-inset="true" data-filter="true">
                             <?php while ($row = $tool->db_vector_nom($tool->result)) { ?>
                                <li><a class="check" data-ajax="false" href="<?php echo $link.$row["id"];  ?>">
                                    
                                        <div style="color:blue"><?php echo $row["nombre"] ?><br></div>
                                    <fieldset style="font-size: 12px">
                                        <b>codigo:</b> <?php echo $row["codigo"] ?>
                                        <b>Rif</b> <?php echo $row["rif"] ?>
                                         
                                        
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