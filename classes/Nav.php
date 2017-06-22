<?php 

class Nav {

	public static function make( $file, $data )
	{
		$View = View::factory( 'reusables/views/nav/' . $file );
		$View->set( 'navdict', $data );
		return $View->render();
	}

}