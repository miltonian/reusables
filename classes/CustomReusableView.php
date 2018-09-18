<?php 

namespace Reusables;

class CustomReusableView {

	public static function make( $file, $identifier )
	{
		Page::addAssetFile( "customreusableview", $file );
		$View = View::factory( 'custom/reusables/views/' . $file );
		$data = Data::get( $identifier );
		$View->set( 'viewdict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}