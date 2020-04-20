<?php
//namespace kah\app\myConfig;

class Autoloader{
	public static function register()
	{
		
		ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
		$root = $_SERVER['DOCUMENT_ROOT'];
		$host = $_SERVER['HTTP_HOST'];

		define('HOST', 'http://'.$host.'/projet5/');
		define('ROOT', $root.'/projet5/');

		define('CONTROLLER', ROOT.'src/controller/');
		define('VIEW', ROOT.'src/view/');
		define('MODEL', ROOT.'src/model/');
		define('CORE', ROOT.'app/core/');

		define('ASSETS', HOST.'assets/');
		define('CSS', ASSETS.'css/');
        define('JS', ASSETS.'js/');
        define('IMG', ASSETS.'images/');
        
		spl_autoload_register(array(__CLASS__, 'autoload'));
	}


	public static function autoload($class)
	{
		if(file_exists(MODEL.$class.'.php'))
		{
			require_once (MODEL.$class.'.php');
		}else if(file_exists(VIEW.$class.'.php'))
		{
			require_once (VIEW.$class.'.php');
		}else if(file_exists(CONTROLLER.$class.'.php'))
		{
			require_once (CONTROLLER.$class.'.php');
		}
		else if(file_exists(CORE.$class.'.php'))
		{
			require_once (CORE.$class.'.php');
		}
		
    	
    }
 
}






/*class Autoloader{

    static function register(){
        spl_autoload_register(array(__CLASS__,'autoload'));
    }

    static function autoload($class){
        if (strpos($class, __NAMESPACE__. '\\' )  === 0){

            $class = str_replace(__NAMESPACE__.'\\', '',$class);
            $class = str_replace('\\', '/',$class);
            require 'class/'.$class.'.php';
        }
    }
}*/