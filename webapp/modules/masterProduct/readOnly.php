<?php session_start();
////seguridad
$profile = "dispatch";
///titulo pagina y header

include("../../config/siteconfig.php");
include_once('controller/loadData.php');
include_once('controller/loadUnit.php'); ///unidades
include_once('controller/loadCat.php'); ///categorias

?>

<?php $tituloCurrent = LANG_masterProducts; ?>
<div data-role="page" id="agregar">

		<div data-role="header">
                        <a href="index.php" data-ajax="false" data-icon="back"><?php echo LANG_back ?></a>
			<h1><?php echo $tituloCurrent ?></h1>
		</div>
		<div data-role="content">
                    <div id="titulo2"><?php echo LANG_preview ?></div>
                        

                <div data-role="fieldcontain">
            <label style="font-weight:bold" for="r9codigo"><?php echo LANG_prodCode ?></label>
            <input type="text" data-mini="true" id="r9codigo" name="r9codigo" maxlength="12" value="<?php echo $datos['codigo']  ?>" READONLY/>
        
             <label style="font-weight:bold" for="r9descripcion"><?php echo LANG_prodName ?></label>
             <input type="text" data-mini="true" id="r9descripcion" name="r9descripcion" value="<?php echo $datos['descripcion']  ?>" READONLY/>

                          
             <label style="font-weight:bold" for="r9precio1"><?php echo LANG_prodPrice.' '.$_SESSION['MONEDA1'] ?></label>
             <input type="text" data-mini="true" id="r9precio1" name="r9precio1" value="<?php echo $datos['precio1']  ?>" READONLY/>
           
                       
<!--             <label style="font-weight:bold" for="r9precio2"><?php echo LANG_prodBuy.' '.$_SESSION['MONEDA1'] ?></label>
             <input type="text" data-mini="true" id="r9precio2" name="r9precio2" value="<?php echo $datos['precio2']  ?>"/>-->
             
             <label style="font-weight:bold" for="r9precio3"><?php echo LANG_prodSug.' '.$_SESSION['MONEDA1'] ?></label>
             <input type="text" data-mini="true" id="r9precio3" name="r9precio3" value="<?php echo $datos['precio3']  ?>" READONLY/>
            
             
             <label style="font-weight:bold" for="r9unidad_med"><?php echo LANG_prodUnit ?></label>		
             <?php echo $tool->combo_db("r9unidad_med",$queryu,"titulo","id",$porDefecto,$seleccionado,false,LANG_prodValUnit,false,true); ?>

             <label style="font-weight:bold" for="r9unidad_cant"><?php echo LANG_units ?></label>
             <input type="text" data-mini="true" id="r9unidad_cant" name="r9unidad_cant" value="<?php echo $datos['unidad_cant']  ?>" READONLY/>
             
             
               
              <label style="font-weight:bold" for="categoriap"><?php echo LANG_catProd ?></label>             		
             <?php echo $tool->combo_db("categoriap",$queryc,"nombre","id",$porDefectoc,$seleccionadoc,false,LANG_prodValCat,false,true); ?>

             
             
             <p>
                 
                  
              <input type="checkbox" name="r9paga_impuesto" id="r9paga_impuesto" value="1" class="custom" <?php if($datos['paga_impuesto']==1) echo 'checked="checked"' ?>  DISABLED/>
		<label for="r9paga_impuesto"><?php echo LANG_prodPay ?></label> 
             
                 
                <input type="checkbox" name="r9activo" id="r9activo" value="1" class="custom" <?php if($datos['activo']==1) echo 'checked="checked"' ?>  DISABLED/>
		<label for="r9activo"><?php echo LANG_prodActive ?></label>  
                
                
                
                <div id="notification"></div>
             </div>
                
                      
              
		</div>
</div>

    
</body>
</html>   
<?php $tool->cerrar(); ?>