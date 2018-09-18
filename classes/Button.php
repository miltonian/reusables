<?php

namespace Reusables;

class Button {

	public static function place( $file, $identifier )
	{
		View::place( "Button", $file, $identifier );
	}

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "button" );
	}

	public static function setInContainer( $file, $identifier )
	{
		return View::setInContainer( "Button", $file, $identifier );
	}

	public static function make( $file, $identifier )
	{

		return Views::makeView( $file, $identifier, "button" );
	}

	// FOR CUSTOM VIEWS

	public static function cplace( $file, $identifier )
	{
		View::cplace( "Button", $file, $identifier );
	}

	public static function cset( $file, $identifier )
	{
		// exit( json_encode( [$file, $identifier] ) );
		Views::setDefaultViewInfo( $file, $identifier, "custom/button" );
	}

}
