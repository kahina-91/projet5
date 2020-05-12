<?php
/**
 * 
 */
namespace kah\core;

class Session
{

	public function __construct($session)
	{
		
		$this->session = $session;

	}

	public function set($name, $value)
	{

		$_SESSION[$name] = $value;

	}

	public function get($name)
	{

		if(isset($_SESSION[$name]))
		{

			return $_SESSION[$name];

		}

	}

	public function show($name)
	{

		$key = $this->get($name);
		$this->remove($name);
		return $key;

	}

	public function remove($name)
	{

		unset($_SESSION[$name]);

	}

	public function stop()
	{

		session_destroy();

	}

	public function hasFlash()
	{
		if(isset($_SESSION['flash'])) return true;
		return false;
	}
	public function setFlash($message)
	{
		$_SESSION['flash'] = $message;
		return $this;
		
	}
	public function getFlash()
	{
		$message = null;
		if(isset($_SESSION['flash']))
		{ 	
			$message = $_SESSION['flash'];
			unset($_SESSION['flash']);
		}
		return $message;
	}
}