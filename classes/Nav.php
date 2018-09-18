<?php

namespace Reusables;

class Nav {

	public static function place( $file, $identifier )
	{
		View::place( "Nav", $file, $identifier );
	}

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "nav" );
	}


	public static function setInContainer( $file, $identifier )
	{
		return View::setInContainer( "Nav", $file, $identifier );
	}

	public static function make( $file, $identifier )
	{
		return Views::makeView( $file, $identifier, "nav" );
	}

	// public static function make( $file, $identifier )
	// {
	// 	Page::addAssetFile( "nav", $file );
	// 	$View = View::factory( 'reusables/views/nav/' . $file );
	// 	$data = Data::get( $identifier );
	// 	$View->set( 'navdict', $data );
	// 	$View->set( 'identifier', $identifier );
	// 	return $View->render();
	// }


	// FOR CUSTOM VIEWS

	public static function cplace( $file, $identifier )
	{
		View::cplace( "Nav", $file, $identifier );
	}

	public static function cset( $file, $identifier )
	{
		// exit( json_encode( [$file, $identifier] ) );
		Views::setDefaultViewInfo( $file, $identifier, "custom/nav" );
	}

}
