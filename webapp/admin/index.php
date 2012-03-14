<?php session_start(); ?>
<?php include("../common/header.php"); ?>
<body>
<!--div de login-->
	<div data-role="page" id="login">
		<div data-role="header">
			<h1>Header</h1>
		</div>
		<div data-role="content">
                    
         <form id="form1" action="lobi.php"  data-transition="slide"  method="post">
            <p><?php echo LANG_adlogin ?></p>
            
             <label style="font-weight:bold" for="user"><?php echo LANG_user ?></label>
             <input type="text" id="user" name="user" value=""  />

			<label style="font-weight:bold" for="clave"><?php echo LANG_pass ?></label>
             <input type="password" id="clave" name="clave" value="" />
             
             
             <!--<p><a href="#lobi" data-role="button" data-transition="fade" data-icon="arrow-r" data-iconpos="right" data-inline="true">Aceptar</a></p>-->
           <button type="submit" data-theme="b" data-icon="check" data-iconpos="right" name="submit" value="submit-value" data-inline="true"><?php echo LANG_enter ?></button>
           </form>
           
		</div>
		<div data-role="footer">
			<h4>Footer</h4>
		</div>
	</div>
<!--div de login-->    
   
</body>
</html>