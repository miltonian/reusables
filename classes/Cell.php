<?php 

class Cell {

	public static function make( $file, $data, $identifier )
	{
		$View = View::factory( 'reusables/views/cell/' . $file );
		$View->set( 'celldict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}