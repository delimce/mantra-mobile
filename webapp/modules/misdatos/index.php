<?php session_start();
////seguridad
$profile = "admin,vendor,dispatch";
///titulo pagina y header

include("../../config/siteconfig.php");

include_once 'controller/load.php';

?>
<body>

<script>
    function onSuccess(data, status) {
        data = $.trim(data);

        $("#notification").text(data);
        $("#notification").css({color:"blue", fontWeight:"bold"});


    }


    $.validator.addMethod("not_blank_between", function () {

        var n = $('#r1user').val().split(" ");
        if (n.length > 1)
            return false;
        else
            return true;

    }, "<?php echo LANG_nologinBlank ?>");


    $(document).ready(function () {


        $('#form1').validate({
            rules:{
                r1nombre:{
                    required:true
                },
                r1user:{
                    required:true,
                    not_blank_between:true
                },
                clave:{
                    required:true
                },
                r1email:{
                    email:true
                }

            }
        });


        $("#submit").click(function () {


            if (!$("#form1").valid()) return false;

            if ($("#clave").val() != $("#clave2").val()) {
                alert('<?php echo LANG_noPass2 ?>');
                return false;
            }


            var formData = $("#form1").serialize();

            $.ajax({
                type:"POST",
                url:"controller/save.php",
                cache:false,
                data:formData,
                success:onSuccess
            });

            return false;
        });
    });
</script>

<!--misDatos-->
<?php $tituloCurrent = LANG_adminFields; ?>
<div data-role="page" id="midata">

    <div data-role="header">
        <a href="../lobi.php" data-icon="back"><?php echo LANG_back ?></a>

        <h1><?php echo $tituloCurrent ?></h1>
    </div>
    <div data-role="content">
        <div id="titulo2"><?php echo LANG_editFields ?></div>

        <form id="form1" method="post">

            <div data-role="fieldcontain">
                <label style="font-weight:bold" for="r1nombre"><?php echo LANG_name ?></label>
                <input type="text" data-mini="true" id="r1nombre" name="r1nombre"
                       value="<?php echo $datos["nombre"] ?>"/>

                <label style="font-weight:bold" for="r1email"><?php echo LANG_email ?></label>
                <input type="email" id="r1email" name="r1email" value="<?php echo $datos["email"] ?>">

                <label style="font-weight:bold" for="r1user"><?php echo LANG_user ?></label>
                <input type="text" data-mini="true" id="r1user" name="r1user" value="<?php echo $datos["user"] ?>"/>

                <label style="font-weight:bold" for="clave"><?php echo LANG_pass ?></label>
                <input type="password" data-mini="true" id="clave" name="clave" value="<?php echo $datos["pass"] ?>"/>

                <label style="font-weight:bold" for="clave"><?php echo LANG_pass2 ?></label>
                <input type="password" data-mini="true" id="clave2" name="clave2" value="<?php echo $datos["pass"] ?>"/>

                <p id="notification"></p>
            </div>

            <button data-role="submit" data-theme="b" id="submit" value="submit-value"
                    data-inline="true"><?php echo LANG_save ?></button>
        </form>

    </div>
</div>
<!--misDatos-->


</body>
</html>   
