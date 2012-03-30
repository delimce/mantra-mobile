<?php session_start();
////seguridad
$profile = "vendor";
///titulo pagina y header

include("../../config/siteconfig.php");
include_once('controller/loadData.php');

 require_once("controller/loadVendor.php");
 include_once('controller/loadCat.php'); ///categorias

?>
<body>

<?php $tituloCurrent = LANG_masterClient; ?>
<div data-role="page" id="agregar">

		<div data-role="header">
                        <a href="index.php" data-icon="back"><?php echo LANG_back ?></a>
			<h1><?php echo $tituloCurrent ?></h1>
		</div>
		<div data-role="content">
                    <div id="titulo2"><?php echo LANG_addEdit ?></div>
                        
            <form id="form1" action="index.php" data-transition="slide"  method="post">
            
                <div data-role="fieldcontain">
           <label style="font-weight:bold" for="r9codigo"><?php echo LANG_prodCode ?></label>
           <input type="text" data-mini="true" id="r9codigo" name="r9codigo" maxlength="12" value="<?php echo $datos['codigo']  ?>" READONLY/>
        
             <label style="font-weight:bold" for="r9nombre"><?php echo LANG_cliName ?></label>
             <input type="text" data-mini="true" id="r9nombre" name="r9nombre" value="<?php echo $datos['nombre']  ?>"  READONLY/>

        	<label style="font-weight:bold" for="r9rif"><?php echo LANG_cliRIF ?></label>
             <input type="text" data-mini="true" id="r9rif" name="r9rif" value="<?php echo $datos['rif']  ?>" READONLY/>
            
             <label style="font-weight:bold" for="r9telefono1"><?php echo LANG_cliTlf ?></label>
             <input type="tel" data-mini="true" id="r9telefono1" name="r9telefono1" value="<?php echo $datos['telefono1']  ?>" READONLY/>
             
              <label style="font-weight:bold" for="r9email"><?php echo LANG_email ?></label>
             <input type="email" data-mini="true" id="r9email" name="r9email"  value="<?php echo $datos['email']  ?>" READONLY/>
             
             <label style="font-weight:bold" for="categoriac"><?php echo LANG_catProd ?></label>             		
             <?php echo $tool->combo_db("categoriac",$queryc,"nombre","id",$porDefectoc,$seleccionadoc,false,LANG_prodValCli,false,true); ?>

             
             
             <label style="font-weight:bold" for="r9direccion1"><?php echo LANG_cliDir ?></label>
                <textarea data-mini="true" id="r9direccion1" name="r9direccion1" READONLY><?php echo $datos['direccion1']  ?></textarea>
               
               <label style="font-weight:bold" for="r9direccion2"><?php echo LANG_cliDir2 ?></label>
                <textarea data-mini="true" id="r9direccion1" name="r9direccion2"  READONLY><?php echo $datos['direccion2']  ?></textarea>  
                
            <p>
                <input type="checkbox" name="r9activo" id="r9activo" value="1" class="custom" <?php if($datos['activo']==1) echo 'checked="checked"' ?>  DISABLED/>
		<label for="r9activo"><?php echo LANG_cliActive ?></label>  
                
                
                        
             <label style="font-weight:bold" for="r9vendedor_id" class="select"><?php echo LANG_cliBelongTo ?></label>
				
             <?php echo $tool->combo_db("r9vendedor_id",$queryv,"nombre","id",$porDefecto,$seleccionado,false,'',false,true); ?>
                             
            
            </form>        
              
		</div>
</div>



    
</body>
</html>       