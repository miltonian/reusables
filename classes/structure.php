<?php /* FILE:    alexanderhamiltondev/classes/classes.php
-------- Author:  Alexander Hamilton (miltonian3@gmail.com)
-------- Date:    3/20/2015
-------- Purpose: Class to process database requests. Contains functionality for Loop server-side operations. */

// namespace Reusables\Classes;

class Structure {

	public static function make( $file, $data, $identifier )
	{
		ReusableClasses::addfile( "structure", $file );
		$View = View::factory( 'reusables/views/structure/' . $file );
		$View->set( 'structuredict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}


