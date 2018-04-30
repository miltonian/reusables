<?php 

namespace Reusables;

class Structure {

	public static function place( $file, $data, $identifier )
	{
		$in_html = Page::inhtml();
		if( $in_html ) {
			CustomCode::end();
		}

		Views::addToQueue( "Structure", $file, $identifier, $data );

		if( $in_html ) {
			CustomCode::start();
		}
	}

	public static function set( $file, $data, $identifier )
	{
		
		Data::addData( $data, $identifier );
		Views::setDefaultViewInfo( $file , $identifier, "structure" );

	}

	public static function make( $file, $data, $identifier )
	{
		
		Data::addData( $data, $identifier );
		return Views::makeView( $file, $identifier, "structure" );

	}

	public static function start( $identifier, $file )
	{
		// Structure::place( "modal_background_start", [], $identifier);
		Structure::place( $file . "_start", [], $identifier);
	}

	public static function end( $identifier, $file )
	{
		// Structure::place( "modal_background_end", [], $identifier);
		Structure::place( $file . "_end", [], $identifier);
	}


	// FOR CUSTOM VIEWS

	public static function cplace( $file, $identifier, $in_html=false )
	{
		if( $in_html ) {
			CustomCode::end();
		}

		Views::addToQueue( "Custom/Structure", $file, $identifier );

		if( $in_html ) {
			CustomCode::start();
		}
	}

	public static function cset( $file, $identifier )
	{
		// exit( json_encode( [$file, $identifier] ) );
		Views::setDefaultViewInfo( $file, $identifier, "custom/structure" );
	}

}


