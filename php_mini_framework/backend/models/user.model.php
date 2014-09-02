<?php 
	
	class User{		

		static function authenticate($email,$pass){

			return ($email == 'prueba@gmail.com' and $pass == '12345')
				? array(array('id'=>1,'name'=>'Pedro Perez','profileId'=>1,'avatar'=>'default_m.png')) : array();
		}
		
	}
?>