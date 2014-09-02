<?php
	//estilos y js que se cargarán en todas las vistas de la página/aplicación
	function globalTagsHead(){    		
    	    	
    	View::setStyles("charisma/css/bootstrap-classic",false);	
    	View::setStyles("charisma/css/bootstrap-responsive",false);
		View::setStyles("charisma/css/charisma-app",false);
		View::setStyles("styles");
		View::setJS("jquery/jquery-1.7.1",false);
        //js para colapsar el menu en pantalla pequeña
		View::setJS("charisma/js/bootstrap-collapse",false);	
		View::setJS("nav");
    }
        
    //Config::$dbconnection = false;
    Config::$global_controller = true;  
    //Config::$dbfile_config = "settingsDBPostgres";
?>