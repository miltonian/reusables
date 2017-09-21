<?php 

namespace Reusables;

class Section {

	public static function make( $file, $identifier )
	{
		return Views::setDefaultViewInfo( $file, $identifier, "section" );
	}

	// public static function make( $file, $identifier, $tablenames=[] )
	// {
	// 	ReusableClasses::addfile( "section", $file );
	// 	$View = View::factory( 'reusables/views/section/' . $file );
	// 	$data = Data::retrieveDataWithID( $identifier );
	// 	$View->set( 'sectiondict', $data );
	// 	$View->set( 'identifier', $identifier );
	// 	$View->set( 'tablenames', $tablenames );
	// 	return $View->render();
	// }

}


