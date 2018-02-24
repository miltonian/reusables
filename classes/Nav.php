<?php 

namespace Reusables;

class Nav {

	public static function place( $file, $identifier )
	{
		Views::addToQueue( "Nav", $file, $identifier );
	}

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "nav" );
	}

	public static function make( $file, $identifier )
	{
		return Views::makeView( $file, $identifier, "nav" );
	}

	// public static function make( $file, $identifier )
	// {
	// 	ReusableClasses::addfile( "nav", $file );
	// 	$View = View::factory( 'reusables/views/nav/' . $file );
	// 	$data = Data::retrieveDataWithID( $identifier );
	// 	$View->set( 'navdict', $data );
	// 	$View->set( 'identifier', $identifier );
	// 	return $View->render();
	// }

}