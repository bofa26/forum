<?php 

/**
 * 
 */
class Session
{

	function __construct()
	{
		session_start();
	}

	public function setSession(string $name, $value)
	{
		$_SESSION[$name] = $value;
	}

	public function getSession(string $name)
	{
		return $_SESSION[$name];
	}

	public function isSession($name)
	{
		if (isset($_SESSION[$name])) {
			return true;
		}
		return false;
	}
}