<?php session_start();
////seguridad
$profile = "admin,dispatch";
///titulo pagina y header

include("../../config/siteconfig.php");

include_once('controller/loadUnit.php'); ///unidades
include_once('controller/loadCat.php');  ///categorias

?>
<body>
 
    
    <script>
        
        
        //////funcion para el calculo del precio sugerido
        function precioSugerido(precio,cant,idcatego){
            
            
                        
         var cat =  $.ajax({
                    type: "POST",
                    url: "controller/montoCatego.php",
                    data: ({id: idcatego}) ,
                    async: false
                   
                }).responseText;
            
            
            var valor = (precio/cant) + ((precio/cant) * (cat/100));
            
            
            return valor.toFixed(2);
            
        }        
        
        
        
        function onSuccess()
        {
               $(location).attr('href','index.php');
          
           
        }
 
 
        /////acciones jquery
         $("div[data-role*='page']").live('pageshow', function() {  
            
            
             ///validar
            
            $('#form1').validate({
                rules : {
                        r9codigo : {
                        required : true
                    },
                        r9descripcion :  {
                        required : true
                    },
                        r9precio1 :  {
                        required : true,
                        number: true
                    },
                        r9unidad_cant :  {
                        required : true,
                        digits : true,
                        min : 1
                    },
                        categoriap :  {
                        required : true,
                        min : 1
                    }
                     
                }
            });
            
            
            
            
            ///////EVENTOS PARA EL CALCULO DE PRECIO SUGERIDO
            ////ejecuta funcion al cambiar el precio
            $("#r9precio1").live("change" , function() {
                $("#r9precio3").val(precioSugerido($("#r9precio1").val(),$("#r9unidad_cant").val(),$("#categoriap").val()));
               
            });
            
            ////ejecuta funcion al cambiar las unidades
             $("#r9unidad_cant").live("change" , function() {
                $("#r9precio3").val(precioSugerido($("#r9precio1").val(),$("#r9unidad_cant").val(),$("#categoriap").val())); 
            });
            
            ////ejecuta funcion al cambiar la categoria
            $("#categoriap").change(function() {
                $("#r9precio3").val(precioSugerido($("#r9precio1").val(),$("#r9unidad_cant").val(),$("#categoriap").val()));
            });
                        //////////////////////////////////////////////
            
                    
            
            $("#submit").click(function(){
                 
                 
                 if(!$("#form1").valid()) return false; 
                  $('#submit').attr('disabled', 'disabled');
                 
                 /////validando qe no se repita el codigo del prod
                 
                  var cod =  $.ajax({
                    type: "POST",
                    url: "controller/validarCodigo.php",
                    data: ({codigo: $("#r9codigo").val()}) ,
                    async: false
                   
                }).responseText;
                 
                 if(cod==1){
                     alert("<?php echo LANG_prodValCode ?>");
                     return false;
                 }
                 
                / /////guardando producto                
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
              <textarea id="r9descripcion" name="r9descripcion"> </textarea>

            
             <label style="font-weight:bold" for="r9precio1"><?php echo LANG_prodPrice.' '.$_SESSION['MONEDA1'] ?></label>
             <input type="text" data-mini="true" id="r9precio1" name="r9precio1"/>
             
<!--             <label style="font-weight:bold" for="r9precio2"><?php echo LANG_prodBuy.' '.$_SESSION['MONEDA1'] ?></label>
             <input type="text" data-mini="true" id="r9precio2" name="r9precio2"/>-->
             
             <label style="font-weight:bold" for="r9precio3"><?php echo LANG_prodSug.' '.$_SESSION['MONEDA1'] ?></label>
             <input type="text" data-mini="true" id="r9precio3" name="r9precio3"/>
             
              
             
               <label style="font-weight:bold" for="r9unidad_med"><?php echo LANG_prodUnit ?></label>             		
             <?php echo $tool->combo_db("r9unidad_med",$queryu,"titulo","id",$porDefecto,$seleccionado,false,LANG_prodValUnit,false,$desactivado); ?>
  
               <label style="font-weight:bold" for="r9unidad_cant"><?php echo LANG_units ?></label>
             <input type="text" data-mini="true" id="r9unidad_cant" name="r9unidad_cant" value="1"/>
                
              <label style="font-weight:bold" for="categoriap"><?php echo LANG_catProd ?></label>             		
             <?php echo $tool->combo_db("categoriap",$queryc,"nombre","id",$porDefectoc,$seleccionadoc,false,LANG_prodValCat,false,$desactivadoc); ?>

             
            <p>
                
                <input type="checkbox" name="r9paga_impuesto" id="r9paga_impuesto" value="1" class="custom" />
		<label for="r9paga_impuesto"><?php echo LANG_prodPay ?></label> 
                 
                
             <input type="checkbox" name="r9activo" id="r9activo" value="1" class="custom" checked="checked" />
		<label for="r9activo"><?php echo LANG_prodActive ?></label>  
                
                
             </div>
                
                 <button data-role="submit" data-theme="b" id="submit" value="submit-value" data-inline="true"><?php echo LANG_save ?></button>
            
            </form>        
              
		</div>
</div>


    
</body>
</html> 
<?php $tool->cerrar(); ?>