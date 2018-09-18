<?php 

namespace Reusables;

class Template {

	public static function make( $file, $identifier )
	{
		Page::addAssetFile( "template", $file );
		$View = View::factory( 'reusables/views/template/' . $file );
		$data = Data::get( $identifier );
		$View->set( 'templatedict', $data );
		$View->set( 'identifier', $identifier );
		
		return $View->render();
	}

}