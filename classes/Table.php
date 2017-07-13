<?php 

namespace Reusables;

class Table {

	public static function make( $file, $data, $identifier )
	{
		ReusableClasses::addfile( "table", $file );
		$View = View::factory( 'reusables/views/table/' . $file );
		$View->set( 'tabledict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}


