<?php 

namespace Reusables;

class Sharing {

	public static function make( $file, $identifier )
	{
		ReusableClasses::addfile( "sharing", $file );
		$View = View::factory( 'reusables/views/sharing/' . $file );
		$data = Data::retrieveDataWithID( $identifier );
		$View->set( 'sharingdict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}