<?php 

namespace Reusables;

class Cell {

	public static function make( $file, $identifier )
	{
		ReusableClasses::addfile( "cell", $file );
		$View = View::factory( 'reusables/views/cell/' . $file );
		$data = Data::retrieveDataWithID( $identifier );
		$View->set( 'celldict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}