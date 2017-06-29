<?php /* FILE:    alexanderhamiltondev/classes/classes.php
-------- Author:  Alexander Hamilton (miltonian3@gmail.com)
-------- Date:    3/20/2015
-------- Purpose: Class to process database requests. Contains functionality for Loop server-side operations. */

// namespace Reusables\Classes;

class Section {

	public static function make( $file, $data, $identifier, $tablenames=[] )
	{
		$View = View::factory( 'reusables/views/section/' . $file );
		$View->set( 'sectiondict', $data );
		$View->set( 'identifier', $identifier );
		$View->set( 'tablenames', $tablenames );
		return $View->render();
	}

}


