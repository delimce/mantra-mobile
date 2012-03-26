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
                        r9titulo : {
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


<?php $tituloCurrent = LANG_masterUnit; ?>
<div data-role="page" id="agregar">

		<div data-role="header">
                        <a href="index.php" data-icon="back"><?php echo LANG_back ?></a>
			<h1><?php echo $tituloCurrent ?></h1>
		</div>
		<div data-role="content">
                    <div id="notification"><?php echo LANG_addNew ?></div>
                        
            <form id="form1" action="index.php" data-transition="slide"  method="post">
            
             <div data-role="fieldcontain">
                   
             <label style="font-weight:bold" for="r9titulo"><?php echo LANG_UniTitle ?></label>
             <input type="text" data-mini="true" id="r9titulo" name="r9titulo"  />

               <label style="font-weight:bold" for="r9descripcion"><?php echo LANG_UnitDesc ?></label>
               <textarea id="r9descripcion" name="r9descripcion"></textarea>
  
                
             </div>
                
                 <button data-role="submit" data-theme="b" id="submit" value="submit-value" data-inline="true"><?php echo LANG_save ?></button>
            
            </form>        
              
		</div>
</div>



    
</body>
</html>   