<?php 

	class Session{

		public static function start(){
			session_start();
		}

		public static function set($data,$key){			
			$_SESSION[$key] = $data;
		}

		public static function destroy($key=NULL){
			if(is_null($key)){
				setcookie (session_id(), "", time() - 3600);
				session_destroy();
				session_write_close();
			}else{
				if(isset($_SESSION[$key]))unset($_SESSION[$key]);
			}
		}

		public static function get($key){
			return (isset($_SESSION[$key])) ? $_SESSION[$key] : NULL;
		}

		public static function prevLoginByAjax(array $args){
			$session = self::get($args['key']); 
			if(is_null($session)){
				if($args['mvc']){
					if(Config::getCurUrl() == _base_url){ 					
						Config::$default_controller = $args['login_controller'];
						Config::$default_view = $args['login_method'];
					}else Config::redirect("");
				}
				else{
					if($_REQUEST['path'] != $args['fileAjaxLogin']){
						echo json_encode(errorResponse('Session not found!',_base_url));
						exit;
					}
				}
			}else{
				if($args['mvc'] and isset($session['controller'])) 
					Config::$default_controller = $session['controller'];				
			}

		}
	}
?>