<?php

namespace User;

class Session {

	// protected static $userdata = array();

	public static function manage()
	{
		if (session_status() == PHP_SESSION_NONE) {
		    session_start();
		}
	}

	public static function setUser( $data )
	{
		self::manage();
		$_SESSION['user'] = $data;
	}

	public static function getUser()
	{
		self::manage();
		return $_SESSION['user'];
	}

	public static function isLoggedIn()
	{

	}

	public static function logout()
	{
		
	}

}