<?php 

class Sharing {

	public static function make( $file, $data, $identifier )
	{
		ReusableClasses::addfile( "sharing", $file );
		$View = View::factory( 'reusables/views/sharing/' . $file );
		$View->set( 'sharingdict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}