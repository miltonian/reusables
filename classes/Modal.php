<?php

namespace Reusables;

class Modal {

	public static function place( $file, $identifier )
	{
		View::place( "Modal", $file, $identifier );
	}

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "modal" );
	}

	public static function setInContainer( $file, $identifier )
	{
		return View::setInContainer( "Modal", $file, $identifier );
	}

	public static function make( $file, $identifier )
	{
		return Views::makeView( $file, $identifier, "modal" );
	}

	// public static function make( $file, $identifier )
	// {
	// 	$View = View::factory( 'reusables/views/modal/' . $file );
	// 	$data = Data::get( $identifier );
	// 	$View->set( 'modaldict', $data );
	// 	$View->set( 'identifier', $identifier );
	// 	return $View->render();
	// }


	public static function start( $identifier )
	{
		Structure::start($identifier . "_outer_structure", "modal_background");
        	Wrapper::start($identifier . "_wrapper");
	        	// Structure::start($identifier . "_inner_structure", "main_with_hidden");
        	Structure::start($identifier, "main_with_hidden");
	}

	public static function end( $identifier )
	{
				// Structure::end($identifier . "_inner_structure", "main_with_hidden");
				Structure::end($identifier, "main_with_hidden");
	        Wrapper::end($identifier . "_wrapper");
        Structure::end($identifier . "_outer_structure", "modal_background");
	}








	// FOR CUSTOM VIEWS

	public static function cplace( $file, $identifier )
	{
		View::cplace( "Modal", $file, $identifier );
	}

	public static function cset( $file, $identifier )
	{
		// exit( json_encode( [$file, $identifier] ) );
		Views::setDefaultViewInfo( $file, $identifier, "custom/modal" );
	}

}
