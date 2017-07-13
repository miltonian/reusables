<?php 

namespace Reusables;

class Wrapper {

	public static function make( $data, $children, $identifier )
	{
		$View = View::factory( 'reusables/views/wrapper/' . $file );
		$View->set( 'wrapperdict', $data );
		$View->set( 'children', $children );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

	public static function wrapper1( $data, $children, $identifier )
	{
		ReusableClasses::addfile( "wrapper", "wrapper_1" );
		$View = View::factory( 'reusables/views/wrapper/wrapper_1' );
		$View->set( 'wrapperdict', $data );
		$View->set( 'children', $children );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}


