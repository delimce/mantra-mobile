<?php
session_start();
////seguridad
$profile = "admin";
///titulo pagina y header
include("../../config/siteconfig.php");
include 'controller/upload.php';
?>
<?php $tituloCurrent = LANG_batchTittle; ?>  

<body>
    <!--div de pagina-->
    <div data-role="page" id="proceso">
        <div data-role="header">
            <a href="index.php" data-ajax="false" data-icon="back"><?php echo LANG_back ?></a>
            <h1><?php echo $tituloCurrent ?></h1>

        </div>
        <div data-role="content">

            <p>
            <div style="color:blue;font-weight: bold"><?php echo LANG_batchTittle ?></div>
            <div id="titulo2"><?php echo LANG_batchProds ?></div>
            </p>

            <?php
            if ($subido) {


                $db = new FactoryDAO("db");
                $db->abrir_transaccion();

                ///valores
                foreach ($csv->data as $key => $row):

                    $nombre = trim($row[$ncampos[$nomProd]]);
                    $codigo = trim($row[$ncampos[$codprod]]);
                    $precio = trim($row[$ncampos[$precioP]]);


                    if (!empty($codigo)) {
                        ?>
                        <div class="ui-grid-b" style="font-size: 13px;font-weight: bold">
                            <div class="ui-block-a"><?php echo $nombre ?> </div>
                            <div class="ui-block-b"><?php echo $codigo ?> </div>
                            <div class="ui-block-c"><?php echo $precio ?></div>

                        </div>
                        <?php
                        $db->setProdPrice($codigo, $precio);
                    }

                endforeach;

                $db->cerrar_transaccion();
                $db->cerrar();
                ?>   

            <?php
            } else {

                echo LANG_batchError;
            }
            ?>   

        </div>



    </div>
    <!--div de login-->    

</body>
</html>
