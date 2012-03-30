<?php session_start();
////seguridad
$profile = "vendor";
///titulo pagina y header

include("../../config/siteconfig.php");

include_once 'controller/loadData.php';

?>
<body>
    <?php $tituloCurrent = LANG_ordersNew; ?>
    <div data-role="page" id="crearpedi">
    
        <div data-role="header">
                        <a href="../lobi.php" data-icon="back"><?php echo LANG_back ?></a>
			<h1><?php echo $tituloCurrent ?></h1>
                                               
	</div>
		<div data-role="content">
        
                    <form id="form1" method="post">
                        <div data-role="fieldcontain">

                        <label style="font-weight:bold" for="r9cliente_id" class="select"><?php echo LANG_ordersClient ?></label>
				
                         <?php echo $tool->combo_db("r9cliente_id",$queryc,"nombre","id",$porDefecto,$seleccionado,false,'',false,$desactivado); ?>
 



                        </div>
                    </form>
                    
                    
                    
                    
                    
<!--                para añadir productos    -->
                    
                <div data-role="collapsible" data-content-theme="c">
                    <h3><?php echo LANG_ordersAddProduct ?></h3>
                   
                   <form id="form1" action="detalle.php" data-transition="slide"  method="post"> 
                       
                      <div data-role="fieldcontain">
                          
                                <label style="font-weight:bold" for="categoriap" class="select"><?php echo LANG_catProd ?></label>
				<?php echo $tool->combo_db("categoriap",$querycp,"nombre","id",$porDefecto2,$seleccionado2,false,'',false,$desactivado2); ?>
                                <label style="font-weight:bold" for="producto" class="select"><?php echo LANG_prod ?></label>
                                
                                 <label style="font-weight:bold" for="cantidad" class="select"><?php echo LANG_cant ?></label>
                                <input type="number" id="cantidad" name="cantidad">
                                <button data-role="submit" data-theme="b" id="submit" value="submit-value" data-inline="true"><?php echo LANG_add ?></button>
                               
                      </div>
                          
                       
                    
                   </form> 
                    
                </div>
                    
                    
                </div>
    </div>

    
</body>
</html>   