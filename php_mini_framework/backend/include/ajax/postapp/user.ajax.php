<?php
	
	$key = (isset($_POST['key'])) ? $_POST['key'] : NULL;
	$user = (isset($_POST['cont'])) ? $_POST['cont'] : NULL;	
	
	switch ($key) {
		case 'new': //loguiarse
			$response = okResponse('Probando...',1,_base_url);			
		break;		
	}
 	echo json_encode($response);
?>