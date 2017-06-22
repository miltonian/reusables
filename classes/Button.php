<?php 

class Button {

	public static function make( $file, $data )
	{
		$View = View::factory( 'reusables/views/button/' . $file );
		$View->set( 'buttondict', $data );
		return $View->render();
	}

}