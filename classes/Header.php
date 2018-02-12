<?php 

namespace Reusables;

class Header {


	public static function place( $file, $identifier )
	{
		Views::addToQueue( "Header", $file, $identifier );
	}

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "header" );
	}

	public static function setincontainer( $file, $identifier )
	{
		Views::addEditableParts( $identifier );
		return Header::make( $file, $identifier );
	}

	public static function make( $file, $identifier )
	{
		return Views::makeView( $file, $identifier, "header" );
	}
	// public static function make( $file, $identifier )
	// {
	// 	ReusableClasses::addfile( "header", $file );
	// 	$View = View::factory( 'reusables/views/header/' . $file );
	// 	$data = Data::retrieveDataWithID( $identifier );
	// 	$View->set( 'headerdict', $data );
	// 	$View->set( 'identifier', $identifier );
	// 	return $View->render();
	// }

}