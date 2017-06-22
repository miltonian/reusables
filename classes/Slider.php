<?php 

class Slider {

	public static function make( $file, $data )
	{
		$View = View::factory( 'reusables/views/slider/' . $file );
		$View->set( 'sliderdict', $data );
		return $View->render();
	}

}