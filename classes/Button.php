<?php 

class Button {

	public static function make( $file, $data, $identifier )
	{
		$View = View::factory( 'reusables/views/button/' . $file );
		$View->set( 'buttondict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}