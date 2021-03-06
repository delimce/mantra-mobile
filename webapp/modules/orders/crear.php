<?php
session_start();
////seguridad
$profile = "vendor";
///titulo pagina y header

include("../../config/siteconfig.php");

include_once 'controller/loadData.php';
?>
<body>

    <script>

        //////funcion para ocultar botones
        function ocultar(cliId) {
            
            
       var prods = $("#items li:visible").length;
        
            if (cliId > 0)
                $("#agregarP").show();
            else
                $("#agregarP").hide();
            
            if(prods>0)
                 $("#continuaR").show();
             else
                  $("#continuaR").hide();

        }



        /////funcion de carga lista de productos
        function listaproductos(idcatego) {

            $("#cantstock").html('&nbsp;');
            $("#botones").hide();

            $.ajax({
                type: "POST",
                url: "controller/listProd.php",
                data: ({id: idcatego}),
                success: function(data) {
                    $("#listaproductos").html(data);
                }

            })

        }



        /////funcion de carga lista de productos
        function mostrarStock(idprod) {

            /////validando

            if (idprod == 0)
                $("#botones").hide();
            else
                $("#botones").show();


            $.ajax({
                type: "POST",
                url: "controller/getStock.php",
                data: ({id: idprod}),
                success: function(data) {
                    $("#cantstock").html(data);
                }

            })

        }



        /////funcion que setea el cliente
        function setClienteId(idcli) {

            if (idcli > 0) {
                $("#agregarP").show();
                //    $("#continuaR").show();
            } else {
                $("#agregarP").hide();
                //   $("#continuaR").hide();

            }

            $("#cantstock").html('&nbsp;');
            $("#botones").hide();

            if ($("#continuaR").show())
                $("#continuaR").hide();

            $.ajax({
                type: "POST",
                url: "controller/setClient.php",
                data: ({id: idcli}),
                success: function(data) {
                    $("#items").html(data);

                    var myselect = $("#categoriap");
                    myselect[0].selectedIndex = 0;
                    myselect.selectmenu('refresh');
                    $("#listaproductos").text('<?php echo LANG_SelectCatProd ?>');

                },
                complete: function() {
                    $('#items').listview('refresh');

                }
            })


        }



        ////accion jquery
        $("div[data-role*='page']").live('pageshow', function() {

            //$(document).ready(function() {

            ocultar($("#cliente_id").val());

            ///validar
            $("#form2").validate({
                rules: {
                    cantidad: {
                        required: true,
                        digits: true,
                        min: 1

                    }
                }

            })


            //////siguiente paso
            $("#next").click(function() {

                $(location).attr('href', 'viewOrder.php');

            });


            ////deshacer todo el pedido
            $("#deshacer").click(function() {

                var answer = confirm("<?php echo LANG_ordersUndoConfirm ?>")
                if (answer) {

                    $("#continuaR").hide(); ///oculto el boton de continuar

                    $.ajax({
                        type: "POST",
                        url: "controller/undoOrder.php",
                        cache: false,
                        success: function(data) {
                            $("#items").html(data);

                        },
                        complete: function() {
                            $('#items').listview('refresh');
                        }
                    });



                }

                return false;

            });



            ////borrar item

            $("#borrar").click(function() {

                var answer = confirm("<?php echo LANG_ordersDeleteItemConfirm ?>")
                if (answer) {



                    var formData = $("#form2").serialize();
                    $.ajax({
                        type: "POST",
                        url: "controller/deleteItem.php",
                        cache: false,
                        data: formData,
                        success: function(data) {

                            if (data == "")
                                $("#continuaR").hide();

                            $("#items").html(data);

                        },
                        complete: function() {
                            $('#items').listview('refresh');
                        }
                    });



                }

                return false;

            });



            ////añadir y editar cantidad

            $("#add").click(function() {


                ///validar

                if (!$("#form2").valid())
                    return false;

                var formData = $("#form2").serialize();

                $.ajax({
                    type: "POST",
                    url: "controller/addItem.php",
                    cache: false,
                    data: formData,
                    success: function(data) {
                        $("#items").html(data);
                        //  $("#items").append(data);
                    },
                    complete: function() {
                        $('#items').listview('refresh');
                    }
                });

                if ($("#continuaR").hide())
                    $("#continuaR").show();
                return false;
            });



            ////ejecuta funcion al cambiar la categoria
            $("#categoriap").change(function() {
                listaproductos($("#categoriap").val());

            });

            ////ejecuta funcion al cambiar el cliente
            $("#cliente_id").change(function() {
                setClienteId($("#cliente_id").val());
            });


        });

    </script>




    <?php $tituloCurrent = LANG_ordersNew; ?>
    <div data-role="page" id="crearpedi">

        <div data-role="header">
            <a href="../lobi.php" data-icon="back"><?php echo LANG_back ?></a>
            <h1><?php echo $tituloCurrent ?></h1>
            <a id="continuaR" href="viewOrder.php" data-theme="b" data-ajax="false" data-icon="check"><?php echo LANG_ordersNext ?></a>    
        </div>
        <div data-role="content">

            <label style="font-weight:bold" for="cliente_id" class="select"><?php echo LANG_ordersClientSelect ?></label>

            <?php echo $tool->combo_db("cliente_id", $queryc, "nombre", "id", $porDefecto, $seleccionado, false, LANG_ordersNoClient, false, $desactivado); ?>

            <?php echo LANG_ordersItems ?>

            <div id ="ItemStock" data-role="fieldcontain">
                <ul id="items" data-role="listview">
                    <?php include_once("controller/printOrder.php"); ?>
                </ul>
            </div>  


            <!--                para añadir productos    -->

            <div id="agregarP" data-role="collapsible" data-content-theme="c">
                <h3><?php echo LANG_ordersAddProduct ?></h3>

                <form id="form2" data-transition="slide"  method="post"> 

                    <div data-role="fieldcontain">

                        <label style="font-weight:bold" class="select"><?php echo LANG_catProd ?></label>
                        <div>
                            <?php echo $tool->combo_db("categoriap", $querycp, "nombre", "id", $porDefecto2, $seleccionado2, false, '', false, $desactivado2, "-"); ?>
                        </div>

                        <label style="font-weight:bold" for="producto" class="select"><?php echo LANG_prod ?></label>
                        <div id="listaproductos">
                            <div id="producto"><?php echo LANG_SelectCatProd ?></div> 

                        </div>
                        <div>

                            <div id="cantidadprod">

                                <div id="cantstock">
                                    &nbsp;
                                </div>

                                <label style="font-weight:bold" class="select"><?php echo LANG_cant ?></label>
                                <div><input type="number" id="cantidad" name="cantidad"></div>
                            </div>

                            <div id="botones" style="display: none">  
                                <button data-role="submit" data-theme="a" id="add" name="add" value="submit-value" data-inline="true"><?php echo LANG_ordersAddEdit ?></button>
                                <button data-role="borrar" data-theme="a" id="borrar" name="borrar" value="submit-value" data-inline="true"><?php echo LANG_ordersDeleteItem ?></button>    
                            </div>
                        </div>

                    </div>  

                </form> 


            </div>


            <div>

<!--              <button data-role="next" data-theme="b" id="next" data-icon="check" name="next" value="submit-value" data-inline="true"><?php echo LANG_ordersNext ?></button>    -->
                <button data-role="deshacer" data-theme="b" id="deshacer" data-icon="delete" name="deshacer" value="submit-value" data-inline="true"><?php echo LANG_ordersUndo ?></button>     
            </div>

        </div>

    </div>

</body>
</html>   