<?php 

namespace Reusables;


class Views {

	public static function setDefaultViewInfo( $file, $identifier, $viewtype, $tablenames=[] )
	{
		ReusableClasses::addfile( $viewtype, $file );
		$View = View::factory( 'reusables/views/' . $viewtype . '/' . $file );
		$data = Data::retrieveDataWithID( $identifier );
		$options = Data::retrieveOptionsWithID( $identifier );

		if( $viewtype == "postinternal" ){
			$View->set( 'postdict', $data );
			$View->set( 'postoptions', $options );
		}else{
			$View->set( $viewtype . 'dict', $data );
			$View->set( $viewtype . 'options', $options );
		}

		if( $viewtype == "section" ){
			$View->set( 'tablenames', $tablenames );
		}

		$View->set( 'identifier', $identifier );
		return $View->render();
	}

}