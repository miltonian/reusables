<?php 

namespace Reusables;

class CustomReusableView {

	public static function make( $file, $identifier )
	{
		ReusableClasses::addfile( "customreusableview", $file );
		$View = View::factory( 'custom/reusables/views/' . $file );
		$data = Data::retrieveDataWithID( $identifier );
		$View->set( 'viewdict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}