<?php	
	
	class GlobalController{

		public static function load(){
			/* aqui ejecutar los metodos que procesan la carga de datos no estaticos,a visualizar 
				en todas las vistas de la aplicacion, como por ejemplo un menu principal, un footer
			   que deban ser cargados desde una base de datos
			*/
			self::mainMenu();
		}
		//agregar los metodos necesarios...
		private static function mainMenu(){
			// para este ejemplo, no se realiza carga de datos
			View::setWidgets('topMenu','menu'/*,datos*/); //establecer menu principal
		}

	}
?>