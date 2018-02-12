<?php 

namespace Reusables;

class Table {

	public static function place( $file, $identifier )
	{
		Views::addToQueue( "Table", $file, $identifier );
	}

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "table" );
	}

	public static function setincontainer( $file, $identifier )
	{
		Views::addEditableParts( $identifier );
		return Table::make( $file, $identifier );
	}

	public static function make( $file, $identifier )
	{
		return Views::makeView( $file, $identifier, "table" );
	}

	// public static function make( $file, $identifier )
	// {
	// 	ReusableClasses::addfile( "table", $file );
	// 	$View = View::factory( 'reusables/views/table/' . $file );
	// 	$data = Data::retrieveDataWithID( $identifier );
	// 	$View->set( 'tabledict', $data );
	// 	$View->set( 'identifier', $identifier );
	// 	return $View->render();
	// }

}


