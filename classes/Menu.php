<?php 

namespace Reusables;

class Menu {

	public static function place( $file, $identifier, $in_html=false )
	{
		if( $in_html ) {
			CustomCode::end();
		}

		Views::addToQueue( "Menu", $file, $identifier );
		
		if( $in_html ) {
			CustomCode::start();
		}
		
	}

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "menu" );
	}

	public static function setincontainer( $file, $identifier )
	{
		Data::addInfo( 'Menu', 'viewtype', $identifier );
		Data::addInfo( $file, 'file', $identifier );
		Data::addInfo( $identifier, 'identifier', $identifier );

		Views::addEditableParts( $identifier );
		return Menu::make( $file, $identifier );
	}

	public static function make( $file, $identifier )
	{
		return Views::makeView( $file, $identifier, "menu" );
	}

	// public static function make( $file, $identifier )
	// {
	// 	ReusableClasses::addfile( "menu", $file );
	// 	$View = View::factory( 'reusables/views/menu/' . $file );
	// 	$data = Data::retrieveDataWithID( $identifier );
	// 	$View->set( 'menudict', $data );
	// 	$View->set( 'identifier', $identifier );
	// 	return $View->render();
	// }



	// FOR CUSTOM VIEWS

	public static function cplace( $file, $identifier, $in_html=false )
	{
		if( $in_html ) {
			CustomCode::end();
		}

		Views::addToQueue( "Custom/Menu", $file, $identifier );

		if( $in_html ) {
			CustomCode::start();
		}
	}

	public static function cset( $file, $identifier )
	{
		// exit( json_encode( [$file, $identifier] ) );
		Views::setDefaultViewInfo( $file, $identifier, "custom/menu" );
	}

}