<?php 

	function link_to(){
		$args = func_get_args(); 
		$num_args = count($args); 
		if($num_args < 2)return;
		$href = ($args[0] != "@base") ? _linkbase.$args[0] : _linkbase;			
		$text = $args[1];
		$options = "";
		for($i=2;$i<$num_args;$i++)	$options.=$args[$i].' ';
		return "\n".'<a href="'.$href.'" '.$options.' >'.$text.'</a>'."\n";
	}

	function img(){
		$args = func_get_args(); 
		$num_args = count($args);
		if($num_args == 0)return;
		$src = 	_base_img.$args[0];
	    $options = "";
	    for($i=1;$i<$num_args;$i++) $options .= $args[$i];
	    return '<img src="'.$src.'" '.$options.'/>'."\n" ;
	}

	function linker($target,$show=true){
		$linker = _linkbase.$target;
		if($show) echo $linker;
		else return $linker;
	}

	function errorResponse($message=NULL,$target=NULL){
		if(is_null($message)) $message = Db::$msg_err_sql;
		$res = array('status' => -1, 'message'=>$message );
		if(!is_null($target)) $res['target'] = $target;
		return $res;
	}	

	function okResponse($message,$status=1,$target=NULL){
		$res = array('status' => $status, 'message'=>$message );
		if(!is_null($target)) $res['target'] = $target;
		return $res;
	}
	
	function combo_option_tag($data,$value,$text,$defaultItem=true,$optsel=NULL){

		$items = '';
		if($defaultItem) $items .= '<option value="">Seleccione</option>';
		if(is_null($data) || count($data) == 0){
			return '<option value="">Ninguno</option>';				
		}
		for($i=0;$i<count($data);$i++){		
			$selected = NULL;	
			if(!is_null($optsel)){
				if($data[$i][$value] == $optsel){
					$selected = 'selected';
					$optsel = NULL; 
				}
			} 
			$items.='<option value="'.$data[$i][$value].'" '.$selected.'>'.$data[$i][$text].'</option>';
		}
		return $items;
	}	

	function putWidget($key){
		$wdgs = View::getWidgets();		
		if(file_exists($wdgs[$key]['target'])){
			$_data = $wdgs[$key]['data'];
			require_once $wdgs[$key]['target'];
		}		
	}

	function putNavpath(){
		
		$nav_path = View::getNavpath();		
		$span = '<span class="divider">/</span>';
		if(is_array($nav_path)){
			$len = count($nav_path);
			for ($i=0; $i < $len-1; $i++) { 
				$a = link_to($nav_path[$i]['href'],$nav_path[$i]['text']);				
				$walk.='<li>'.$a.$span.'</li>';
			}
			$last = $nav_path[$len-1]['text'];
		}else $last = $nav_path;
		$nav_path = array();		
		$nav_path['first'] = '<li>'.link_to('@base','Inicio').$span.'</li>';
		$nav_path['walk'] = $walk;
		$nav_path['last'] = '<li><a href="'.Config::getCurUrl().'">'.$last.'</a></li>';	
		require_once _fdrview."widgets"._dsep."navpath.php";
	}	

	function btnStart($size=NULL){		
		return link_to('@base','<i class="icon-chevron-left icon-white"></i> Inicio','class="btn btn-primary $size"');		
	}	

	function showDbErrMessage(){
		echo '<div class="alert alert-error">'.Db::$msg_err_sql.'</div>';
	}
?>