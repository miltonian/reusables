<?php 

namespace Reusables;

class Template {

	public static function make( $file, $identifier )
	{
		ReusableClasses::addfile( "template", $file );
		$View = View::factory( 'reusables/views/template/' . $file );
		$data = Data::retrieveDataWithID( $identifier );
		$View->set( 'templatedict', $data );
		$View->set( 'identifier', $identifier );
		
		return $View->render();
	}

}