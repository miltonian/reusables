<?php 

namespace Reusables;

class Modal {

	public static function make( $file, $identifier )
	{
		$View = View::factory( 'reusables/views/modal/' . $file );
		$data = Data::retrieveDataWithID( $identifier );
		$View->set( 'modaldict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}