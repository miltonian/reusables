<?php 

namespace Reusables;

class Footer {

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "footer" );
	}

	public static function make( $file, $identifier )
	{
		return Views::makeView( $file, $identifier, "footer" );
	}

	// public static function make( $file, $identifier )
	// {
	// 	ReusableClasses::addfile( "footer", $file );
	// 	$View = View::factory( 'reusables/views/footer/' . $file );
	// 	$data = Data::retrieveDataWithID( $identifier );
	// 	$View->set( 'footerdict', $data );
	// 	$View->set( 'identifier', $identifier );
	// 	return $View->render();
	// }

	public static function addbadge ( $imagepath ) {

		return "
			<div style='display: inline-block; position: absolute; margin: 0; padding: 0; margin-top: -65px; z-index: 2; right: 65px; width: 100px; height: 100px; background: transparent; background-size: contain; background-position: center; background-repeat: no-repeat; background-image: url(" . $imagepath . ");'></div>
		";
	}

}