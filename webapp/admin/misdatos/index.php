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
            $("#submit").click(function(){
                
            if($("#clave").val()!=$("#clave2").val()){
                alert('<?php echo LANG_noPass2 ?>');
                return false;
            }
            
 
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
<?php $tituloCurrent = LANG_adminFields; ?>
<div data-role="page" id="misdatos">

		<div data-role="header">
                        <a href="../lobi.php" data-icon="back"><?php echo LANG_back ?></a>
			<h1><?php echo $tituloCurrent ?></h1>
		</div>
		<div data-role="content">
                    <p id="notification"><?php echo LANG_editFields ?></p>
                        
            <form id="form1" data-transition="slide"  method="post">
            
            
            <label style="font-weight:bold" for="nombre"><?php echo LANG_name ?></label>
             <input type="text" data-mini="true" id="r1nombre" name="r1nombre" value="<?php echo $datos["nombre"] ?>"  />
            
            
             <label style="font-weight:bold" for="user"><?php echo LANG_user ?></label>
             <input type="text" data-mini="true" id="r1user" name="r1user" value="<?php echo $datos["user"] ?>"  />

        	<label style="font-weight:bold" for="clave"><?php echo LANG_pass ?></label>
             <input type="password" data-mini="true" id="clave" name="clave" value="<?php echo $datos["pass"] ?>" />
            
             <label style="font-weight:bold" for="clave"><?php echo LANG_pass2 ?></label>
             <input type="password" data-mini="true" id="clave2" name="clave2" value="<?php echo $datos["pass"] ?>" />

           <button data-role="submit" data-theme="b" data-icon="check" data-iconpos="right" id="submit" value="submit-value" data-inline="true"><?php echo LANG_enter ?></button>
           </form>        
              
		</div>
</div>
<!--misDatos-->


    
</body>
</html>   
