<?php /* FILE:    alexanderhamiltondev/classes/classes.php
-------- Author:  Alexander Hamilton (miltonian3@gmail.com)
-------- Date:    3/20/2015
-------- Purpose: Class to process database requests. Contains functionality for Loop server-side operations. */

// namespace Reusables\Classes;

class PostInternal {

	public static function make( $file, $data )
	{
		$View = View::factory( 'reusables/views/postinternal/' . $file );
		$View->set( 'postdict', $data );
		return $View->render();
	}

}


