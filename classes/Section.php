<?php

namespace Reusables;

class Section {

	public static function place( $file, $identifier )
	{
		View::place( "Section", $file, $identifier );
	}

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "section" );
	}

	public static function setInContainer( $file, $identifier )
	{
		return View::setInContainer( "Section", $file, $identifier );
	}

	public static function make( $file, $identifier )
	{
		return Views::makeView( $file, $identifier, "section" );
	}



	// FOR CUSTOM VIEWS

	public static function cplace( $file, $identifier )
	{
		View::cplace( "Section", $file, $identifier );
	}

	public static function cset( $file, $identifier )
	{
		// exit( json_encode( [$file, $identifier] ) );
		Views::setDefaultViewInfo( $file, $identifier, "custom/section" );
	}

}
