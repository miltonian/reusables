<?php 

namespace Reusables;

class Slider {

	public static function make( $file, $identifier )
	{
		ReusableClasses::addfile( "slider", $file );
		$View = View::factory( 'reusables/views/slider/' . $file );
		$data = Data::retrieveDataWithID( $identifier );
		$View->set( 'sliderdict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}