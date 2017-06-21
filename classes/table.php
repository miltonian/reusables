<?php /* FILE:    alexanderhamiltondev/classes/classes.php
-------- Author:  Alexander Hamilton (miltonian3@gmail.com)
-------- Date:    3/20/2015
-------- Purpose: Class to process database requests. Contains functionality for Loop server-side operations. */

namespace Reusables\Classes;

require_once 'View.php';
require_once 'MainClasses.php';

$ReusableClasses = new ReusableClasses();


class Table {

	public static function add( $file, $data )
	{
		$View = View::factory( '../reusables/views/table/' . $file );
		$View->set( 'tabledict', $data );
		return $View->render();
	}

	public static function make( $file, $data )
	{
		$View = View::factory( '../reusables/views/table/' . $file );
		$View->set( 'tabledict', $data );
		echo $View->render();
	}

}


