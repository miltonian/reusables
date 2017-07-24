<?php

namespace Reusables;

class CustomView {

	protected static $currentversion = null;

	public static function make( $file, $data, $identifier )
	{
		// ReusableClasses::addfile( "CustomView", $file );
		$custompath = 'custom/views/';
		if( self::$currentversion ){
			$custompath = 'custom/' . self::$currentversion . '/views/';
		}
		ReusableClasses::addfile( "custom", $file );
		$View = View::factory( 'custom/6.0.0/views/' . $file );
		$View->set( 'customviewdict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

	public static function setCurrentVersion( $version )
	{
		self::$currentversion = $version;
	}

	public static function getCurrentVersion()
	{
		return self::$currentversion;
	}

	public static function makeFormVars( $dict, $viewtypedict=null )
	{
		if( !isset( $dict['data_id'] ) ){
			$data_id = \Reusables\Data::getDefaultDataID( $dict );
		}else{
			$data_id = $dict['data_id'];
		}

		$default_tablename = \Reusables\Data::getDefaultTableNameWithID( $data_id );

		if( isset($dict['index'] ) ){
			$dict = \Reusables\Data::convertDataForArray( $data_id, $dict['index'] );
		}

		if( $viewtypedict ){
			return [ "data_id"=>$data_id, $viewtypedict=>$dict, "default_tablename"=>$default_tablename ];
		}else{
			return [ "data_id"=>$data_id, "customviewdict"=>$dict, "default_tablename"=>$default_tablename ];
		}
	}

}