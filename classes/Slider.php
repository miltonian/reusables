<?php 

namespace Reusables;

class Slider {

	public static function make( $file, $data, $identifier )
	{
		echo Style::$file( $identifier );
		$View = View::factory( 'reusables/views/slider/' . $file );
		$View->set( 'sliderdict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}