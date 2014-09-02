<?php 
	//if(!checkProfile(1))return;	
	class AdminController{
	
		function initialize(){
			View::setWidgets('adminLeftMenu','left_menu');
			View::setStyles("toastmessage/css/jquery.toastmessage",false);
		    View::setJS("toastmessage/jquery.toastmessage",false);
			View::setJS('postapp/user');
		}

		function index(){
			
			$this->message = "Plataforma de Administración";
			View::setTitle('Plataforma de Administración - Inicio');
			View::set('public/welcome');
		}
		//vista crear usuario
		function createUser(){

			View::setTitle('Crear Usuario');
			View::set('admin/newuser');
			View::setNavpath('Crear Usuario');
		}
	}
?>