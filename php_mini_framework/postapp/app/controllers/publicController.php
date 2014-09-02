<?php
	
	class PublicController {

		function initialize(){
			
			View::setStyles("toastmessage/css/jquery.toastmessage",false);
		    View::setJS("toastmessage/jquery.toastmessage",false);
			View::setJS('postapp/public');
		}		

		function login(){			
			
			if(!is_null(Security::$_ssn)) Config::redirect("");
			View::setTitle("Plataforma de Administración - Ingresar");
			Config::$default_template = "login";
		}

		function logout(){

			Session::destroy();
			Config::redirect("");
		}
	}

?>