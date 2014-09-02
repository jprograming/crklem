<?php
	
	$key = (isset($_POST['key'])) ? $_POST['key'] : NULL;
	$user = (isset($_POST['user'])) ? $_POST['user'] : NULL;	
	
	switch ($key) {
		case 'enter': //loguiarse
			$data = User::authenticate($user['email'],$user['pass']);			
			
			if(count($data) == 1){
				//setear la session				
				$data = $data[0];
				$data['controller'] = 'admin';
				Session::set($data,Security::snKey);
				$response = okResponse('Bienvenido a la Plataforma...',1,_base_url);				
			}
			else $response = okResponse('Email y/o Password Incorrectos.',2);				
			
			
		break;		
	}
 	echo json_encode($response);
?>