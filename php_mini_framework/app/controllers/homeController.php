<?php 
	
	class HomeController{
		
		function initialize(){

			View::setWidgets('sideBar','sidebar','No Configurado');
			View::setJS('home');
		}
		//vista predeterminada para este controlador
		function index(){

			$this->message = "Este mensaje es cargado desde un Controlador";
			View::setTitle('Nav Demo - Inicio');
			View::set('home/welcome');				
		}
		//vista Contacto
		function contact(){
			
			View::setStyles('toastmessage/css/jquery.toastmessage',false);			
			View::setJS('toastmessage/jquery.toastmessage',false);
			View::setTitle("Contacto");
			View::set("home/contact");			
			View::setNavpath('Contacto');
		}
		//vista Bandas (Prueba orm)
		function orm(){
			$this->bands = Band::get(); 
			View::setJS('charisma/js/jquery.dataTables.min',false);
			View::setJS('charisma/js/pagination',false);			
			//if(is_null($this->bands)) return;
			View::setTitle("Carga de datos usando Eloquent");
			View::set("home/bands");			
			View::setNavpath('Prueba DB');
		}	
	}

?>