<?php
session_start();
////seguridad
$profile = "admin";
///titulo pagina y header

include("../../config/siteconfig.php");

//include_once 'controller/load.php';
?>
<body>


    <script>

        $("div[data-role*='page']").live('pageshow', function() {


            $('#form1').validate({
                rules: {
                    archivo: {required: true, accept: "csv|rcv|kfg"}

                },
                messages: {archivo: "<?= LANG_batchVal ?>"}

            });
        
        });
    </script>

    <?php $tituloCurrent = LANG_batchTittle; ?>
    <div data-role="page" id="pref">

        <div data-role="header">
            <a href="../lobi.php" data-icon="back"><?php echo LANG_back ?></a>
            <h1><?php echo $tituloCurrent ?></h1>
        </div>
        <div data-role="content">
            <div id="titulo2"><?php echo LANG_batchDesc ?></div>

             <form id="form1" method="post" data-ajax="false" enctype="multipart/form-data" action="proceso.php">


                <div data-role="fieldcontain">
                    <input type="file" name="archivo" id="archivo"/>
                </div>

                <button data-role="submit" data-theme="b" id="submit" value="submit-value" data-inline="true"><?php echo LANG_proccessit ?></button>
            </form>        

        </div>
    </div>


</body>
</html>   
