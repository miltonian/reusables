<?php 

class Ad {

	public static function make( $file, $data )
	{
		$View = View::factory( 'reusables/views/ad/' . $file );
		$View->set( 'addict', $data );
		return $View->render();
	}

}