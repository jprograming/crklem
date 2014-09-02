<?php 
	class Loads{
		
		// autocarga de modelos
		public static function autoload_model(){			
			spl_autoload_register(function($model){
				$file = _model.strtolower($model).".model.php";
				if(file_exists($file)) require_once $file;		
			});
		}
		// cargar libreria
		public static function library($library,$className=NULL){
			return self::file($library,_libs,$className);
		}
		//cargar helper
		public static function helper($helper){
			return self::file($helper,_help,NULL);
		}
		// cargar script php
		public static function script($scriptName,$className=NULL){
			return self::file($scriptName,_phpscript,$className);
		}
		
		private static function file($fileName,$dir,$className){
			$file = $dir.$fileName.".php";
			if(file_exists($file)){
				require_once $file;
				return (!is_null($className)) ? new $className : NULL;
			}
			return NULL;
		}
	}
		
?>