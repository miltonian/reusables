<?php 

namespace Reusables;

class Ad {

	public static function make( $file, $data, $identifier )
	{
		ReusableClasses::addfile( "ad", $file );
		$View = View::factory( 'reusables/views/ad/' . $file );
		$View->set( 'addict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}