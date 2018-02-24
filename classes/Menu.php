<?php 

namespace Reusables;

class Menu {

	public static function place( $file, $identifier )
	{
		Views::addToQueue( "Menu", $file, $identifier );
	}

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "menu" );
	}

	public static function make( $file, $identifier )
	{
		return Views::makeView( $file, $identifier, "menu" );
	}

	// public static function make( $file, $identifier )
	// {
	// 	ReusableClasses::addfile( "menu", $file );
	// 	$View = View::factory( 'reusables/views/menu/' . $file );
	// 	$data = Data::retrieveDataWithID( $identifier );
	// 	$View->set( 'menudict', $data );
	// 	$View->set( 'identifier', $identifier );
	// 	return $View->render();
	// }

}