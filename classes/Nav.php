<?php 

namespace Reusables;

class Nav {

	public static function make( $file, $identifier )
	{
		ReusableClasses::addfile( "nav", $file );
		$View = View::factory( 'reusables/views/nav/' . $file );
		$data = Data::retrieveDataWithID( $identifier );
		$View->set( 'navdict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}