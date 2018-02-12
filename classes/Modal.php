<?php 

namespace Reusables;

class Modal {

	public static function place( $file, $identifier )
	{
		Views::addToQueue( "Modal", $file, $identifier );
	}

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "modal" );
	}

	public static function setincontainer( $file, $identifier )
	{
		Views::addEditableParts( $identifier );
		return Modal::make( $file, $identifier );
	}

	public static function make( $file, $identifier )
	{
		return Views::makeView( $file, $identifier, "modal" );
	}

	// public static function make( $file, $identifier )
	// {
	// 	$View = View::factory( 'reusables/views/modal/' . $file );
	// 	$data = Data::retrieveDataWithID( $identifier );
	// 	$View->set( 'modaldict', $data );
	// 	$View->set( 'identifier', $identifier );
	// 	return $View->render();
	// }

}