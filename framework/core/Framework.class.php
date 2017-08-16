<?php

class Framework {

   public static function run($controller,$action) {

       self::init($controller,$action);

       self::load($controller);
       
       $d = self::dispatch($controller); 
       if ($d !== NULL) {
       		var_dump($d);
       }
   }


   // Initialization

private static function init($controller,$action) {

	    // Define path constants

	    define("DS", DIRECTORY_SEPARATOR);

	    define("ROOT", getcwd() . DS);

	    define("APP_PATH", ROOT . 'application' . DS);

	    define("FRAMEWORK_PATH", ROOT . "framework" . DS);

	    define("PUBLIC_PATH", ROOT . "public" . DS);

	    define("CONFIG_PATH", APP_PATH . "config" . DS);

	    define("CONTROLLER_PATH", APP_PATH . "controllers" . DS);

	    define("MODEL_PATH", APP_PATH . "models" . DS);

	    define("VIEW_PATH", APP_PATH . "views" . DS);

	    define("CORE_PATH", FRAMEWORK_PATH . "core" . DS);

	    define('DB_PATH', FRAMEWORK_PATH . "database" . DS);

	    define("LIB_PATH", FRAMEWORK_PATH . "libraries" . DS);

	    define("HELPER_PATH", FRAMEWORK_PATH . "helpers" . DS);

	    define("UPLOAD_PATH", PUBLIC_PATH . "uploads" . DS);


	    // Define platform, controller, action, for example:

	    // index.php?p=admin&c=Goods&a=add

	    define("PLATFORM", isset($_REQUEST['p']) ? $_REQUEST['p'] : 'admin');
	    
	    define("CONTROLLER", $controller === '' ? 'Index': $controller);

	    define("ACTION", $action === '' ? 'index': $action);


	    define("CURR_CONTROLLER_PATH", CONTROLLER_PATH . PLATFORM . DS);

	    define("CURR_VIEW_PATH", VIEW_PATH . PLATFORM . DS);

	    // Load core classes

	    require CORE_PATH . "Controller.class.php";

	    require CORE_PATH . "Loader.class.php";

	    require DB_PATH . "Mysql.class.php";

	    require CORE_PATH . "Model.class.php";


	    // Load configuration file
	    $GLOBALS['config'] = include CONFIG_PATH . "config.php";


	    // Start session

	    session_start();

	}


	// Autoloading

	private static function autoload(){
	    spl_autoload_register(array(__CLASS__,'load'));	
	}


	// Define a custom load method

	private static function load($classname){

	    // Here simply autoload app’s controller and model classes

	    if (strpos($classname, 'Controller') !== false){
	        // Controller
	        error_reporting(E_ALL);
			ini_set('display_errors', 1);
	        require_once CURR_CONTROLLER_PATH . "$classname.class.php";

	    } elseif (substr($classname, -5) == "Model"){

	        // Model
	        require_once  MODEL_PATH . "$classname.class.php";
	    }

	}


	// Routing and dispatching

	private static function dispatch($controller){

	    // Instantiate the controller class and call its action method

	    $controller_name = CONTROLLER;
		
	    $action_name = ACTION . "Action";
	   	
	    $controller = new $controller_name();
	    
	    $response = $controller->$action_name();

	    return $response;
	}

}