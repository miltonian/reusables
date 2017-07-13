<?php 

namespace Reusables;

class Header {

	public static function make( $file, $data, $identifier )
	{
		ReusableClasses::addfile( "header", $file );
		$View = View::factory( 'reusables/views/header/' . $file );
		$View->set( 'headerdict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}