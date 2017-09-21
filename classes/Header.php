<?php 

namespace Reusables;

class Header {


	public static function make( $file, $identifier )
	{
		return Views::setDefaultViewInfo( $file, $identifier, "header" );
	}
	// public static function make( $file, $identifier )
	// {
	// 	ReusableClasses::addfile( "header", $file );
	// 	$View = View::factory( 'reusables/views/header/' . $file );
	// 	$data = Data::retrieveDataWithID( $identifier );
	// 	$View->set( 'headerdict', $data );
	// 	$View->set( 'identifier', $identifier );
	// 	return $View->render();
	// }

}