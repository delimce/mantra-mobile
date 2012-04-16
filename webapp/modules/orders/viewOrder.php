<?php
session_start();
////seguridad
$profile = "vendor";
///titulo pagina y header

include("../../config/siteconfig.php");

include_once 'controller/loadTempOrder.php';
?>
<body>
    
    <script>
        
          


    ////accion jquery
        $(document).ready(function() {
            
             //////siguiente paso
            $("#ok").click(function(){
                
                 $.ajax({
                    type: "POST",
                    url: "controller/createOrder.php",
                    async: false,
                    success: function (data) {                  
                          $(location).attr('href','orderDetails.php?id='+data);
                    }
                });
                
                
                
                
             });
            
            
            
       });


    </script>
    
     <?php $tituloCurrent = LANG_ordersCheck; ?>
    <div data-role="page" id="verpedi">
        
        <div data-role="header">
            <a href="crear.php" data-ajax="false" data-icon="back"><?php echo LANG_back ?></a>
            <h1><?php echo $tituloCurrent ?></h1>
                
        </div>
        
        <div data-role="content">
            
             <div><b><?php echo LANG_ordersDate  ?>:</b> <?php echo @date("d/m/Y");  ?></div> 
            <div><b><?php echo LANG_ordersClient  ?>:</b> <?php echo $cliente ?></div> 
            <div><b><?php echo LANG_ordersVendor  ?>:</b> <?php echo $vendedor ?></div> 
            
            <p></p>
           <ul id="items" data-role="listview">
             <?php while ($row = $tool->db_vector_nom($tool->result)) { ?>
            
            
                <li>
            <b><?php echo LANG_prod ?>:</b><?php echo $row["descripcion"] ?>
            <fieldset style="font-size: 12px">
                <b><?php echo LANG_cant ?>:</b> <?php echo $cant1 = getCantByIdProd($row["id"]); ?> <b><?php echo LANG_prodPrice ?></b> <?php echo $dataPref["moneda1"] ?>  <?php echo number_format($row["precio1"],2)  ?>   <b><?php echo LANG_ordersSubtotal ?>:</b> <?php echo $dataPref["moneda1"] ?>  <?php $pp = $row["precio1"]*$cant1; echo number_format($pp,2);  ?> 
                <?php $totalNeto+= $pp; if($row["civa"]) $totalIva+= $pp;  ?>
            </fieldset>
            </li>
            
             <?php } ?> 
            </lu>
            <hr>
            <div style="text-align: right"><?php echo LANG_ordersTotalProd ?> <?php echo $dataPref["moneda1"] ?>: <?php echo number_format($totalNeto,2) ?></div>
            <div style="text-align: right"><?php echo LANG_ordersTotalImp ?> <?php echo $dataPref["moneda1"] ?>: <?php $iva = $totalIva*($dataPref["iva"]/100); echo number_format($iva,2) ?></div>
            <div style="text-align: right;"><b><?php echo LANG_ordersTotal ?> <?php echo $dataPref["moneda1"] ?>: <?php  echo number_format($totalNeto+$iva,2) ?></b></div>
        </div>
        
        <button data-theme="b" id="ok" data-icon="check" name="ok" value="submit-value" data-inline="true"><?php echo LANG_ordersOk ?></button> 
        
   </div>   
  
</body>
</html>  
<?php $tool->cerrar(); ?>