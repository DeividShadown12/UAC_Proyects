<?php
    require_once("vista/layouts/header.php");
?>
<!-- HEADER -->   


<?php
	
	require_once("config.php");
	require_once("controlador/index.php");
	if(isset($_GET['m'])):    
    	if(method_exists("Controller",$_GET['m'])):
        	Controller::{$_GET['m']}();
    	endif;	
	endif;
?> 

<!-- FOOTER -->     
<?php
    require_once("vista/layouts/footer.php");
?>