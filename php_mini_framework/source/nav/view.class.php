<?php 

	class View{

		private static $title;
		private static $view;
		private static $link_tag = "";         
        private static $script_tag = "";
		private static $navpath;
		private static $widgets;

		public static function set($view){
    		self::$view = (!is_null($view) and file_exists(_fdrview.$view.".php")) ? _fdrview.$view.".php" : NULL;
        }

		public static function setTitle($title){ self::$title = $title;}

		public static function setStyles($href,$base=true,$media="all"){
			$base = ($base === true) ? _base_css : _vendor;
			self::$link_tag .= '<link type="text/css" rel="stylesheet" href="'.$base.$href.'.css" media="'.$media.'" />'."\n";
        }
        
        public static function setJS($src,$base=true){
        	$base = ($base === true) ? _base_js : _vendor;
			self::$script_tag .= '<script type="text/javascript" src="'.$base.$src.'.js" ></script>'."\n";
        }

        public static function setAppIcon($href){
        	self::$link_tag .= '<link rel="shortcut icon" href="'._base_img.$href.'.ico" />'."\n";
        }

        public static function setRemoteJS($url){
        	self::$script_tag .= '<script type="text/javascript" src="'.$url.'" ></script>'."\n";
        }

        public static function setRemoteStyles($url){
        	self::$link_tag .= '<link type="text/css" rel="stylesheet" href="'.$url.'" />'."\n";
        }

		public static function setNavPath($items){
			self::$navpath = (is_array($items) or is_string($items)) ? $items : NULL;
		}

		public static function setWidgets($filename,$key='left',$data=NULL){
			self::$widgets[$key] = array('target'=>_fdrview."widgets"._dsep.$filename.".php",'data'=>$data);
		}

		public static function getTitle(){
            return (!is_null(self::$title)) ? self::$title : "PAGE NOT FOUND";
        }
        public static function getLinkTag(){ return self::$link_tag; }
        public static function getScriptTag(){ return self::$script_tag; }
        public static function get(){  
        	return (!is_null(self::$view)) ? self::$view : _errors.Config::default_view_error.".php"; 
        }
        public static function getWidgets(){ return self::$widgets; }
        public static function getNavpath(){ return self::$navpath; }
	}

?>