<?php session_start(); ?>
<?php 
////seguridad
$profile = "admin";
///titulo pagina y header

include("../config/siteconfig.php");

$tituloCurrent = LANG_masters;
?>
<body>

<!--LOBI-->

<div data-role="page" id="lobi" data-add-back-btn="true" data-back-btn-text="<?php echo LANG_back ?>">
        
        <div data-role="header">
			<h1><?php echo $tituloCurrent ?></h1>
	</div>
    
        <div data-role="content">
			<p><?php echo LANG_masterSelect ?></p>
    
                        
                        <div data-role="navbar">
                                 <ul>
					<li><a href="misdatos/index.php" data-ajax="false" data-role="button" data-transition="fade" data-icon="grid" data-iconpos="right" data-inline="true"><?php echo LANG_masterProducts ?></a></li>

				</ul>       
                        
                                <ul>
					<li><a href="misdatos/index.php" data-ajax="false" data-role="button" data-transition="fade" data-icon="grid" data-iconpos="right" data-inline="true"><?php echo LANG_masterVendor ?></a></li>

				</ul>
                            
                                <ul>
					<li><a href="misdatos/index.php" data-ajax="false" data-role="button" data-transition="fade" data-icon="grid" data-iconpos="right" data-inline="true"><?php echo LANG_masterClient ?></a></li>

				</ul>
                            
                                <ul>
					<li><a href="misdatos/index.php" data-ajax="false" data-role="button" data-transition="fade" data-icon="grid" data-iconpos="right" data-inline="true"><?php echo LANG_masterStock ?></a></li>

				</ul>
                        </div>
                        
    
        </div>                
                        
    </div>
<!--LOBI-->


    
</body>
</html>