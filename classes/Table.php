<?php 

namespace Reusables;

class Table {

	public static function make( $file, $identifier )
	{
		ReusableClasses::addfile( "table", $file );
		$View = View::factory( 'reusables/views/table/' . $file );
		$data = Data::retrieveDataWithID( $identifier );
		$View->set( 'tabledict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}


