<?php

/*namespace kah\app\core;

use kah\app\core\Request;*/

class Router{
	private $request;
	private $routes = [

					'home' => ['controller' => 'Frontend', 'method' => 'home'],

					'trouver_nounou' => ['controller' => 'Frontend', 'method' => 'trouver_nounou'],

					'trouver_job' => ['controller' => 'Frontend', 'method' => 'trouver_job'],

					'insertUser' => ['controller' => 'Frontend', 'method' => 'insertUser'],

					'deleteNounou' => ['controller' => 'Backend', 'method' => 'deleteNounou'],

					'admin' => ['controller' => 'Backend', 'method' => 'getNounous'],

					'addComment' => ['controller' => 'Frontend', 'method' => 'addComment'], 

					'rechercheNounou' => ['controller' => 'Frontend', 'method' => 'getAgence'],

                    'getHours' => ['controller' => 'Frontend', 'method' => 'getHours'],

					'login' => ['controller' => 'Frontend', 'method' => 'login'],

					'logout' => ['controller' => 'Frontend', 'method' => 'logout'],

					'pageUser' => ['controller' => 'Frontend', 'method' => 'pageUser'],

					'getUser' => ['controller' => 'Frontend', 'method' => 'getUser'],
					
					'inscription' => ['controller' => 'frontend', 'method' => 'inscription'],

                    'showMarkers' => ['controller' => 'Frontend', 'method' => 'showMarkers'],

                    'postuler' => ['controller' => 'Frontend', 'method' => 'insertNounou'],

            		'nounouValidat' => ['controller' => 'backend', 'method' => 'nounouValidat'],
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

			$this->request = $request;

		}else
		{
			throw new Exception('Cette page n\'existe pas.');
		}
	}

	public function render()
	{

		try
		{

			$request = $this->request;

			$controller = $request->getController();
			$method = $request->getMethod();
			
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