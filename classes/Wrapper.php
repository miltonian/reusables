<?php 

namespace Reusables;

class Wrapper {

	// public static function make( $data, $children, $identifier )
	// {
	// 	$View = View::factory( 'reusables/views/wrapper/' . $file );
	// 	$View->set( 'wrapperdict', $data );
	// 	$View->set( 'children', $children );
	// 	$View->set( 'identifier', $identifier );

	// 	return $View->render();

	// 	Data::addData( $data, $identifier );
	// 	Views::setDefaultViewInfo( $file , $identifier, "wrapper" );
	// }

	public static function setwrapper1( $data, $children, $identifier )
	{
		// ReusableClasses::addfile( "wrapper", "wrapper_1" );
		// $View = View::factory( 'reusables/views/wrapper/wrapper_1' );
		// $View->set( 'wrapperdict', $data );
		// $View->set( 'children', $children );
		// $View->set( 'identifier', $identifier );
		
		// return $View->render();

		Data::addData( $data, $identifier );
		Views::setDefaultViewInfo( 'wrapper_1' , $identifier, "wrapper", [], $children );
	}

	public static function wrapper1( $data, $children, $identifier )
	{
		// ReusableClasses::addfile( "wrapper", "wrapper_1" );
		// $View = View::factory( 'reusables/views/wrapper/wrapper_1' );
		// $View->set( 'wrapperdict', $data );
		// $View->set( 'children', $children );
		// $View->set( 'identifier', $identifier );
		
		// return $View->render();

		Data::addData( $data, $identifier );
		return Views::makeView( 'wrapper_1', $identifier, 'wrapper', [], $children );

	}





	public static function place( $file, $data, $identifier )
	{
		$in_html = Page::inhtml();
		if( $in_html ) {
			CustomCode::end();
		}

		Views::addToQueue( "Wrapper", $file, $identifier, $data );

		if( $in_html ) {
			CustomCode::start();
		}
	}

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "wrapper" );
	}

	public static function make( $file, $identifier )
	{
		return Views::makeView( $file, $identifier, "wrapper" );
	}

	public static function cset( $file, $identifier )
	{
		// exit( json_encode( [$file, $identifier] ) );
		Views::setDefaultViewInfo( $file, $identifier, "custom/wrapper" );
	}

	public static function start( $identifier )
	{
		Wrapper::place( "wrapper_start", [], $identifier);
	}

	public static function end( $identifier )
	{
		Wrapper::place( "wrapper_end", [], $identifier);
	}

}


