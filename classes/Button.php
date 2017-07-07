<?php 

class Button {

	public static function make( $file, $data, $identifier )
	{
		ReusableClasses::addfile( "button", $file );
		$View = View::factory( 'reusables/views/button/' . $file );
		$View->set( 'buttondict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}