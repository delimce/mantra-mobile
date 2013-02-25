<?php session_start();
////seguridad
$profile = "admin";
///titulo pagina y header

include("../../config/siteconfig.php");
include_once('controller/loadData.php');
include_once('controller/loadUnit.php'); ///unidades
include_once('controller/loadCat.php'); ///categorias


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
        
        
        
        function onSuccess(data)
        {
            data = $.trim(data);
            
           $("#notification").text(data);
           $("#notification").css({color:"blue", fontWeight:"bold"});
           


           
        }
        
         
 
 
         $("div[data-role*='page']").live('pageshow', function() {  
            
            
            
            
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
            

            
             
            ///campo oculto de id
            $('#form1').append('<input type="hidden" name="id" id="id" value="<?php echo $id ?>" />');
           
           
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
                    }
                     
                }
            });
           
           
           
            $("#borrar").click(function(){
                
                     var answer = confirm("<?php echo LANG_confirmDelete ?>")
                    if (answer){
                        
                         
                        
                        var formData = $("#form1").serialize();
                         $.ajax({
                                type: "POST",
                                url: "controller/delete.php",
                                cache: false,
                                data: formData
                            });
                        
                        
                         $(location).attr('href','index.php');
                    }

                    return false;  
                      
            });
            
            
            
            $("#submit").click(function(){
                 
       
                if(!$("#form1").valid()) return false; 
                
                
                 /////validando qe no se repita el codigo del prod    
                  var cod =  $.ajax({
                    type: "POST",
                    url: "controller/validarCodigo.php",
                    data: ({codigo: $("#r9codigo").val(),id:<?php echo $id ?>} ) ,
                    async: false
                   
                }).responseText;
                 
                 if(cod==1){
                     alert("<?php echo LANG_prodValCode ?>");
                     return false;
                 }
                 
                / /////editando producto
                
                
                
       
                var formData = $("#form1").serialize();
 
                $.ajax({
                    type: "POST",
                    url: "controller/edit.php",
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
                        <a href="index.php" data-ajax="false" data-icon="back"><?php echo LANG_back ?></a>
			<h1><?php echo $tituloCurrent ?></h1>
		</div>
		<div data-role="content">
                    <div id="titulo2"><?php echo LANG_addEdit ?></div>
                        
            <form id="form1" action="index.php" data-transition="slide"  method="post">
            
                <div data-role="fieldcontain">
            <label style="font-weight:bold" for="r9codigo"><?php echo LANG_prodCode ?></label>
            <input type="text" data-mini="true" id="r9codigo" name="r9codigo" maxlength="12" value="<?php echo $datos['codigo']  ?>" />
        
             <label style="font-weight:bold" for="r9descripcion"><?php echo LANG_prodName ?></label>
             <input type="text" data-mini="true" id="r9descripcion" name="r9descripcion" value="<?php echo $datos['descripcion']  ?>" />

                          
             <label style="font-weight:bold" for="r9precio1"><?php echo LANG_prodPrice.' '.$_SESSION['MONEDA1'] ?></label>
             <input type="text" data-mini="true" id="r9precio1" name="r9precio1" value="<?php echo $datos['precio1']  ?>" />
           
                       
<!--             <label style="font-weight:bold" for="r9precio2"><?php echo LANG_prodBuy.' '.$_SESSION['MONEDA1'] ?></label>
             <input type="text" data-mini="true" id="r9precio2" name="r9precio2" value="<?php echo $datos['precio2']  ?>"/>-->
             
             <label style="font-weight:bold" for="r9precio3"><?php echo LANG_prodSug.' '.$_SESSION['MONEDA1'] ?></label>
             <input type="text" data-mini="true" id="r9precio3" name="r9precio3" value="<?php echo $datos['precio3']  ?>"/>
            
             
             <label style="font-weight:bold" for="r9unidad_med"><?php echo LANG_prodUnit ?></label>		
             <?php echo $tool->combo_db("r9unidad_med",$queryu,"titulo","id",$porDefecto,$seleccionado,false,LANG_prodValUnit,false,$desactivado); ?>

             <label style="font-weight:bold" for="r9unidad_cant"><?php echo LANG_units ?></label>
             <input type="text" data-mini="true" id="r9unidad_cant" name="r9unidad_cant" value="<?php echo $datos['unidad_cant']  ?>"/>
             
             
               
              <label style="font-weight:bold" for="categoriap"><?php echo LANG_catProd ?></label>             		
             <?php echo $tool->combo_db("categoriap",$queryc,"nombre","id",$porDefectoc,$seleccionadoc,false,LANG_prodValCat,false,$desactivadoc); ?>

             
             
             <p>
                 
                  
              <input type="checkbox" name="r9paga_impuesto" id="r9paga_impuesto" value="1" class="custom" <?php if($datos['paga_impuesto']==1) echo 'checked="checked"' ?>  />
		<label for="r9paga_impuesto"><?php echo LANG_prodPay ?></label> 
             
                 
                <input type="checkbox" name="r9activo" id="r9activo" value="1" class="custom" <?php if($datos['activo']==1) echo 'checked="checked"' ?>  />
		<label for="r9activo"><?php echo LANG_prodActive ?></label>  
                
                
                
                <div id="notification"></div>
             </div>
                
                 <button data-role="submit" data-theme="b" id="submit" value="submit-value" data-inline="true"><?php echo LANG_save ?></button>
                 <button data-role="borrar" data-theme="c" id="borrar" value="submit-value" data-inline="true"><?php echo LANG_deleteit ?></button>
            
            </form>        
              
		</div>
</div>

    
</body>
</html>   
<?php $tool->cerrar(); ?>