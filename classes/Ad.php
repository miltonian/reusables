<?php 

namespace Reusables;

class Ad {

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "ad" );
	}

	public static function make( $file, $identifier )
	{
		return Views::makeView( $file, $identifier, "ad" );
	}


	// public static function make( $file, $identifier )
	// {
	// 	ReusableClasses::addfile( "ad", $file );
	// 	$View = View::factory( 'reusables/views/ad/' . $file );
	// 	$data = Data::retrieveDataWithID( $identifier );
	// 	$View->set( 'addict', $data );
	// 	$View->set( 'identifier', $identifier );
	// 	return $View->render();
	// }

}