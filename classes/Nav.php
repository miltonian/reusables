<?php 

namespace Reusables;

class Nav {

	public static function place( $file, $identifier, $in_html=false )
	{
		if( $in_html ) {
			CustomCode::end();
		}

		Views::addToQueue( "Nav", $file, $identifier );
		
		if( $in_html ) {
			CustomCode::start();
		}
	}

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "nav" );
	}


	public static function setincontainer( $file, $identifier )
	{
		Data::addInfo( 'Nav', 'viewtype', $identifier );
		Data::addInfo( $file, 'file', $identifier );
		Data::addInfo( $identifier, 'identifier', $identifier );

		Views::addEditableParts( $identifier );
		return Nav::make( $file, $identifier );
	}

	public static function make( $file, $identifier )
	{
		return Views::makeView( $file, $identifier, "nav" );
	}

	// public static function make( $file, $identifier )
	// {
	// 	ReusableClasses::addfile( "nav", $file );
	// 	$View = View::factory( 'reusables/views/nav/' . $file );
	// 	$data = Data::retrieveDataWithID( $identifier );
	// 	$View->set( 'navdict', $data );
	// 	$View->set( 'identifier', $identifier );
	// 	return $View->render();
	// }


	// FOR CUSTOM VIEWS

	public static function cplace( $file, $identifier, $in_html=false )
	{
		if( $in_html ) {
			CustomCode::end();
		}

		Views::addToQueue( "Custom/Nav", $file, $identifier );

		if( $in_html ) {
			CustomCode::start();
		}
	}

	public static function cset( $file, $identifier )
	{
		// exit( json_encode( [$file, $identifier] ) );
		Views::setDefaultViewInfo( $file, $identifier, "custom/nav" );
	}

}