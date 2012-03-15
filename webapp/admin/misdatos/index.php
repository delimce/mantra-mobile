<?php session_start(); ?>
<?php 
////seguridad
$profile = "admin";
///titulo pagina y header

include("../../config/siteconfig.php");

$tituloCurrent = LANG_lobi;
?>
<body>
 

<!--misDatos-->
<?php $tituloCurrent = LANG_adminFields; ?>
<div data-role="page" id="home"  data-add-back-btn="true" data-back-btn-text="<?php echo LANG_back ?>">

		<div data-role="header">
			<h1><?php echo $tituloCurrent ?></h1>
		</div>
		<div data-role="content">
			<p><?php echo LANG_lobiText ?></p>
            
          <a href="#prueba"  data-role="button" data-transition="fade" data-icon="home" data-iconpos="right" data-inline="true">Mis datos</a>
            
            
		</div>
</div>
<!--misDatos-->


    
</body>
</html>   
