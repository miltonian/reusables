<?php

namespace Reusables;

class CustomView {

	protected static $currentversion = null;

	public static function make( $file, $identifier )
	{
		// ReusableClasses::addfile( "CustomView", $file );
		$custompath = 'custom/views/';
		if( self::$currentversion ){
			$custompath = 'custom/' . self::$currentversion . '/views/';
		}
		ReusableClasses::addfile( "custom", $file );
		$View = View::factory( $custompath . $file );
		$data = Data::retrieveDataWithID( $identifier );
		$options = Data::retrieveOptionsWithID( $identifier );
		$View->set( 'viewdict', $data );
		$View->set( 'viewoptions', $options );
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
			$data_id = Data::getDefaultDataID( $dict );
		}else{
			$data_id = $dict['data_id'];
		}

		$default_tablename = Data::getDefaultTableNameWithID( $data_id );

		if( isset($dict['index'] ) ){
			$dict = Data::convertDataForArray( $data_id, $dict['index'] );
		}

		if( $viewtypedict ){
			return [ "data_id"=>$data_id, $viewtypedict=>$dict, "default_tablename"=>$default_tablename ];
		}else{
			return [ "data_id"=>$data_id, "viewdict"=>$dict, "default_tablename"=>$default_tablename ];
		}
	}

}