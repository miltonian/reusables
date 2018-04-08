<?php 

namespace Reusables;

class Structure {

	public static function place( $file, $data, $identifier )
	{
		Views::addToQueue( "Structure", $file, $identifier, $data );
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


