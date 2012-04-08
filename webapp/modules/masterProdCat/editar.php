<?php session_start();
////seguridad
$profile = "admin";
///titulo pagina y header

include("../../config/siteconfig.php");
include_once('controller/loadData.php');

?>
<body>
 
    
    <script>
        function onSuccess(data)
        {
            data = $.trim(data);
            
           $("#notification").text(data);
           $("#notification").css({color:"blue", fontWeight:"bold"});
           
           
           
        }
        
         
 
 
        $(document).ready(function() {
            
            
            
              ///validar
            
            $('#form1').validate({
                rules : {
                        r9nombre : {
                        required : true
                    },
                        r9descripcion :  {
                        required : true
                    },
                        r9monto :  {
                        number: true,
                        max: 100
                    }
                     
                }
            });
           
            ///campo oculto de id
            $('#form1').append('<input type="hidden" name="id" id="id" value="<?php echo $id ?>" />');
           
            $("#borrar").click(function(){
                
                     var answer = confirm("<?php echo LANG_confirmDelete ?>")
                    if (answer){
                        
                         
                        
                        var formData = $("#form1").serialize();
                         $.ajax({
                                type: "POST",
                                url: "controller/delete.php",
                                cache: false,
                                data: formData
                            });
                        
                        
                         $(location).attr('href','index.php');
                    }

                    return false;  
                      
            });
            
            
            
            $("#submit").click(function(){
                 
                 
                 ///validar
                 if(!$("#form1").valid()) return false; 
                            
                
                var formData = $("#form1").serialize();
 
                $.ajax({
                    type: "POST",
                    url: "controller/edit.php",
                    cache: false,
                    data: formData,
                    success: onSuccess
                });
 
                return false;
            });
        });
    </script>


<?php $tituloCurrent = LANG_masterProdCat; ?>
<div data-role="page" id="agregar">

		<div data-role="header">
                        <a href="index.php" data-icon="back"><?php echo LANG_back ?></a>
			<h1><?php echo $tituloCurrent ?></h1>
		</div>
		<div data-role="content">
                    <div id="titulo2"><?php echo LANG_addEdit ?></div>
                        
            <form id="form1" action="index.php" data-transition="slide"  method="post">
            
                <div data-role="fieldcontain">
                   
             <label style="font-weight:bold" for="r9nombre"><?php echo LANG_catTitle ?></label>
             <input type="text" data-mini="true" id="r9nombre" name="r9nombre" value="<?php echo $datos['nombre'] ?>" />

               <label style="font-weight:bold" for="r9descripcion"><?php echo LANG_catDesc ?></label>
               <textarea id="r9descripcion" name="r9descripcion"><?php echo $datos['descripcion'] ?></textarea>
               
                <label style="font-weight:bold" for="r9tipo_cargo"><?php echo LANG_prodCatExtra ?></label>
              <?php echo $tool2->combo_array("r9tipo_cargo",$tipoLabel,$tipovalues,false,$seleccionado); ?>  
             
             <label style="font-weight:bold" for="r9nombre"><?php echo LANG_prodCatExtraPercet ?></label>
             <input type="text" data-mini="true" id="r9monto" name="r9monto" maxlength="4" value="<?php echo $datos['monto'] ?>"  />
     
               
               <p>
              
             <input type="checkbox" name="r9activo" id="r9activo" value="1" class="custom" <?php if($datos['activo']==1) echo 'checked="checked"' ?>/>
	     <label for="r9activo"><?php echo LANG_catActive ?></label>  
                
             </div>
                <div id="notification"></div>
                 <button data-role="submit" data-theme="b" id="submit" value="submit-value" data-inline="true"><?php echo LANG_save ?></button>
                 <button data-role="borrar" data-theme="c" id="borrar" value="submit-value" data-inline="true"><?php echo LANG_deleteit ?></button>
            
            </form>        
              
		</div>
</div>



    
</body>
</html>   