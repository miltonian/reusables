<?php 

namespace Reusables;

class PostInternal {

	public static function make( $file, $data, $identifier )
	{
		$View = View::factory( 'reusables/views/postinternal/' . $file );
		$View->set( 'postdict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}


