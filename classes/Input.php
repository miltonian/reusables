<?php 

class Input {

	public static function make( $file, $data, $identifier )
	{
		$View = View::factory( 'reusables/views/input/' . $file );
		$View->set( 'inputdict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}