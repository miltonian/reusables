<?php

namespace Reusables;

class Menu {

	public static function place( $file, $identifier )
	{
		View::place( "Menu", $file, $identifier );

	}

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "menu" );
	}

	public static function setInContainer( $file, $identifier )
	{
		return View::setInContainer( "Menu", $file, $identifier );
	}

	public static function make( $file, $identifier )
	{
		return Views::makeView( $file, $identifier, "menu" );
	}

	// public static function make( $file, $identifier )
	// {
	// 	Page::addAssetFile( "menu", $file );
	// 	$View = View::factory( 'reusables/views/menu/' . $file );
	// 	$data = Data::get( $identifier );
	// 	$View->set( 'menudict', $data );
	// 	$View->set( 'identifier', $identifier );
	// 	return $View->render();
	// }



	// FOR CUSTOM VIEWS

	public static function cplace( $file, $identifier )
	{
		View::cplace( "Menu", $file, $identifier );
	}

	public static function cset( $file, $identifier )
	{
		// exit( json_encode( [$file, $identifier] ) );
		Views::setDefaultViewInfo( $file, $identifier, "custom/menu" );
	}

}
