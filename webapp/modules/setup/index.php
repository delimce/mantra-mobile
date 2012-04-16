<?php session_start();
////seguridad
$profile = "admin";
///titulo pagina y header

include("../../config/siteconfig.php");

include_once 'controller/load.php';

?>
<body>
 
    
    <script>
        function onSuccess(data, status)
        {
            data = $.trim(data);
            
           $("#notification").text(data);
           $("#notification").css({color:"blue", fontWeight:"bold"});
           
           
           
        }
 
        $(document).ready(function() {
            
            
             $('#form1').validate({
                rules : {
                        r9nombre : {
                        required : true
                    },
                        r9moneda1 :  {
                        required : true
                    },
                        r9imp_iva :  {
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

<!--misDatos-->
<?php $tituloCurrent = LANG_setup; ?>
<div data-role="page" id="pref">

		<div data-role="header">
                        <a href="../lobi.php" data-icon="back"><?php echo LANG_back ?></a>
			<h1><?php echo $tituloCurrent ?></h1>
		</div>
		<div data-role="content">
                   <div id="titulo2"><?php echo LANG_setupDesc ?></div>
                        
            <form id="form1" method="post">
            
             <div data-role="fieldcontain">
            <label style="font-weight:bold" for="r9nombre"><?php echo LANG_setupAcount ?></label>
             <input type="text" data-mini="true" id="r9nombre" name="r9nombre" value="<?php echo $datos["nombre"] ?>"  />
            
            <label style="font-weight:bold" for="r9banner_titulo"><?php echo LANG_setupBanner ?></label>
             <input type="text" id="r9banner_titulo" name="r9banner_titulo" value="<?php echo $datos["banner_titulo"] ?>" >
             
             <label style="font-weight:bold" for="r9footer_titulo"><?php echo LANG_setupFooter ?></label>
             <input type="text" data-mini="true" id="r9footer_titulo" name="r9footer_titulo" value="<?php echo $datos["footer_titulo"] ?>"  />

              <label style="font-weight:bold" for="r9moneda1"><?php echo LANG_setupMoneda1 ?></label>
             <input type="text" data-mini="true" id="r9moneda1" name="r9moneda1" value="<?php echo $datos["moneda1"] ?>"  />
             
              <label style="font-weight:bold" for="r9imp_iva"><?php echo LANG_setupImpIva ?></label>
             <input type="number" data-mini="true" id="r9imp_iva" name="r9imp_iva" value="<?php echo $datos["imp_iva"] ?>"  />
        	
            <p id="notification"></p>  
             </div>
               
           <button data-role="submit" data-theme="b" id="submit" value="submit-value" data-inline="true"><?php echo LANG_save ?></button>
           </form>        
              
		</div>
</div>
<!--misDatos-->


    
</body>
</html>   
