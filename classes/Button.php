<?php 

namespace Reusables;

class Button {

	public static function make( $file, $identifier )
	{
		ReusableClasses::addfile( "button", $file );
		$View = View::factory( 'reusables/views/button/' . $file );
		$data = Data::retrieveDataWithID( $identifier );
		$View->set( 'buttondict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}