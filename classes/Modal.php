<?php 

namespace Reusables;

class Modal {

	public static function place( $file, $identifier, $in_html=false )
	{
		$in_html = Page::inhtml();
		if( $in_html ) {
			CustomCode::end();
		}

		Views::addToQueue( "Modal", $file, $identifier );
		
		if( $in_html ) {
			CustomCode::start();
		}
	}

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "modal" );
	}

	public static function setincontainer( $file, $identifier )
	{
		Data::addInfo( 'Modal', 'viewtype', $identifier );
		Data::addInfo( $file, 'file', $identifier );
		Data::addInfo( $identifier, 'identifier', $identifier );

		Views::addEditableParts( $identifier );
		return Modal::make( $file, $identifier );
	}

	public static function make( $file, $identifier )
	{
		return Views::makeView( $file, $identifier, "modal" );
	}

	// public static function make( $file, $identifier )
	// {
	// 	$View = View::factory( 'reusables/views/modal/' . $file );
	// 	$data = Data::retrieveDataWithID( $identifier );
	// 	$View->set( 'modaldict', $data );
	// 	$View->set( 'identifier', $identifier );
	// 	return $View->render();
	// }


	// FOR CUSTOM VIEWS

	public static function cplace( $file, $identifier, $in_html=false )
	{
		$in_html = Page::inhtml();
		if( $in_html ) {
			CustomCode::end();
		}

		Views::addToQueue( "Custom/Modal", $file, $identifier );

		if( $in_html ) {
			CustomCode::start();
		}
	}

	public static function cset( $file, $identifier )
	{
		// exit( json_encode( [$file, $identifier] ) );
		Views::setDefaultViewInfo( $file, $identifier, "custom/modal" );
	}

}