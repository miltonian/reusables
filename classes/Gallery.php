<?php 

namespace Reusables;

class Gallery {

	public static function place( $file, $identifier, $in_html=false )
	{
		$in_html = Page::inhtml();
		if( $in_html ) {
			CustomCode::end();
		}

		Views::addToQueue( "Gallery", $file, $identifier );

		if( $in_html ) {
			CustomCode::start();
		}
	}

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "gallery" );
	}

	public static function setincontainer( $file, $identifier )
	{
		Data::addInfo( 'Gallery', 'viewtype', $identifier );
		Data::addInfo( $file, 'file', $identifier );
		Data::addInfo( $identifier, 'identifier', $identifier );

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




	// FOR CUSTOM VIEWS

	public static function cplace( $file, $identifier, $in_html=false )
	{
		$in_html = Page::inhtml();
		if( $in_html ) {
			CustomCode::end();
		}

		Views::addToQueue( "Custom/Gallery", $file, $identifier );

		if( $in_html ) {
			CustomCode::start();
		}
	}

	public static function cset( $file, $identifier )
	{
		// exit( json_encode( [$file, $identifier] ) );
		Views::setDefaultViewInfo( $file, $identifier, "custom/gallery" );
	}

}