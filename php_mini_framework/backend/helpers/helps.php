<?php 

	function removeFile($fileName){

		if(file_exists($fileName)){
	 		unlink($fileName);
	 		return true;
	 	}return false;
	}

	function renameFile($fileName,$dir,$newName=NULL){

		$ext = end(explode('.',$fileName));
		if(is_null($newName)) $newName =  getStrUnique();		
		if(file_exists($dir.$fileName)){
			rename($dir.$fileName, $dir.$newName.".".$ext);
			return $newName.".".$ext;
		}
		return false;
	}

	function getStrUnique($length=NULL){

		$strUnique = md5(uniqid(microtime()));
		if(is_null($length)) $length = 10;
		$strUnique = substr($strUnique, 0,$length);
		return $strUnique;
	}

	function getDimensionsImg($img){

		$size = getimagesize($img);
		return array('width' => $size[0], 'height' => $size[1]);
	}

	function encrypt($str){
		return sha1(md5($str));
	} 

	function delAccents($str){

		$a = array('À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý','ß','à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ø','ù','ú','�»','ü','ý','ÿ','Ā','ā','Ă','ă','Ą','ą','Ć','ć','Ĉ','ĉ','Ċ','ċ','Č','č','Ď','ď','Đ','đ','Ē','ē','Ĕ','ĕ','Ė','ė','Ę','ę','Ě','ě','Ĝ','ĝ','Ğ','ğ','Ġ','ġ','Ģ','ģ','Ĥ','ĥ','Ħ','ħ','Ĩ','ĩ','Ī','ī','Ĭ','ĭ','Į','į','İ','ı','Ĳ','ĳ','Ĵ','ĵ','Ķ','ķ','Ĺ','ĺ','�»','ļ','Ľ','ľ','Ŀ','ŀ','Ł','ł','Ń','ń','Ņ','ņ','Ň','ň','ŉ','Ō','ō','Ŏ','ŏ','Ő','ő','Œ','œ','Ŕ','ŕ','Ŗ','ŗ','Ř','ř','Ś','ś','Ŝ','ŝ','Ş','ş','Š','š','Ţ','ţ','Ť','ť','Ŧ','ŧ','Ũ','ũ','Ū','ū','Ŭ','ŭ','Ů','ů','Ű','ű','Ų','ų','Ŵ','ŵ','Ŷ','ŷ','Ÿ','Ź','ź','�»','ż','Ž','ž','ſ','ƒ','Ơ','ơ','Ư','ư','Ǻ','�»','Ǽ','ǽ','Ǿ','ǿ');
		$b = array('A','A','A','A','A','A','AE','C','E','E','E','E','I','I','I','I','D','N','O','O','O','O','O','O','U','U','U','U','Y','s','a','a','a','a','a','a','ae','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y','A','a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','D','d','E','e','E','e','E','e','E','e','E','e','G','g','G','g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','IJ','ij','J','j','K','k','L','l','L','l','L','l','L','l','l','l','N','n','N','n','N','n','n','O','o','O','o','O','o','OE','oe','R','r','R','r','R','r','S','s','S','s','S','s','S','s','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Y','Z','z','Z','z','Z','z','s','f','O','o','U','u','A','a','I','i','O','o','U','u','A','a','AE','ae','O','o');
		return str_replace($a, $b, $str);
	}

	function delSpace($str){
		return str_replace(' ', '', $str);
	}

	function strClear($val){			
		if(is_string($val))return utf8_encode(htmlentities(trim($val)));			
	}

	function getIP() {

	    if (!empty($_SERVER['HTTP_CLIENT_IP']))
	        return $_SERVER['HTTP_CLIENT_IP'];		       
	    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
	        return $_SERVER['HTTP_X_FORWARDED_FOR'];		   
	    return $_SERVER['REMOTE_ADDR'];
	}

	function getBrowser() {

	   $user_agent=$_SERVER['HTTP_USER_AGENT'];
	   $browsers = array(
					'Opera' => 'Opera',
					'Mozilla Firefox'=> '(Firebird)|(Firefox)',
					'Google Chrome'=>'(Chrome)',
					'Galeon' => 'Galeon',
					'Mozilla'=>'Gecko',
					'MyIE'=>'MyIE',
					'Lynx' => 'Lynx',
					'Chrome'=>'Chrome',
					'Netscape' => '(CHROME/23\.0\.1271\.97)|(Mozilla/4\.75)|(Netscape6)|(Mozilla/4\.08)|(Mozilla/4\.5)|(Mozilla/4\.6)|(Mozilla/4\.79)',
					'Konqueror'=>'Konqueror',
					'Internet Explorer 7' => '(MSIE 7\.[0-9]+)',
					'Internet Explorer 6' => '(MSIE 6\.[0-9]+)',
					'Internet Explorer 5' => '(MSIE 5\.[0-9]+)',
					'Internet Explorer 4' => '(MSIE 4\.[0-9]+)',
		);
		foreach($browsers as $bw=>$pattern){
			if (eregi($pattern, $user_agent)) return $bw;
		}
		return "Desconocido";
	}
	//forzar descarga de archivos
	function forceDownload($dir,$file){

		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=\"$file\"\n");
		$fp=fopen("$dir", "r");
		fpassthru($fp);
	}
	
?>