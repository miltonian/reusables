<?php 

namespace Reusables;

class Gallery {

	public static function place( $file, $identifier )
	{
		Views::addToQueue( "Gallery", $file, $identifier );
	}

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "gallery" );
	}

	public static function setincontainer( $file, $identifier )
	{
		Views::addEditableParts( $identifier );
		return Gallery::make( $file, $identifier );
	}

	public static function make( $file, $identifier )
	{
		return Views::makeView( $file, $identifier, "gallery" );
	}

	// public static function make( $file, $identifier )
	// {
	// 	ReusableClasses::addfile( "gallery", $file );
	// 	$View = View::factory( 'reusables/views/gallery/' . $file );
	// 	$data = Data::retrieveDataWithID( $identifier );
	// 	$View->set( 'gallerydict', $data );
	// 	$View->set( 'identifier', $identifier );
	// 	return $View->render();
	// }

}