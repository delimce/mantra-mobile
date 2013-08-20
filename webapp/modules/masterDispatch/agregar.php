<?php session_start();
////seguridad
$profile = "admin";
///titulo pagina y header

include("../../config/siteconfig.php");

?>
<body>


<script>
    function onSuccess() {
        $(location).attr('href', 'index.php');


    }


    $.validator.addMethod("not_blank_between", function () {

        var n = $('#r9user').val().split(" ");
        if (n.length > 1)
            return false;
        else
            return true;

    }, "<?php echo LANG_nologinBlank ?>");


     $("div[data-role*='page']").live('pageshow', function() {  


        $('#form1').validate({
            rules:{
                r9codigo:{
                    required:true
                },
                r9user:{
                    required:true,
                    not_blank_between:true
                },
                r9nombre:{
                    required:true
                },
                r9email:{
                    email:true
                }


            }
        });


        $("#submit").click(function () {


            ///validar

            if (!$("#form1").valid()) return false;

            if ($("#clave").val() != $("#clave2").val()) {
                alert('<?php echo LANG_noPass2 ?>');
                return false;
            }

            var formData = $("#form1").serialize();
             $('#submit').attr('disabled', 'disabled');

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


<?php $tituloCurrent = LANG_masterDispatch; ?>
<div data-role="page" id="agregar">

    <div data-role="header">
        <a href="index.php" data-icon="back"><?php echo LANG_back ?></a>

        <h1><?php echo $tituloCurrent ?></h1>
    </div>
    <div data-role="content">
        <div id="notification"><?php echo LANG_addNew ?></div>

        <form id="form1" action="index.php" data-transition="slide" method="post">

            <div data-role="fieldcontain">
                <label style="font-weight:bold" for="r9codigo"><?php echo LANG_prodCode ?></label>
                <input type="text" data-mini="true" id="r9codigo" name="r9codigo" maxlength="12"/>

                <label style="font-weight:bold" for="r9nombre"><?php echo LANG_cliName ?></label>
                <input type="text" data-mini="true" id="r9nombre" name="r9nombre"/>

                <label style="font-weight:bold" for="r9email"><?php echo LANG_email ?></label>
                <input type="email" data-mini="true" id="r9email" name="r9email"/>

                <label style="font-weight:bold" for="r9user"><?php echo LANG_venUser ?></label>
                <input type="text" data-mini="true" id="r9user" name="r9user"/>

                <label style="font-weight:bold" for="clave"><?php echo LANG_pass ?></label>
                <input type="password" data-mini="true" id="clave" name="clave"/>

                <label style="font-weight:bold" for="clave"><?php echo LANG_pass2 ?></label>
                <input type="password" data-mini="true" id="clave2" name="clave2"/>

                <p>
                    <input type="checkbox" name="r9activo" id="r9activo" value="1" class="custom" checked="checked"/>
                    <label for="r9activo"><?php echo LANG_disActive ?></label>


            </div>

            <button data-role="submit" data-theme="b" id="submit" value="submit-value"
                    data-inline="true"><?php echo LANG_save ?></button>

        </form>

    </div>
</div>


</body>
</html>   