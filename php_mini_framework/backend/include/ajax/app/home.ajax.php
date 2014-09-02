<?php
	
	//require_once _phpscript."functions.php"; 
	//require_once _phpscript."validate/validate.class.php";

	$key = (isset($_POST['key'])) ? $_POST['key'] : NULL;
	$user = (isset($_POST['user'])) ? $_POST['user'] : NULL;
	//$u = new User;
	//$v = new Validate;
	switch ($key) {
		case 'new': //nuevo contacto			
			$response = okResponse('Esto es solo una prueba..',1,_base_url);			
		break;		
	}
 	echo json_encode($response);
?>