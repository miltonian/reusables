<?php

namespace Reusables;

class CustomView {

	public static function make( $file, $data, $identifier )
	{
		// ReusableClasses::addfile( "CustomView", $file );
		ReusableClasses::addfile( "custom", $file );
		$View = View::factory( 'custom/views/' . $file );
		$View->set( 'customviewdict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

	public static function makeFormVars( $dict, $viewtypedict=null )
	{
		if( !isset( $dict['data_id'] ) ){
			$data_id = \Reusables\Data::getDefaultDataID( $dict );
		}else{
			$data_id = $dict['data_id'];
		}

		$default_tablename = \Reusables\Data::getDefaultTableNameWithID( $data_id );

		if( isset($dict['index'] ) ){
			$dict = \Reusables\Data::convertDataForArray( $data_id, $dict['index'] );
		}

		if( $viewtypedict ){
			return [ "data_id"=>$data_id, $viewtypedict=>$dict, "default_tablename"=>$default_tablename ];
		}else{
			return [ "data_id"=>$data_id, "customviewdict"=>$dict, "default_tablename"=>$default_tablename ];
		}
	}

}