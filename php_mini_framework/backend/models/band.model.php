<?php 

	class Band extends Illuminate\Database\Eloquent\Model {

		protected $table = 'tbbands';
		
		public static function get(){
			try{
				return Band::all();			
			}catch(PDOException $e){
				return NULL;
			}
		}
	}

?>