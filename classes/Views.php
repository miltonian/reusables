<?php 

namespace Reusables;


class Views {

	protected static $viewidentifiers = [];

	public static function setDefaultViewInfo( $file, $identifier, $viewtype, $tablenames=[] )
	{
		ReusableClasses::addfile( $viewtype, $file );
		$View = View::factory( 'reusables/views/' . $viewtype . '/' . $file );
		$data = Data::retrieveDataWithID( $identifier );
		$options = Data::retrieveOptionsWithID( $identifier );
		$options = ReusableClasses::convertViewActions( $options );
		
		$View->set( 'viewdict', $data );
		$View->set( 'viewoptions', $options );
		if( $viewtype == "section" ){
			$View->set( 'tablenames', $tablenames );
		}

		$View->set( 'identifier', $identifier );

		array_push( self::$viewidentifiers, $identifier );

		return $View->render();
	}

	public static function addView( $identifier )
	{
		array_push(Views::$viewidentifiers, $identifier);
	}

	public static function getViewIdentifiers()
	{
		return self::$viewidentifiers;
	}

}