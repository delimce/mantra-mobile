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
               $(location).attr('href','index.php');
          
           
        }
 
         $("div[data-role*='page']").live('pageshow', function() {  
            
            
             ///validar
            
            $('#form1').validate({
                rules : {
                        r9nombre : {
                        required : true
                    },
                        r9descripcion :  {
                        required : true
                    }
                     
                }
            });
            
            
            
            
            
            $("#submit").click(function(){
                 
                 
                 if(!$("#form1").valid()) return false; 
                                 
                var formData = $("#form1").serialize();
                 $('#submit').attr('disabled', 'disabled');
 
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


<?php $tituloCurrent = LANG_masterClientCat; ?>
<div data-role="page" id="agregar">

		<div data-role="header">
                        <a href="index.php" data-icon="back"><?php echo LANG_back ?></a>
			<h1><?php echo $tituloCurrent ?></h1>
		</div>
		<div data-role="content">
                    <div id="notification"><?php echo LANG_addNew ?></div>
                        
            <form id="form1" action="index.php" data-transition="slide"  method="post">
            
             <div data-role="fieldcontain">
                   
             <label style="font-weight:bold" for="r9nombre"><?php echo LANG_catTitle ?></label>
             <input type="text" data-mini="true" id="r9nombre" name="r9nombre"  />

               <label style="font-weight:bold" for="r9descripcion"><?php echo LANG_catDesc ?></label>
               <textarea id="r9descripcion" name="r9descripcion"></textarea>
               <p>
              
             <input type="checkbox" name="r9activo" id="r9activo" value="1" class="custom" checked="checked"/>
	     <label for="r9activo"><?php echo LANG_catActive ?></label>  
                
             </div>
                
                 <button data-role="submit" data-theme="b" id="submit" value="submit-value" data-inline="true"><?php echo LANG_save ?></button>
            
            </form>        
              
		</div>
</div>



    
</body>
</html>   