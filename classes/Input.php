<?php 

namespace Reusables;

class Input {

	public static function make( $file, $data, $identifier )
	{
		ReusableClasses::addfile( "input", $file );
		$View = View::factory( 'reusables/views/input/' . $file );
		$View->set( 'inputdict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}