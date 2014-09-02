<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1" />
    <title><?php echo View::getTitle(); ?></title>
    <?php 
    	echo View::getLinkTag();
    	echo View::getScriptTag(); 
    ?>   
    
</head>
<body>
	<?php 
	  require_once Config::$default_template;
    ?>
</body>
</html>