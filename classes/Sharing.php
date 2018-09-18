<?php

namespace Reusables;

class Sharing {

	public static function place( $file, $identifier )
	{
		View::place( "Sharing", $file, $identifier );
	}

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "slider" );
	}


	public static function setInContainer( $file, $identifier )
	{
		return View::setInContainer( "Sharing", $file, $identifier );
	}

	public static function make( $file, $identifier )
	{
		return Views::makeView( $file, $identifier, "slider" );
	}

	// public static function make( $file, $identifier )
	// {
	// 	Page::addAssetFile( "slider", $file );
	// 	$View = View::factory( 'reusables/views/slider/' . $file );
	// 	$data = Data::get( $identifier );
	// 	$View->set( 'sliderdict', $data );
	// 	$View->set( 'identifier', $identifier );
	// 	return $View->render();
	// }


	// FOR CUSTOM VIEWS

	public static function cplace( $file, $identifier )
	{
		View::cplace( "Sharing", $file, $identifier );
	}

	public static function cset( $file, $identifier )
	{
		// exit( json_encode( [$file, $identifier] ) );
		Views::setDefaultViewInfo( $file, $identifier, "custom/sharing" );
	}

}
