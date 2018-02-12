<?php 

namespace Reusables;

class Structure {

	public static function place( $file, $data, $identifier )
	{
		Views::addToQueue( "Structure", $file, $identifier, $data );
	}

	public static function set( $file, $data, $identifier )
	{
		
		Data::addData( $data, $identifier );
		Views::setDefaultViewInfo( $file , $identifier, "structure" );

	}

	public static function make( $file, $data, $identifier )
	{
		
		Data::addData( $data, $identifier );
		return Views::makeView( $file, $identifier, "structure" );

	}

}


