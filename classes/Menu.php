<?php 

namespace Reusables;

class Menu {

	public static function make( $file, $data, $identifier )
	{
		ReusableClasses::addfile( "menu", $file );
		$View = View::factory( 'reusables/views/menu/' . $file );
		$View->set( 'menudict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}