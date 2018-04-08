<?php 

namespace Reusables;

class PostInternal {

	public static function place( $file, $identifier, $in_html=false )
	{
		if( $in_html ) {
			CustomCode::end();
		}

		Views::addToQueue( "PostInternal", $file, $identifier );
		
		if( $in_html ) {
			CustomCode::start();
		}
	}

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "postinternal" );
	}


	public static function setincontainer( $file, $identifier )
	{
		Data::addInfo( 'PostInternal', 'viewtype', $identifier );
		Data::addInfo( $file, 'file', $identifier );
		Data::addInfo( $identifier, 'identifier', $identifier );

		Views::addEditableParts( $identifier );
		return PostInternal::make( $file, $identifier );
	}

	public static function make( $file, $identifier )
	{
		return Views::makeView( $file, $identifier, "postinternal" );
	}

	// public static function make( $file, $identifier )
	// {
	// 	ReusableClasses::addfile( "postinternal", $file );
	// 	$View = View::factory( 'reusables/views/postinternal/' . $file );
	// 	$data = Data::retrieveDataWithID( $identifier );
	// 	$View->set( 'postdict', $data );
	// 	$View->set( 'identifier', $identifier );
	// 	return $View->render();
	// }

	// FOR CUSTOM VIEWS

	public static function cplace( $file, $identifier, $in_html=false )
	{
		if( $in_html ) {
			CustomCode::end();
		}

		Views::addToQueue( "Custom/PostInternal", $file, $identifier );

		if( $in_html ) {
			CustomCode::start();
		}
	}

	public static function cset( $file, $identifier )
	{
		// exit( json_encode( [$file, $identifier] ) );
		Views::setDefaultViewInfo( $file, $identifier, "custom/postinternal" );
	}

}


