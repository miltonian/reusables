<?php 

namespace Reusables;

class Section {

	public static function place( $file, $identifier )
	{
		Views::addToQueue( "Section", $file, $identifier );
	}

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "section" );
	}

	public static function make( $file, $identifier )
	{
		return Views::makeView( $file, $identifier, "section" );
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


