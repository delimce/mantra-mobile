<?php session_start();
////seguridad
$profile = "admin,dispatch";
///titulo pagina y header

include("../../config/siteconfig.php");

include_once 'controller/loadData.php';

?>
 <?php $tituloCurrent = LANG_masterStock; ?>  



 <script>
        function onSuccess()
        {
            
            $("#form1").submit();
            
           // data = $.trim(data);
            
//           $("#notification").text(data);
//           $("#notification").css({color:"blue", fontWeight:"bold"});
     
           
        }
        
         
 
 
        $(document).ready(function() {
            
           
            ///campo oculto de id producto
            $('#form1').append('<input type="hidden" name="id" id="id" value="<?php echo $id ?>" />');
           
            
             ///validar
                $("#form1").validate({
                      
                     rules: {
                        r9cantidad :  {
                        required : true,
                        digits : true,
                        min : 1
                        
                        }
                        }
                      
                  })  
            
                    
            $("#agregar").click(function(){
                 
               if(!$("#form1").valid()) return false;
                
                
                var formData = $("#form1").serialize();
 
                $.ajax({
                    type: "POST",
                    url: "controller/addCantidad.php",
                    cache: false,
                    data: formData,
                    success: onSuccess
                });
 
                return false;
            });
            
            
        });
    </script>


<body>
<!--div de pagina-->
	<div data-role="page" id="inventariop">
		<div data-role="header">
                        <a href="index.php" data-icon="back"><?php echo LANG_back ?></a>
			<h1><?php echo $tituloCurrent ?></h1>
                       
		</div>
		<div data-role="content">
                    
                     <p>
                     <div style="color:blue;font-weight: bold"><?php echo $producto["descripcion"] ?></div>
                     <div id="titulo2"><?php echo LANG_stockDetail ?></div>
                    </p>
                      
                   
                <?php while ($row = $tool->db_vector_nom($tool->result)) {  ?>
                   <div class="ui-grid-b" style="font-size: 13px;font-weight: bold">
                            <div class="ui-block-a"><?php echo $row["accion"] ?> <?php echo LANG_stockOf ?></div>
                            <div class="ui-block-b"><?php echo $row["cantidad"] ?> <?php echo $producto["unidad"] ?></div>
                            <div class="ui-block-c"><?php echo LANG_stockAt ?> <?php echo $row["fecha"] ?></div>
                           <div class="ui-block-a"><!-- TODO: eliminar ultimo reg de historia de inventario--></div>
                           <?php if($row["operacion"]=="sum") $total+=$row["cantidad"]; else $total-=$row["cantidad"]; ?>
                    </div><!-- /grid-b -->
                 <?php } ?>   
                    <p><?php echo LANG_stockActual.' '.$total ?></p>        
                    
                <div data-role="collapsible" data-content-theme="c">
                    <h3><?php echo LANG_stockAdd ?></h3>
                   
                   <form id="form1" action="detalle.php" data-transition="slide"  method="post"> 
                    <div data-theme="a" class="ui-bar ui-grid-c">
				<div class="ui-block-c"><input type="number" id="r9cantidad" name="r9cantidad"></div>	 
				<div class="ui-block-d"><div style="margin:8px 0 0 13px;"><button id="agregar" data-theme="a"><?php echo LANG_add  ?></button></div></div>  
                    </div>
                   </form> 
                    
                </div>

               
                
		</div>
            
                
		             
	</div>
<!--div de login-->    
   


                
 
</body>
</html>
<?php $tool->cerrar(); ?>