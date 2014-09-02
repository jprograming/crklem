<?php 

	class Config{		 	
		// PARAMETROS GLOBALES A CONFIGURAR
		public static $default_template = "template"; 
        public static $default_view = "index"; 
        public static $default_controller = "home";
		public static $dbconnection = true;
		public static $dbfile_config = "settingsDB";
		public static $protocol = "http";
        public static $global_controller = false;
        public static $session_use = false;
        // CONSTANTES PARA EL MANEJO DE ERRORES DE DIRECCIONAMIENTO       
		const default_view_error = "view_error";
		const default_template_error = "template_error";		
		// CONSTANTE QUE INDICA EL NOMBRE DE LA FUNCION QUE SE EJECUTARA PARA TODAS LAS VISTAS DE UN CONTROLADOR
		const function_name = "initialize";
		const controller_id = "Controller";
		
		public static function load($isRoot=true){						
			//CONFIGURACION DE DIRECCIONAMIENTO		
			$folder_public = "assets/";
			$folder_root = ($isRoot) ? _linkbase : dirname(_linkbase)."/";				
			define('_base_url',self::$protocol."://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT']._linkbase);
			define('_base_css',$folder_root.$folder_public."stylesheet/");
			define('_base_img',$folder_root.$folder_public."images/");
			define('_base_js',$folder_root.$folder_public."js/");
		    define('_vendor',$folder_root.$folder_public."vendor/"); 			 				
		}		

		public static function updateTemplate(){
			self::$default_template = _fdrview."templates"._dsep.self::$default_template.".php";
			if(!file_exists(self::$default_template)) 
				self::$default_template = _errors.self::default_template_error.".php";			
		}

        public static function getCurUrl(){
        	return self::$protocol."://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
        }

        public static function redirect($target){			
			header('Location:'._base_url.$target);		
		}
	}
?>