<?php 

class Menu {

	public static function make( $file, $data )
	{
		$View = View::factory( 'reusables/views/menu/' . $file );
		$View->set( 'menudict', $data );
		return $View->render();
	}

}