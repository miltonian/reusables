<?php 

class Menu {

	public static function make( $file, $data, $identifier )
	{
		$View = View::factory( 'reusables/views/menu/' . $file );
		$View->set( 'menudict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}