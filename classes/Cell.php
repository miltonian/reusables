<?php 

class Cell {

	public static function make( $file, $data, $identifier )
	{
		ReusableClasses::addfile( "cell", $file );
		$View = View::factory( 'reusables/views/cell/' . $file );
		$View->set( 'celldict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}