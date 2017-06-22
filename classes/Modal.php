<?php 

class Modal {

	public static function make( $file, $data )
	{
		$View = View::factory( 'reusables/views/modal/' . $file );
		$View->set( 'modaldict', $data );
		return $View->render();
	}

}