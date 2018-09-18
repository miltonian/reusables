<?php

namespace Reusables;

class PostInternal {

	public static function place( $file, $identifier )
	{
		View::place( "PostInternal", $file, $identifier );
	}

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "postinternal" );
	}


	public static function setInContainer( $file, $identifier )
	{
		return View::setInContainer( "PostInternal", $file, $identifier );
	}

	public static function make( $file, $identifier )
	{
		return Views::makeView( $file, $identifier, "postinternal" );
	}

	// public static function make( $file, $identifier )
	// {
	// 	Page::addAssetFile( "postinternal", $file );
	// 	$View = View::factory( 'reusables/views/postinternal/' . $file );
	// 	$data = Data::get( $identifier );
	// 	$View->set( 'postdict', $data );
	// 	$View->set( 'identifier', $identifier );
	// 	return $View->render();
	// }

	// FOR CUSTOM VIEWS

	public static function cplace( $file, $identifier )
	{
		View::cplace( "PostInternal", $file, $identifier );
	}

	public static function cset( $file, $identifier )
	{
		// exit( json_encode( [$file, $identifier] ) );
		Views::setDefaultViewInfo( $file, $identifier, "custom/postinternal" );
	}

}
