<?php session_start(); 
////seguridad
$profile = "admin,vendor";
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
			<p><h5><?php echo '<b>'.LANG_lobiText.'</b> '.$_SESSION['USERNAME'] ?></h5></p>
                <p><h5><?php echo '<b>'.LANG_profile.'</b> '.$_SESSION['PROFILE'] ?></h5></p>
                                   
            <div data-role="navbar" class="nav-glyphish-example">
				<ul>
                                     	<li><a id="misdatos" href="misDatos/index.php" data-ajax="false" data-transition="slide" data-icon="custom">Mis datos</a></li>
					<li><a id="buscarp" href="#list" data-role="button" data-transition="fade" data-icon="search" data-iconpos="right" data-inline="true">Buscar Pedido</a></li>
				</ul>
                
              <?php if($_SESSION['PROFILE']=="admin"){ ///solo para el admin ?>  
                                <ul>
					
					<li><a id="maestros" href="lobiMaster.php" data-role="button" data-transition="slide" data-icon="custom" data-iconpos="right" data-inline="true">Actualizar Maestros</a></li>
                                        <li><a id="inventario" href="stock/index.php" data-role="button" data-transition="slide" data-icon="custom" data-iconpos="right" data-inline="true">Manejar Inventario</a></li>
                                </ul>
                
             <?php }else{ ///parael vendedor ?>   
                
                                 <ul>
					
					<li><a id="crearp" href="lobiMaster.php" data-ajax="false" data-role="button" data-transition="slide" data-icon="custom" data-iconpos="right" data-inline="true">Nuevo Pedido</a></li>
                                        <li><a id="clientes" href="masterClient/index.php" data-role="button" data-transition="slide" data-icon="custom" data-iconpos="right" data-inline="true">Manejo de Clientes</a></li>
                                </ul>
                
              <?php } ?>                     
                
                                <ul>
					<li><a id="auditorias" href="#form" data-role="button" data-transition="fade" data-icon="custom" data-iconpos="right" data-inline="true">Auditorias</a></li>
					<li><a id="cerrar" href="controller/logout.php" data-ajax="false" data-role="button" data-transition="fade" data-icon="delete" data-iconpos="right" data-inline="true">Cerrar Sesión</a></li>
				</ul>
			</div>
            
            
		</div>
    
                <div data-role="footer">
			<h4><?php echo $_SESSION['CUENTA'] ?></h4>
		</div>
    
</div>
<!--LOBI-->


    
</body>
</html>