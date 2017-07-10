<?php

namespace User;

class Profile {

	protected static $profiledata = array();

	public static function setUser( $data )
	{
		self::$profiledata['user'] = $data;
	}

	public static function getUser()
	{
		return self::$profiledata['user'];
	}

	public static function getUserId()
	{
		return self::$profiledata['user']['id'];
	}

	public static function setOtherUsers( $data )
	{
		self::$profiledata['otherusers'] = $data;
	}

	public static function getOtherUsers()
	{
		return self::$profiledata['otherusers'];
	}

}