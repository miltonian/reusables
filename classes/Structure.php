<?php 

namespace Reusables;

class Structure {

	public static function make( $file, $data, $identifier )
	{
		ReusableClasses::addfile( "structure", $file );
		$View = View::factory( 'reusables/views/structure/' . $file );
		$View->set( 'structuredict', $data );
		$View->set( 'identifier', $identifier );

		return $View->render();
	}

}


