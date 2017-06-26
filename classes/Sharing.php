<?php 

class Sharing {

	public static function make( $file, $data )
	{
		$View = View::factory( 'reusables/views/sharing/' . $file );
		$View->set( 'sharingdict', $data );
		return $View->render();
	}

}