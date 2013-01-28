<?php
session_start();
////seguridad
$profile = "vendor,admin,dispatch";
///titulo pagina y header

include("../../config/siteconfig.php");

require_once 'controller/dataOrder.php';

?>


<body>
    
    <script>
    
     ////accion jquery
        $(document).ready(function() {
            
            
            
            /////para no mostrar los totales si es un despachador
             <?php if($_SESSION['PROFILE']=="dispatch"){ ?>
                    
                    $("#muestraTotal").hide();
                                
            <?php } ?>
            
            
            
            
                          
              ///validar
                $("#form2").validate({
                      
                     rules: {
                        motivo :  {
                        required : true
                        
                        }
                        }
                      
                  })  
              

               $("#print2").click(function (){
                   $("#imprime").printArea();
                })    

            
             ////procesar pedido
             $("#process").click(function(){
                 
                  var answer = confirm("<?php echo LANG_ordersProcessConfirm ?>")
                    if (answer){
                        
                           $.ajax({
                                type: "POST",
                                url: "controller/process.php",
                                data: ({id: <?php echo $id  ?>}) ,
                                success: function(data){
                                    $(location).attr('href','index.php');
                                }

                            })                      
                        
                    }
                 
             })
            
            
             ////borrar pedido
             $("#borrar").click(function(){
                 
                  var answer = confirm("<?php echo LANG_ordersDeleteConfirm ?>")
                    if (answer){
                        
                           $.ajax({
                                type: "POST",
                                url: "controller/deleteOrder.php",
                                data: ({id: <?php echo $id  ?>}) ,
                                success: function(data){
                                    $(location).attr('href','index.php');
                                }

                            })                      
                        
                    }
                 
             })
            
            
            
            
            /////cancelar pedido
             $("#cancel").click(function(){
                 
                 
                    if(!$("#form2").valid()) return false; 
                
                     var answer = confirm("<?php echo LANG_ordersCancelConfirm ?>")
                    if (answer){
                        
                         
                        
                        var formData = $("#form2").serialize();
                         $.ajax({
                                type: "POST",
                                url: "controller/cancelOrder.php",
                                cache: false,
                                data: formData,
                                success: function(data){
                                    $("#cancelado").html(data);
                                    
                                    $("#estatus").html('<?php echo LANG_ordersCanceled ?>');
                               
                                }
                            });
                        
                        
                         
                    }

                    return false;  
                      
            });
            
            
        });
    
    
    </script>

    <?php $tituloCurrent = LANG_ordersDetail; ?>
    <div data-role="page" id="verpedi">
        
        <div data-role="header">
            <a href="index.php" data-icon="back" data-ajax="false"><?php echo LANG_ordersList ?></a>
            <h1><?php echo $tituloCurrent ?></h1>

            <?php if($_SESSION['PROFILE']=="vendor"){ ?>
            <a href="crear.php" data-icon="pluss" data-ajax="false" data-theme="b"><?php echo LANG_ordersNew ?></a>
            <?php } ?>
                
        </div>
        
        <div data-role="content" style="font-size: 11pt;">
            
            <div id="imprime">
            
             <div><b><?php echo LANG_ordersNumber  ?>:</b> <?php echo $cabecera["pcodigo"];  ?></div> 
            <div><b><?php echo LANG_ordersDate  ?>:</b> <?php echo $cabecera["fecha"];  ?></div> 
            <div><b><?php echo LANG_ordersClient  ?>:</b> <?php echo $cabecera["cnombre"].' ('.$cabecera["ccodigo"].')'; ?></div> 
            <div><b><?php echo LANG_ordersVendor ?>:</b> <?php echo $cabecera["vnombre"].' ('.$cabecera["vcodigo"].')'; ?></div>
          
           <?php if($cabecera["nestatus"]>1 && $cabecera["nestatus"]!=10){ ?>
           <div><b><?php echo LANG_ordersDispatchBy  ?>:</b> <?php echo $cabecera["dnombre"].' ('.$cabecera["dcodigo"].')'; ?></div>
           <div><b><?php echo LANG_ordersDateDispatch  ?>:</b> <?php echo $cabecera["fechades"];  ?></div> 
           <?php } ?>
           
            <div id="estatus"><b><?php echo LANG_ordersStatus  ?>:</b> 
                <?php switch ($cabecera["nestatus"]) {
                    case 1:
                        echo LANG_ordersStatus1;
                        break;
                    case 2:
                        echo LANG_ordersStatus2;
                        break;
                    case 10:
                        echo LANG_ordersStatus10;
                        break;
                } ?></div>
            <p></p>
             
             
<!--             <ul id="items">-->
             <?php while ($row = $tool->db_vector_nom($tool->result)) { ?>
            
            	<div>
<!--                <li>-->
<!--            <b><?php echo LANG_prod ?>:</b>-->
                <?php echo $row["descripcion"] ?>
            
                <b><?php echo LANG_cant ?>:</b> <?php echo $row["cantidad"]; ?>
<!--                <b><?php echo LANG_prodPrice ?></b> <?php echo $moneda ?>  <?php echo $row["precio"]  ?>   <b><?php echo LANG_ordersSubtotal ?>:</b> <?php echo $moneda ?>  <?php echo $row["subtotal"]  ?> -->
   
<!--            </li>-->
            	</div>
				
             <?php } ?> 
<!--            </lu>-->
            
            
            
              <hr>
              
             <div id="muestraTotal">
            <div style="text-align: right"><?php echo LANG_ordersTotalProd ?> <?php echo $moneda ?>: <?php echo $cabecera["stotal"] ?></div>
            <div style="text-align: right"><?php echo LANG_ordersTotalImp ?> <?php echo $moneda ?>: <?php echo $cabecera["totaliva"]  ?></div>
            <div style="text-align: right;"><b><?php echo LANG_ordersTotal ?> <?php echo $moneda ?>: <?php  echo $cabecera["total"] ?></b></div>
            </div>   
              
        </div>   
<!--             box para cancelar el pedido-->
             
             <?php 
             
              ////si es despachador y es pedido nuevo
              if($cabecera["nestatus"]==1 && $_SESSION["PROFILE"]=="dispatch"){
                  
                    include_once 'procesar.php';
             
              ////si es admin y es pedido nuevo
              }else if($cabecera["nestatus"]==1 && $_SESSION["PROFILE"]=="admin"){
                                  
                    include_once 'cancelar.php'; 
                    
             /////si el pedido esta procesado       
             }else if ($cabecera["nestatus"]==2){
                 
                    include_once 'imprimir.php'; 
             
             ////si el pedido esta cancelado
             }else if ($cabecera["nestatus"]==10){
                 
                    include_once 'motivo.php';
              
             }
             
                          
             ?>  






        </div>
        
        
    </div>
    
</body>
</html>  
<?php $tool->cerrar(); ?>