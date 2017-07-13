<?php 

namespace Reusables;

class Modal {

	public static function make( $file, $data, $identifier )
	{
		$View = View::factory( 'reusables/views/modal/' . $file );
		$View->set( 'modaldict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}