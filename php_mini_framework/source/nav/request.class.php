<?php 
	
	class Request{

		private $file;
		private $method;
		private $args;
		private $num_args;

		public function capture(){

			if(isset($_GET['url'])){
				$url = $_GET['url'];
				$url = filter_input(INPUT_GET, 'url',FILTER_SANITIZE_URL);
				$url = explode('/', $url);
				$url = array_filter($url);
				$this->file = strtolower(array_shift($url));				
				$this->method = array_shift($url);
				$this->args = $url;		
				$this->num_args = count($this->args);		
			}else $this->file = Config::$default_controller;				
			
			if(is_null($this->method)) $this->method = Config::$default_view;						
		}

		public function getStringArgs(){
			$char = ",";
			for($i=0,$len=count($this->args);$i<$len;$i++){
				if($i == $len-1) $char = NULL;
				$out.="'".htmlspecialchars($this->args[$i],ENT_QUOTES)."'".$char;
			}
			return $out;
		}
		public function getFile(){ return $this->file;}
		public function getMethod(){ return $this->method;}
		public function getArgs(){ return $this->args;}
		public function getNumArgs(){ return $this->num_args;}
	}

?>