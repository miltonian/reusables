<?php

namespace Reusables;

class CustomView {

	public static function make( $file, $data, $identifier )
	{
		ReusableClasses::addfile( "CustomView", $file );
		$View = View::factory( 'reusables/views/CustomView/' . $file );
		$View->set( 'customviewdict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

	public static function makeFormVars( $customviewdict )
	{
		if( !isset( $customviewdict['data_id'] ) ){
			$data_id = \Reusables\Data::getDefaultDataID( $customviewdict );
		}else{
			$data_id = $customviewdict['data_id'];
		}

		$default_tablename = \Reusables\Data::getDefaultTableNameWithID( $data_id );

		if( isset($customviewdict['index'] ) ){
			$customviewdict = \Reusables\Data::convertDataForArray( $data_id, $customviewdict['index'] );
		}

		return [ "data_id"=>$data_id, "customviewdict"=>$customviewdict, "default_tablename"=>$default_tablename ];
	}

}