<?php session_start(); ?>
<?php 
////seguridad
$profile = "admin";
///titulo pagina y header

include("../../config/siteconfig.php");

$tituloCurrent = LANG_monitorVisit;
?>

<div data-role="page" id="lobi">
        
        <div data-role="header">
            
                        <a href="../lobi.php" data-icon="back"><?php echo LANG_back ?></a>
			<h1><?php echo $tituloCurrent ?></h1>
	</div>
    
        <div data-role="content">
			<p><?php echo LANG_monitorSelect ?></p>
    
                        
                        
                        <div data-role="navbar">
                                                            
                                 <ul>
					<li><a href="visit.php"  data-role="button" data-transition="slide" data-icon="grid" data-iconpos="right" data-inline="true"><?php echo LANG_monitorAccess ?></a></li>

				</ul>
                            
                              
                        </div>
                        
    
        </div>                
                        
    </div>
<!--LOBI-->


    
</body>
</html>