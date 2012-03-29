<?php session_start();
////seguridad
$profile = "admin,vendor";
///titulo pagina y header

include("../../config/siteconfig.php");

require("controller/loadVendor.php");

?>
<body>
 
    
    <script>
        function onSuccess()
        {
               $(location).attr('href','index.php');
          
           
        }
 
        $(document).ready(function() {
            
            
             ///validar
            
            $('#form1').validate({
                rules : {
                        r9codigo : {
                        required : true
                    },
                        r9nombre :  {
                         required : true
                         
                    },
                        r9rif :  {
                        required : true
                    },
                    r9email :  {
                        email : true
                    }
                     
                }
            });
            
            
            
            $("#submit").click(function(){
                 
                 
                 ///validar
                 
                 if(!$("#form1").valid()) return false;     
           
                var formData = $("#form1").serialize();
 
                $.ajax({
                    type: "POST",
                    url: "controller/save.php",
                    cache: false,
                    data: formData,
                    success: onSuccess
                });
 
                return false;
            });
        });
    </script>


<?php $tituloCurrent = LANG_masterClient; ?>
<div data-role="page" id="agregar">

		<div data-role="header">
                        <a href="index.php" data-icon="back"><?php echo LANG_back ?></a>
			<h1><?php echo $tituloCurrent ?></h1>
		</div>
		<div data-role="content">
                    <div id="notification"><?php echo LANG_addNew ?></div>
                        
            <form id="form1" action="index.php" data-transition="slide"  method="post">
            
                <div data-role="fieldcontain">
            <label style="font-weight:bold" for="r9codigo"><?php echo LANG_prodCode ?></label>
            <input type="text" data-mini="true" id="r9codigo" name="r9codigo" maxlength="12" />
        
             <label style="font-weight:bold" for="r9nombre"><?php echo LANG_cliName ?></label>
             <input type="text" data-mini="true" id="r9nombre" name="r9nombre"  />

        	<label style="font-weight:bold" for="r9rif"><?php echo LANG_cliRIF ?></label>
             <input type="text" data-mini="true" id="r9rif" name="r9rif"/>
            
             <label style="font-weight:bold" for="r9telefono1"><?php echo LANG_cliTlf ?></label>
             <input type="tel" data-mini="true" id="r9telefono1" name="r9telefono1"/>
             
              <label style="font-weight:bold" for="r9email"><?php echo LANG_email ?></label>
             <input type="email" data-mini="true" id="r9email" name="r9email"  />
             
             
             <label style="font-weight:bold" for="r9direccion1"><?php echo LANG_cliDir ?></label>
                <textarea id="r9direccion1" name="r9direccion1"></textarea>
               
              <label style="font-weight:bold" for="r9direccion2"><?php echo LANG_cliDir2 ?></label>
                <textarea id="r9direccion1" name="r9direccion2"></textarea>
                
                
            <p>
              
             <input type="checkbox" name="r9activo" id="r9activo" value="1" class="custom" />
	     <label for="r9activo"><?php echo LANG_cliActive ?></label>    
                
                     
             <label style="font-weight:bold" for="r9vendedor_id" class="select"><?php echo LANG_cliBelongTo ?></label>
				
             <?php echo $tool->combo_db("r9vendedor_id",$queryv,"nombre","id",$porDefecto,$seleccionado,false,'',false,$desactivado); ?>
                             
                
             </div>
                
                 <button data-role="submit" data-theme="b" id="submit" value="submit-value" data-inline="true"><?php echo LANG_save ?></button>
            
            </form>        
              
		</div>
</div>



    
</body>
</html>
<?php $tool->cerrar(); ?>