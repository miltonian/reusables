<?php 

namespace Reusables;

class Gallery {

	public static function make( $file, $data, $identifier )
	{
		ReusableClasses::addfile( "gallery", $file );
		$View = View::factory( 'reusables/views/gallery/' . $file );
		$View->set( 'gallerydict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}