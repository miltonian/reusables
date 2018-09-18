<?php

namespace Reusables;

class Header {


	public static function place( $file, $identifier )
	{
		View::place( "Header", $file, $identifier );
	}

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "header" );
	}

	public static function setInContainer( $file, $identifier )
	{
		return View::setInContainer( "Header", $file, $identifier );
	}

	public static function make( $file, $identifier )
	{
		return Views::makeView( $file, $identifier, "header" );
	}
	// public static function make( $file, $identifier )
	// {
	// 	Page::addAssetFile( "header", $file );
	// 	$View = View::factory( 'reusables/views/header/' . $file );
	// 	$data = Data::get( $identifier );
	// 	$View->set( 'headerdict', $data );
	// 	$View->set( 'identifier', $identifier );
	// 	return $View->render();
	// }


	// FOR CUSTOM VIEWS

	public static function cplace( $file, $identifier )
	{
		View::cplace( "Header", $file, $identifier );
	}

	public static function cset( $file, $identifier )
	{
		// exit( json_encode( [$file, $identifier] ) );
		Views::setDefaultViewInfo( $file, $identifier, "custom/header" );
	}

}
