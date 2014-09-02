<?php 	
	
	class Field{

		public $name,$value;
		public $require,$type,$minlen,$maxlen,$toEqu;		

		public function initField($name,$value,$req=true,$params=NULL){

			$this->name = $name;
			$this->value = $value;
			$this->require = $req;
			$this->type = $params['type'];		
			$this->minlen = (isset($params['minlen'])) ? intval($params['minlen']) : NULL;
			$this->maxlen = (isset($params['maxlen'])) ? intval($params['maxlen']) : NULL;
			$this->toEqu = $params['toequ'];
			if(isset($params['dateCompare'])) $this->dateCompare = $params['dateCompare'];
			if(isset($params['minTo'])) $this->minTo = $params['minTo'];
			if(isset($params['range'])) $this->range = $params['range'];
		}

	}

?>