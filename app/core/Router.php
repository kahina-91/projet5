<?php

namespace kah\core;

use kah\core\Request;
use kah\controller\Frontend;
use kah\controller\Backend;
use Exception;

class Router{
	private $request;
	
	private $routes = 
	[
		
					'home' 			 => ['controller' => 'Frontend', 'method' => 'home', 'vars' => 'id'],
					'trouver_nounou' => ['controller' => 'Frontend', 'method' => 'trouver_nounou', 'vars' => 'id'],
					'trouver_job'    => ['controller' => 'Frontend', 'method' => 'trouver_job'],
					'insertUser' 	 => ['controller' => 'Frontend', 'method' => 'insertUser'],
					'addComment'     => ['controller' => 'Frontend', 'method' => 'addComment'],
					'login'          => ['controller' => 'Frontend', 'method' => 'login'],
					'logout'         => ['controller' => 'Frontend', 'method' => 'logout'],
					'pageUser'       => ['controller' => 'Frontend', 'method' => 'pageUser'],
					'pageNounou'     => ['controller' => 'Frontend', 'method' => 'pageNounou'],
					'getUser'        => ['controller' => 'Frontend', 'method' => 'getUser'],
					'inscription' 	 => ['controller' => 'Frontend', 'method' => 'inscription'],
					'showMarkers'    => ['controller' => 'Frontend', 'method' => 'showMarkers'],
					'postuler'       => ['controller' => 'Frontend', 'method' => 'insertNounou'],
					'editProfil'     => ['controller' => 'Frontend', 'method' => 'editProfil'],

                    'insertLatLonNounou'  => ['controller' => 'Backend', 'method' => 'insertLatLonNounou'],
					'insertNounouValid'   => ['controller' => 'Backend', 'method' => 'insertNounouValid', 'vars' => 'id'],
					'deleteNounou'   	  => ['controller' => 'Backend',  'method' => 'deleteNounou'],
					'admin'               => ['controller' => 'Backend', 'method'  => 'getNounous', 'vars' => 'id'],
					'pageValidatNounou'   => ['controller' => 'Backend', 'method' => 'pageValidatNounou', 'vars' => 'id'],

					'page404'                 => ['controller' => 'ErrorPages', 'method' => 'page404', 'vars' => 'id'],

	];
	public function __construct()
	{
		
		(isset($_GET['r']) && $_GET['r']) ? $action = $_GET['r'] : $action = "home" ;
		$route = $this->getRoute($action);
		if(key_exists($route, $this->routes))
		{ 
			$controller = $this->routes[$route]['controller'];
			$method = $this->routes[$route]['method'];
			if(isset($this->routes[$route]['vars']))
			{
				$vars = explode('/', $this->routes[$route]['vars']);

			}else
			{
				$vars = [];
			}

			$params = $this->getParams($action, $vars);
			$request = new Request();
			$request->setRoute($route);
			$request->setParams($params);
			$request->setController($controller);
			$request->setMethod($method);

			

		}else
		{
			
			$request = new Request();
			$request->setRoute('404');
			$request->setParams(['message' => "cette page n'existe pas"]);
			$request->setController('ErrorPages');
			$request->setMethod('page404');
		}

		$this->request = $request;
	}

	public function render()
	{
		
		try
		{

			$request = $this->request;

			$controller = $request->getController();
			$method = $request->getMethod();
			
			$controller = 'kah\controller\\'.$controller;				
			$currentController = new $controller($request);
			$currentController->$method();
			
		}
		
		catch (Exception $e) {
			echo 'Exception reçue : ',  $e->getMessage(), "\n";
		}
	
	}

	public function getRoute($action)
	{
		
		$elements = explode('/', $action);
		return $elements[0];

	} 
	public function getParams ($action, $vars)
	{
		$params = [];
		$elements = explode('/', $action);
		unset($elements[0]);
		
		foreach ($vars as $key => $var)
		{
			if (isset($elements[$key+1])) 
			{
				$params[$var] = $elements[$key+1];
			}
		}
		if ($_POST)
		{
			foreach ($_POST as $key => $val) 
			{
				
				$params[$key] = $val;	
			}
			
		}
        return $params;
	}
}