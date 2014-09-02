<?php
	require_once 'messages.class.php';
	require_once 'field.class.php';

	class Validate extends Messages{
	
		private $status = 1;		
		private $field_error;
		private $response;
		private $list_func;

		public $all_fields;

		public function __construct(){

			$this->list_func = array('text'=>'isText',
									 'numeric'=>'is_numeric',
									 'email'=>'isEmail',
									 'cellphone'=>'isCellphone',
									 'phone'=>'isPhone',
									 'fax'=>'isFax',
									 'postalcode'=>'isPostalCode',
									 'int_positive'=>array('main'=>'isPositive',
									 					   'aux'=>'intval'),
									 'float_positive'=>array('main'=>'isPositive',
									 					     'aux'=>'floatval'),
									 'date'=>'isDate',
									 'url'=>'isUrl',
									 'alphanumeric'=>'isAlphanumeric',
									 'oneNumber'=>'containNumber'
									 );			
		}		

		public function setField($name,$value,$req = true,$params=NULL){

			
			$f = new Field;			
			
			$f->initField($name,$value,$req,$params);
		    $this->all_fields[] = $f;
		}

		public function validateForm(){

			for($i=0;$i<count($this->all_fields);$i++){
				
				$val = trim($this->all_fields[$i]->value);
				$fname = $this->all_fields[$i]->name;				
				if($this->all_fields[$i]->require){
					$r = $this->execFunc('isEmpty',$val,"true",$fname,$this->list_msg['req']);
					if($r) continue;
				}
				if(trim($val) == "") continue;
				if(isset($this->all_fields[$i]->type)){

					$type = $this->all_fields[$i]->type;					
					$func = $this->list_func[$type];
					if(is_array($func)){

						$func = $this->list_func[$type]['main'];
						$aux_func = $this->list_func[$type]['aux'];
					}
					$r = $this->execFunc($func,$val,"false",$fname,$this->list_msg[$type],$aux_func);
					if(!$r)continue;
				}
				
				if(isset($this->all_fields[$i]->minlen)){

					$min = $this->all_fields[$i]->minlen;
					$msg = sprintf($this->list_msg['minlen'],$min);
					$r = $this->execFunc('isMinLen',$val,"false",$fname,$msg,$min);	
					if(!$r)continue;			
				}
				//maximo numero de caracteres de una cadena				
				if(isset($this->all_fields[$i]->maxlen)){	
				    $max = $this->all_fields[$i]->maxlen;
					$msg = sprintf($this->list_msg['maxlen'],$max);				
					$r = $this->execFunc('isMaxLen',$val,"false",$fname,$msg,$max);	
					if(!$r)continue;				
				}
				//rangos de numeros
				if(isset($this->all_fields[$i]->range)){				   
				    $range = $this->all_fields[$i]->range;
					$msg = sprintf($this->list_msg['range'],$range['min'],$range['max']);				
					$r = $this->execFunc('isRange',$val,"false",$fname,$msg,$range);	
					if(!$r)continue;				
				}
				//numero menor o igual que ???
				if(isset($this->all_fields[$i]->minTo)){				   
				    $min = $this->all_fields[$i]->minTo;
					$msg = sprintf($this->list_msg['minTo'],$min);				
					$r = $this->execFunc('isMinTo',$val,"false",$fname,$msg,$min);	
					if(!$r)continue;				
				}
				if(isset($this->all_fields[$i]->toEqu)){
					$r = $this->execFunc('toEqual',$val,"false",$fname,
										 $this->list_msg['toequ'],$this->all_fields[$i]->toEqu);
					if(!$r)continue;
				}	
				if(isset($this->all_fields[$i]->dateCompare)){
					$r = $this->execFunc('isDateBigger',$val,"false",$fname,
										 $this->list_msg['dateCompare'],$this->all_fields[$i]->dateCompare);
					
				}				
			}
		}

		private function execFunc($func,$val,$operator="false",$field_name,
								  $msg,$aux_func = NULL){

			$operator = ($operator === "true");
			if(method_exists($this, $func)){
				$return = call_user_func(array($this, $func), $val, $aux_func);	
			}else{
				$return = call_user_func($func,$val);
			}
			if($return == $operator){
				$this->status = 0;
				$this->field_error[] =  array('fname' =>$field_name, 'message'=> $msg );
			}
			return $return;
		}

		private function setFieldError($fname,$msg){

			$this->status = 0;
			$this->field_error[] =  array('fname' => $fname, 'message'=> $msg );
		}

		public function isEmpty($value){
			return (trim($value) == "");
		}
		
		public function isEmail($email){

			if(is_string(filter_var($email, FILTER_VALIDATE_EMAIL))){
				$domain = end(explode('.',$email));
				return (strlen($domain) > 1 && strlen($domain) <= 4);
			}
			return false;
		}

		public function isCellphone($phone_number){
			
			if(!is_numeric($phone_number) || strlen($phone_number) != 10) return false;
			$phone_number = floatval($phone_number);			
			return ($phone_number >= 1001000001 && $phone_number <= 9999999999);			
		}

		public function isPhone($phone_number){

			if(!is_numeric($phone_number) || strlen($phone_number) < 3 || strlen($phone_number)>15) 
				return false; 
			return (floatval($phone_number) > -1);
		}

		public function isText($text)
		{
		    $pattern = "/^[a-zA-Z áéíóúAÉÍÓÚÑñ]+$/i"; 
		    return (preg_match($pattern, $text)) ? true : false;
		}

		public function isAlphanumeric($text){

			$pattern = '/^[a-z\d]+$/i';
			return (preg_match($pattern, $text)) ? true : false;
		}

		public function isDate($date){ // formato yy-mm-dd

			$date = explode('-',$date);
			if(count($date) < 3) return false;
			return checkdate(intval($date[1]),intval($date[2]),intval($date[0]));
		}

		public function containNumber($text){
			
			$pattern = '/^.*[0-9]+/';
			return (preg_match($pattern, $text)) ? true : false;
		}

		public function isFax($fax_number){

			if(!is_numeric($fax_number)) return false;
			$fax_number = "".$fax_number;
			return ((strlen($fax_number) >= 6  && strlen($fax_number) <= 12)
			       && !$this->isNullChar($code[0]));

		}

		public function isPostalCode($code){

			if(!is_numeric($code)) return false;
			$code = "".$code;
			return (strlen($code) <= 5 && ! $this->isNullChar($code[0]));
		}

		public function isNullChar($char){

			return($char == "0" || $char == "-");		
		}

		public function isPositive($number,$numeric_function){

			return (is_numeric($number) && !$this->isNullChar($number[0]) && 
				call_user_func($numeric_function,$number) > 0);
		}

		public function toEqual($str1,$str2){

			return (is_string($str1) && is_string($str2)) ? ($str1 == $str2) : false;
		}

		public function isMinLen($str,$min){
			
			return (strlen($str) >= intval($min));
		}

		public function isMaxLen($str,$max){

			return (strlen($str) <= intval($max));
		}
		public function isMinTo($value,$limit){
			return ($value <= $limit);
		}
		public function isRange($value,$range){
			
			return (is_numeric($value) and $value >= $range['min'] and $value <= $range['max']);
		}

		public function isUrl($url){

			return (is_string(filter_var($url,FILTER_VALIDATE_URL))) ? true : false;
		}

		function dateDiff($primera, $segunda) //formato yy-mm-dd
		{ 
			if(!$this->isDate($primera) || !$this->isDate($segunda)) return;
			$valoresPrimera = explode ("-", $primera);   
			$valoresSegunda = explode ("-", $segunda);
			$diaPrimera    = $valoresPrimera[2];  
			$mesPrimera  = $valoresPrimera[1];  
			$anyoPrimera   = $valoresPrimera[0];
			$diaSegunda   = $valoresSegunda[2];  
			$mesSegunda = $valoresSegunda[1];  
			$anyoSegunda  = $valoresSegunda[0];
			$diasPrimeraJuliano = gregoriantojd($mesPrimera, $diaPrimera, $anyoPrimera);  
			$diasSegundaJuliano = gregoriantojd($mesSegunda, $diaSegunda, $anyoSegunda);
			return  $diasPrimeraJuliano - $diasSegundaJuliano;
			//return  $diasSegundaJuliano - $diasPrimeraJuliano;
		}	

		public function isDateBigger($maxdate,$mindate){

			$lim = 1;
			if(!is_array($mindate)) $mindateVal = $mindate;
			else{
				$mindateVal = $mindate['val'];
				if(isset($mindate['num_days'])) $lim=$mindate['num_days'];
			}
			return ($this->dateDiff($maxdate,$mindateVal) >= $lim);
		}

		public function firstUpper($str){
			return ucfirst($str);
		}

		public function getResponse(){

			$this->response = array("status"=>$this->status, "field"=>$this->field_error);
			return $this->response;
		}

		public function getStatus(){
			return $this->status;
		}
	}
?>