<?php 
	require_once _source.'db'._dsep.'eloquent'._dsep.'autoload.php';
	
	use Illuminate\Database\Capsule\Manager as Capsule;
	class Db{

		public static $conf;
		public static $capsule;
		public static $_db;
		// mensajes de error 
		public static $msg_err_access = "La página no se encuentra disponible por el momento. Intentélo más tarde!";
		public static $msg_err_sql = "Ha ocurrido un error inesperado.Por favor ejecute esta operación más tarde";

		public static function initialize(){
			self::$capsule = new Capsule;
			self::$capsule->addConnection(self::$conf);
			self::$capsule->bootEloquent(); 
			try{
				self::$_db = self::$capsule->getConnection();				
			}catch(PDOException $e){				
				self::$_db = NULL;				
			}
		}
	}
?>