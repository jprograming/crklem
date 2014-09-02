<?php
    require_once _source.'nav'._dsep.'config.class.php';
    require_once _source.'nav'._dsep.'view.class.php';
    require_once _fdrbase.'app'._dsep.'config'._dsep.'settings.php';    
    require_once _source.'nav'._dsep.'request.class.php';
    require_once _help.'globalHelper.php';
    require_once _source.'nav'._dsep.'loads.class.php';
		
	function load($isRoot=true){
		Config::load($isRoot);        
        Loads::autoload_model();
        if(!isset($_REQUEST['ajax'])) processMVC();
        else processAjax();
	}

	function processMVC(){
        sessionLoad();
        $request = new Request;
        $request->capture();
        $method = $request->getMethod();
        $controller = $request->getFile();        
        $file = _fdrcontroller.$controller.Config::controller_id.".php";
        if(file_exists($file)){            
            require_once $file;            
            $controller = ucfirst($controller).Config::controller_id;
            if(class_exists($controller)){
                dbLoad();
                globalController();            
                globalTagsHead();
                $obj = new $controller;
                if(method_exists($obj, Config::function_name))
                    call_user_func(array($obj, Config::function_name));    
                if($method != Config::function_name){ 
                    if(method_exists($obj, $method)){
                        $rm = new ReflectionMethod($controller, $method); 
                        $numparams = $rm->getNumberOfParameters();
                        $numreq = $rm->getNumberOfRequiredParameters();
                        if($numparams == $request->getNumArgs() or $request->getNumArgs() == $numreq){
                            if($numparams == 0 or $numreq == 0) call_user_func(array($obj, $method));
                            else{                           
                                $body = 'call_user_func(array($o, "'.$method.'"),'.$request->getStringArgs().');';
                                $fun = create_function('$o', $body);
                                $fun($obj);
                            }
                        }else View::set(NULL);                                         
                    }else View::set(NULL);                
                }else View::set(NULL); 
            }else Config::$default_template = NULL;  
            Config::updateTemplate();  
            require_once _layout;              
        }else require_once _errors."404.php";
    }

    function processAjax(){
        $ajax = ($_REQUEST['ajax'] == "true");
        if($ajax){           
            if(isset($_REQUEST['path'])){
                sessionLoad(false);
                $path = $_REQUEST['path'].".ajax.php";
                if(file_exists(_ajax.$path)){
                    dbLoad(false); 
                    require_once _ajax.$path;
                } 
            }
        }else echo json_encode(errorResponse('Fail Request'));
    }

    function dbLoad($is_mvc=true){
        if(Config::$dbconnection){
            require_once _source.'db'._dsep.'db.class.php';
            require_once _backend."dbconfig"._dsep.Config::$dbfile_config.".php";
            Db::initialize();  
            if(is_null(Db::$_db)){
                if($is_mvc) require_once _errors.'dbconnection_error.php';
                else echo json_encode(errorResponse(Db::$msg_err_access));
                exit;
            } 
        }
    }

    function globalController(){
        if(Config::$global_controller){
            require_once _fdrbase.'app'._dsep.'config'._dsep.'globalController.php';
            GlobalController::Load();
        }
    }

    function sessionLoad($is_mvc=true){
        if(Config::$session_use){
            require_once _source.'nav'._dsep.'session.class.php';
            require_once _fdrbase.'app'._dsep.'config'._dsep.'security.php';  
            Security::load($is_mvc);  
        }
    }
?>