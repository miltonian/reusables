<?php 

class Nav {

	public static function make( $file, $data, $identifier )
	{
		ReusableClasses::addfile( "nav", $file );
		$View = View::factory( 'reusables/views/nav/' . $file );
		$View->set( 'navdict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}