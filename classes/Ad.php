<?php 

class Ad {

	public static function make( $file, $data, $identifier )
	{
		$View = View::factory( 'reusables/views/ad/' . $file );
		$View->set( 'addict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}