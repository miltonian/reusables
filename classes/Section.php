<?php 

namespace Reusables;

class Section {

	public static function place( $file, $identifier, $in_html=false )
	{
		if( $in_html ) {
			CustomCode::end();
		}

		Views::addToQueue( "Section", $file, $identifier );

		if( $in_html ) {
			CustomCode::start();
		}
	}

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "section" );
	}


	public static function setincontainer( $file, $identifier )
	{
		Data::addInfo( 'Section', 'viewtype', $identifier );
		Data::addInfo( $file, 'file', $identifier );
		Data::addInfo( $identifier, 'identifier', $identifier );

		Views::addEditableParts( $identifier );
		return Section::make( $file, $identifier );
	}

	public static function make( $file, $identifier )
	{
		return Views::makeView( $file, $identifier, "section" );
	}



	// FOR CUSTOM VIEWS

	public static function cplace( $file, $identifier, $in_html=false )
	{
		if( $in_html ) {
			CustomCode::end();
		}

		Views::addToQueue( "Custom/Section", $file, $identifier );

		if( $in_html ) {
			CustomCode::start();
		}
	}

	public static function cset( $file, $identifier )
	{
		// exit( json_encode( [$file, $identifier] ) );
		Views::setDefaultViewInfo( $file, $identifier, "custom/section" );
	}

}


