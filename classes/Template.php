<?php 

class Template {

	public static function make( $file, $data, $identifier )
	{
		ReusableClasses::addfile( "template", $file );
		$View = View::factory( 'reusables/views/template/' . $file );
		$View->set( 'templatedict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}