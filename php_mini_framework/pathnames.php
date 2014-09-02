<?php 
	
	// ------- CONSTANTES PARA GESTION DE ARCHIVOS (include - require) --	
	define ("_dsep",DIRECTORY_SEPARATOR);
	define("_root", dirname(__FILE__)._dsep); // ruta completa de la raiz del host	 
	define("_assets", _root."assets"._dsep); 
	define("_img", _assets."images"._dsep);
	define("_errors", _assets."errors"._dsep);	
	define("_source",_root."source"._dsep);
	define("_backend", _root."backend"._dsep);
	define("_model",_backend."models"._dsep);	
	define("_include",_backend."include"._dsep);
	define("_ajax",_include."ajax"._dsep);
	define("_phpscript",_include."phpscripts"._dsep);
	define("_libs",_include."libs"._dsep); //librerias backend	
	define("_help",_backend."helpers"._dsep);
	define("_img_tmp",_root._img._dsep."temp"._dsep); //directorio temporal de imagenes
	
	define("_fdrbase",getcwd()._dsep); // ruta completa de la raiz de la app
	define("_fdrview",_fdrbase."app"._dsep."views"._dsep);
	define("_fdrcontroller",_fdrbase."app"._dsep."controllers"._dsep);
	define("_layout",_fdrview."layout.php");
	//----------------------------------------------------------
	define("_linkbase",dirname($_SERVER['PHP_SELF'])."/"); // link que apunta a la raiz de la app $folderbase
		
?>