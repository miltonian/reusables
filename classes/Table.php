<?php 

namespace Reusables;

class Table {

	public static function place( $file, $identifier, $in_html=false )
	{
		$in_html = Page::inhtml();
		if( $in_html ) {
			CustomCode::end();
		}

		Views::addToQueue( "Table", $file, $identifier );
		
		if( $in_html ) {
			CustomCode::start();
		}
	}

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "table" );
	}

	public static function setincontainer( $file, $identifier )
	{
		Data::addInfo( 'Table', 'viewtype', $identifier );
		Data::addInfo( $file, 'file', $identifier );
		Data::addInfo( $identifier, 'identifier', $identifier );

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


	// FOR CUSTOM VIEWS

	public static function cplace( $file, $identifier, $in_html=false )
	{
		$in_html = Page::inhtml();
		if( $in_html ) {
			CustomCode::end();
		}

		Views::addToQueue( "Custom/Table", $file, $identifier );

		if( $in_html ) {
			CustomCode::start();
		}
	}

	public static function cset( $file, $identifier )
	{
		// exit( json_encode( [$file, $identifier] ) );
		Views::setDefaultViewInfo( $file, $identifier, "custom/table" );
	}

}


