<?php

namespace Reusables;

class Table {

	public static function place( $file, $identifier )
	{
		View::place( "Table", $file, $identifier );
	}

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "table" );
	}

	public static function setInContainer( $file, $identifier )
	{
		return View::setInContainer( "Table", $file, $identifier );
	}

	public static function make( $file, $identifier )
	{
		return Views::makeView( $file, $identifier, "table" );
	}

	// FOR CUSTOM VIEWS
	public static function cplace( $file, $identifier )
	{
		View::cplace( "Table", $file, $identifier );
	}

	public static function cset( $file, $identifier )
	{
		// exit( json_encode( [$file, $identifier] ) );
		Views::setDefaultViewInfo( $file, $identifier, "custom/table" );
	}

}
