<?php session_start();
////seguridad
$profile = "admin,dispatch";
///titulo pagina y header

include("../../config/siteconfig.php");

include_once 'controller/load.php';

?>


<script>

    /////funcion de carga lista de productos
    function listaproductos(idcatego) {

        $.ajax({
            type:"POST",
            url:"controller/listProd.php",
            data:({id:idcatego}),
            success:function (data) {

                $("#listaproductos").html(data);

                $("#totalprod").html('<?php echo LANG_totalReg  ?> ' + $("#listaproductos > li").size());

            },

            complete:function () {

                $('#listaproductos').listview('refresh');

            }

        })

    }


    ////accion jquery
    $(document).ready(function () {

        ////ejecuta funcion al cambiar la categoria
        $("#categoriap").live("change", function () {
            listaproductos($("#categoriap").val());


        });


    });


</script>

<?php $tituloCurrent = LANG_masterStock; ?>
<!--div de pagina-->
<div data-role="page" id="inventariop">
    <div data-role="header">
        <a href="../lobi.php" data-icon="back"><?php echo LANG_back ?></a>

        <h1><?php echo $tituloCurrent ?></h1>

    </div>
    <div data-role="content">

        <!--
          filtro por categorias
        -->
        <div>
            <label style="font-weight:bold" for="categoriap"><?php echo LANG_catProd ?></label>
            <?php echo $querycat; ?>
        </div>

        <p id="totalprod"><?php echo LANG_totalReg . $tool->getNreg(); ?></p>
        <ul id="listaproductos" data-role="listview" data-inset="true" data-filter="true">
            <?php while ($row = $tool->db_vector_nom($tool->result)) { ?>
            <li><a class="check" data-ajax="false" href="detalle.php?id=<?php echo $row["id"] ?>">

                <div style="color:blue"><?php echo $row["descripcion"] ?><br></div>
                <fieldset style="font-size: 12px">
                    <div style="<?php if ($row["cantidad"] <= 0) echo 'color: red'; ?>">
                        <b>cantidad:</b> <?php echo $row["cantidad"] ?></div>


                </fieldset>
            </a></li>

            <?php } ?>
        </ul>


    </div>

</div>
<!--div de login-->


</body>
</html>
<?php $tool->cerrar(); ?>