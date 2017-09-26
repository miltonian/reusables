<?php 

namespace Reusables;


class Views {

	public static function setDefaultViewInfo( $file, $identifier, $viewtype, $tablenames=[] )
	{
		ReusableClasses::addfile( $viewtype, $file );
		$View = View::factory( 'reusables/views/' . $viewtype . '/' . $file );
		$data = Data::retrieveDataWithID( $identifier );
		$options = Data::retrieveOptionsWithID( $identifier );

		$View->set( 'viewdict', $data );
		$View->set( 'viewoptions', $options );

		if( $viewtype == "section" ){
			$View->set( 'tablenames', $tablenames );
		}

		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}