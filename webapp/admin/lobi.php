<?php session_start(); ?>
<?php 
////seguridad
$profile = "admin";
///titulo pagina y header

include("../config/siteconfig.php");

$tituloCurrent = LANG_lobi;
?>
<body>

<!--LOBI-->

<div data-role="page" id="lobi">

		<div data-role="header">
			<h1><?php echo $tituloCurrent ?></h1>
		</div>
		<div data-role="content">
			<p><?php echo LANG_lobiText ?></p>
            
            <div data-role="navbar">
				<ul>
					<li><a href="misdatos/index.php"  data-role="button" data-transition="fade" data-icon="home" data-iconpos="right" data-inline="true">Mis datos</a></li>
					<li><a href="#list" data-role="button" data-transition="fade" data-icon="search" data-iconpos="right" data-inline="true">Buscar Pedido</a></li>
				</ul>
                <ul>
					<li><a href="#form" data-role="button" data-transition="fade" data-icon="info" data-iconpos="right" data-inline="true">Auditorias</a></li>
					<li><a href="#list" data-role="button" data-transition="fade" data-icon="grid" data-iconpos="right" data-inline="true">Actualizar Maestros</a></li>
				</ul>
                
                 <ul>
					<li><a href="#form" data-role="button" data-transition="fade" data-icon="gear" data-iconpos="right" data-inline="true">Manejar Inventario</a></li>
					<li><a href="controller/logout.php" data-ajax="false" data-role="button" data-transition="fade" data-icon="delete" data-iconpos="right" data-inline="true">Cerrar Sesión</a></li>
				</ul>
			</div>
            
            
		</div>
</div>
<!--LOBI-->


    
</body>
</html>