<?php

namespace Reusables\User;

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
		if( session_status() == PHP_SESSION_NONE ){
			return false; 
		}
		if( isset( $_SESSION['user'] ) ){
			return true;
		}else{
			return false;
		}
	}

	public static function logout()
	{
		
	}

}