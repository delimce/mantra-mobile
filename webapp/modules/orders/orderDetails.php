<?php
session_start();
////seguridad
$profile = "vendor,admin,courier";
///titulo pagina y header

include("../../config/siteconfig.php");

require_once 'controller/dataOrder.php';

?>


<body>
    
    <script>
    
     ////accion jquery
        $(document).ready(function() {
            
                          
              ///validar
                $("#form2").validate({
                      
                     rules: {
                        motivo :  {
                        required : true
                        
                        }
                        }
                      
                  })  
            
            
            
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
            <a href="index.php" data-icon="back"><?php echo LANG_ordersList ?></a>
            <h1><?php echo $tituloCurrent ?></h1>
                
        </div>
        
        <div data-role="content">
            
             <div><b><?php echo LANG_ordersNumber  ?>:</b> <?php echo $cabecera["id"];  ?></div> 
            <div><b><?php echo LANG_ordersDate  ?>:</b> <?php echo $cabecera["fecha"];  ?></div> 
            <div><b><?php echo LANG_ordersClient  ?>:</b> <?php echo $cabecera["cnombre"].' ('.$cabecera["ccodigo"].')'; ?></div> 
            <div><b><?php echo LANG_ordersVendor  ?>:</b> <?php echo $cabecera["vnombre"].' ('.$cabecera["vcodigo"].')'; ?></div>
             <div id="estatus"><b><?php echo LANG_ordersStatus  ?>:</b> <?php echo $cabecera["estatus"] ?></div>
            <p></p>
             
             
             <ul id="items" data-role="listview">
             <?php while ($row = $tool->db_vector_nom($tool->result)) { ?>
            
            
                <li>
            <b><?php echo LANG_prod ?>:</b><?php echo $row["descripcion"] ?>
            <fieldset style="font-size: 12px">
                <b><?php echo LANG_cant ?>:</b> <?php echo $row["cantidad"]; ?> <b><?php echo LANG_prodPrice ?></b> <?php echo $dataPref["moneda1"] ?>  <?php echo $row["precio"]  ?>   <b><?php echo LANG_ordersSubtotal ?>:</b> <?php echo $dataPref["moneda1"] ?>  <?php echo $row["subtotal"]  ?> 
                
            </fieldset>
            </li>
            
             <?php } ?> 
            </lu>
            
            
            
              <hr>
            <div style="text-align: right"><?php echo LANG_ordersTotalProd ?> <?php echo $dataPref["moneda1"] ?>: <?php echo $cabecera["stotal"] ?></div>
            <div style="text-align: right"><?php echo LANG_ordersTotalImp ?> <?php echo $dataPref["moneda1"] ?>: <?php echo $cabecera["totaliva"]  ?></div>
            <div style="text-align: right;"><b><?php echo LANG_ordersTotal ?> <?php echo $dataPref["moneda1"] ?>: <?php  echo $cabecera["total"] ?></b></div>
             
<!--             box para cancelar el pedido-->
             
             <?php if($cabecera["nestatus"]<3) include_once 'cancelar.php'; else if ($cabecera["nestatus"]==10) include_once 'motivo.php'; ?>  






        </div>
        
        
    </div>
    
</body>
</html>  
<?php $tool->cerrar(); ?>