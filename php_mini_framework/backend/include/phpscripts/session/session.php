<?php 

	function set_session($data){

		//setear el controlador por default
		$profile = intval($data['profileId']);
		if($profile == 1) $cont = 'admin';
		else if($profile == 2) $cont = 'segundoperfil';
		else $cont = 'tercerperfil';
		$data['controller'] = $cont;
		$_SESSION[sname] = $data;
	}

?>