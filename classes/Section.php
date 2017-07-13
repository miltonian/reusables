<?php 

namespace Reusables;

class Section {

	public static function make( $file, $data, $identifier, $tablenames=[] )
	{
		ReusableClasses::addfile( "section", $file );
		$View = View::factory( 'reusables/views/section/' . $file );
		$View->set( 'sectiondict', $data );
		$View->set( 'identifier', $identifier );
		$View->set( 'tablenames', $tablenames );
		return $View->render();
	}

}


