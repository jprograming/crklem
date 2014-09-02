<?php 
	class Security{

		const snKey = '_a66'; 
		public static $_ssn;

		public static function load($refresh){
			Session::start();
			self::$_ssn = Session::get(self::snKey);
			Session::prevLoginByAjax([
				'key'=>self::snKey,
				'mvc'=>$refresh,
				'login_controller'=>'public',
				'login_method'=>'login',
				'fileAjaxLogin'=>'postapp/login'
			]);
		}
	}
 ?>