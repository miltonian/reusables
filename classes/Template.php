<?php 

class Template {

	public static function make( $file, $data )
	{
		$View = View::factory( 'reusables/views/template/' . $file );
		$View->set( 'templatedict', $data );
		return $View->render();
	}

}