<?php

namespace Reusables;

class CustomView {

	protected static $currentversion = null;

	public static function make( $file, $identifier )
	{
		// Page::addAssetFile( "CustomView", $file );
		$custompath = 'custom/views/';
		if( self::$currentversion ){
			$custompath = 'custom/' . self::$currentversion . '/views/';
		}
		Page::addAssetFile( "custom", $file );
		$View = View::factory( $custompath . $file );
		$data = Data::get( $identifier );
		$options = Options::get( $identifier );
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
			$dict = Convert::convertDataForArray( $data_id, $dict['index'] );
		}
		
		if( $viewtypedict ){
			return [ "data_id"=>$data_id, $viewtypedict=>$dict, "default_tablename"=>$default_tablename ];
		}else{
			return [ "data_id"=>$data_id, "viewdict"=>$dict, "default_tablename"=>$default_tablename ];
		}
	}

	// setContainerClass() Set the class names for the div that contains the rest of the view
	// These classes are required in order to become a reusable view
	public static function setContainerClass($file, $identifier)
    {
        echo " " . $identifier;
        echo " main";
        echo " " . basename($file, ".php");
        echo " viewtype_" . ReusableClasses::parentDir($file);
        echo " ";
    }

}