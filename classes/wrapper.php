<?php /* FILE:    alexanderhamiltondev/classes/classes.php
-------- Author:  Alexander Hamilton (miltonian3@gmail.com)
-------- Date:    3/20/2015
-------- Purpose: Class to process database requests. Contains functionality for Loop server-side operations. */

namespace Reusables\Classes;

require_once 'View.php';
require_once 'classes.php';

$ReusableClasses = new ReusableClasses();


class Wrapper {

	public static function add( $file, $data, $children=null )
	{
		$View = View::factory( '../reusables/views/wrapper/' . $file );
		$View->set( 'children', $children );
		$View->set( 'wrapperdict', $data );
		return $View->render();
	}

	public static function wrapper1( $children )
	{
		// exit(json_encode($children));
		$View = View::factory( '../reusables/views/wrapper/wrapper_1' );
		$View->set( 'children', $children );
		return $View->render();
	}

}


