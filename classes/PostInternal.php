<?php 

namespace Reusables;

class PostInternal {

	public static function make( $file, $identifier )
	{
		ReusableClasses::addfile( "postinternal", $file );
		$View = View::factory( 'reusables/views/postinternal/' . $file );
		$data = Data::retrieveDataWithID( $identifier );
		$View->set( 'postdict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}


