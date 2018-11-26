<?php

namespace Reusables;

class Gallery {

	public static function place( $file, $identifier )
	{
		View::place( "Gallery", $file, $identifier );
	}

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "gallery" );
	}

	public static function setInContainer( $file, $identifier )
	{
		return View::setInContainer( "Gallery", $file, $identifier );
	}

	public static function make( $file, $identifier )
	{
		return Views::makeView( $file, $identifier, "gallery" );
	}



	// FOR CUSTOM VIEWS

	public static function cplace( $file, $identifier )
	{
		View::cplace( "Gallery", $file, $identifier );
	}

	public static function cset( $file, $identifier )
	{
		// exit( json_encode( [$file, $identifier] ) );
		Views::setDefaultViewInfo( $file, $identifier, "custom/gallery" );
	}

}
