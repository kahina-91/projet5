<?php

namespace kah\core;

use kah\core\Session;

Class Request
{

	private $route;
	private $params;
	private $controller;
	private $method;
	private $session;

	public function __construct()
    {
     
		$this->session = new session($_SESSION);
		
    }

	public function setRoute($route)
	{
		$this->route = $route;
		return $this;
	}

	public function getRoute()
	{
		return $this->route;
	}

	public function setController($controller)
	{
		
		$this->controller = $controller;
		return $this;
	}
	
	public function getSession()
	{

		return $this->session;

	}

	public function getController()
	{
		return $this->controller;
		
	}

	public function setMethod($method)
	{
		$this->method = $method;
		return $this;
	}

	public function getMethod()
	{
		return $this->method;
	}

	public function setParams($params)
	{
		$this->params = $params;
		return $this;
	}

	public function getParams()
	{
		return $this->params;
	}

	public function get($param, $addHtmSpecialChars = 1)
	{
		if(!isset($this->params[$param])) return null;
		if($addHtmSpecialChars) return htmlspecialchars($this->params[$param]);
		return $this->params[$param];
	}
}