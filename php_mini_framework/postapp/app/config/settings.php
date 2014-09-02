<?php
	
	function globalTagsHead(){
		View::setStyles("charisma/css/bootstrap-classic",false);	
    	View::setStyles("charisma/css/bootstrap-responsive",false);
		View::setStyles("charisma/css/charisma-app",false);
		View::setStyles("styles");
		View::setStyles("postapp");
		View::setJS("jquery/jquery-1.7.1",false);	
		View::setJS("charisma/js/bootstrap-dropdown",false);						
		View::setJS("nav");
    }
    
   	Config::$session_use = true;

    Config::$default_controller = "admin";

   // Config::$default_view = "login";

    Config::$dbconnection = false;

    Config::$global_controller = true;
    
?>