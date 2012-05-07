<div id="imprimir">
    
      <button data-role="submit" data-theme="a" id="print2" name="print2" value="submit-value" data-inline="true"><?php echo LANG_ordersPrint ?></button>
      
      <?php 
      
        ////posibilidad de borrar el pedido una vez ya se halla decidido su destino
             if($_SESSION["PROFILE"]=="admin")
                 include_once 'borrar.php';
             
            
      
      ?>
      
      
</div>