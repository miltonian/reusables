<?php 

namespace Reusables;

class Button {
	
	public static function place( $file, $identifier, $in_html=false )
	{
		if( $in_html ) {
			CustomCode::end();
		}

		Views::addToQueue( "Button", $file, $identifier );
		
		if( $in_html ) {
			CustomCode::start();
		}
	}

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "button" );
	}

	public static function setincontainer( $file, $identifier )
	{
		Data::addInfo( 'Button', 'viewtype', $identifier );
		Data::addInfo( $file, 'file', $identifier );
		Data::addInfo( $identifier, 'identifier', $identifier );

		Views::addEditableParts( $identifier );
		return Button::make( $file, $identifier );
	}

	public static function make( $file, $identifier )
	{

		return Views::makeView( $file, $identifier, "button" );
	}

	// public static function make( $file, $identifier )
	// {
	// 	ReusableClasses::addfile( "button", $file );
	// 	$View = View::factory( 'reusables/views/button/' . $file );
	// 	$data = Data::retrieveDataWithID( $identifier );
	// 	$View->set( 'buttondict', $data );
	// 	$View->set( 'identifier', $identifier );
	// 	return $View->render();
	// }

	// FOR CUSTOM VIEWS

	public static function cplace( $file, $identifier, $in_html=false )
	{
		if( $in_html ) {
			CustomCode::end();
		}

		Views::addToQueue( "Custom/Button", $file, $identifier );

		if( $in_html ) {
			CustomCode::start();
		}
	}

	public static function cset( $file, $identifier )
	{
		// exit( json_encode( [$file, $identifier] ) );
		Views::setDefaultViewInfo( $file, $identifier, "custom/button" );
	}

}