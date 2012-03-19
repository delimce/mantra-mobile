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
                                   
            <div data-role="navbar" class="nav-glyphish-example">
				<ul>
                                     	<li><a id="misdatos" href="misdatos/index.php" data-ajax="false" data-transition="fade" data-icon="custom">Mis datos</a></li>
					<li><a href="#list" data-role="button" data-transition="fade" data-icon="search" data-iconpos="right" data-inline="true">Buscar Pedido</a></li>
				</ul>
                <ul>
					<li><a id="auditorias" href="#form" data-role="button" data-transition="fade" data-icon="custom" data-iconpos="right" data-inline="true">Auditorias</a></li>
					<li><a id="maestros" href="lobiMaster.php" data-role="button" data-transition="slide" data-icon="custom" data-iconpos="right" data-inline="true">Actualizar Maestros</a></li>
				</ul>
                
                 <ul>
					<li><a id="inventario" href="#form" data-role="button" data-transition="fade" data-icon="custom" data-iconpos="right" data-inline="true">Manejar Inventario</a></li>
					<li><a id="cerrar" href="controller/logout.php" data-ajax="false" data-role="button" data-transition="fade" data-icon="delete" data-iconpos="right" data-inline="true">Cerrar Sesión</a></li>
				</ul>
			</div>
            
            
		</div>
</div>
<!--LOBI-->


    
</body>
</html>