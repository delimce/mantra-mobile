<?php session_start();
////seguridad
$profile = "admin";
///titulo pagina y header

include("../../config/siteconfig.php");

?>
<body>
 
    
    <script>
        function onSuccess()
        {
              $("#form1").submit();
          
           
        }
 
        $(document).ready(function() {
            
            
             ///validar
            
            $('#form1').validate({
                rules : {
                        r9codigo : {
                        required : true
                    },
                        r9descripcion :  {
                        required : true
                    },
                        r9unidad_med :  {
                        required : true
                    },
                        r9precio1 :  {
                        required : true,
                        number: true
                    }
                     
                }
            });
            
            
            
            
            
            $("#submit").click(function(){
                 
                 
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


<?php $tituloCurrent = LANG_masterProducts; ?>
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
        
             <label style="font-weight:bold" for="r9descripcion"><?php echo LANG_prodName ?></label>
             <input type="text" data-mini="true" id="r9descripcion" name="r9descripcion"  />

        	<label style="font-weight:bold" for="r9unidad_med"><?php echo LANG_prodUnit ?></label>
             <input type="text" data-mini="true" id="r9unidad_med" name="r9unidad_med"/>
            
             <label style="font-weight:bold" for="r9precio1"><?php echo LANG_prodPrice.' '.$_SESSION['MONEDA1'] ?></label>
             <input type="text" data-mini="true" id="r9precio1" name="r9precio1"/>
            <p>
             <input type="checkbox" name="r9activo" id="r9activo" value="1" class="custom" />
		<label for="r9activo"><?php echo LANG_prodActive ?></label>   
                
             </div>
                
                 <button data-role="submit" data-theme="b" id="submit" value="submit-value" data-inline="true"><?php echo LANG_save ?></button>
            
            </form>        
              
		</div>
</div>



    
</body>
</html>   