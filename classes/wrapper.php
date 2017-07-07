<?php /* FILE:    alexanderhamiltondev/classes/classes.php
-------- Author:  Alexander Hamilton (miltonian3@gmail.com)
-------- Date:    3/20/2015
-------- Purpose: Class to process database requests. Contains functionality for Loop server-side operations. */

// namespace Reusables\Classes;

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


