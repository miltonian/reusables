<?php 

namespace Reusables;

class Footer {

	public static function place( $file, $identifier, $in_html=false )
	{
		$in_html = Page::inhtml();
		if( $in_html ) {
			CustomCode::end();
		}

		Views::addToQueue( "Footer", $file, $identifier );
		
		if( $in_html ) {
			CustomCode::start();
		}
	}

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "footer" );
	}

	public static function setincontainer( $file, $identifier )
	{
		Data::addInfo( 'Footer', 'viewtype', $identifier );
		Data::addInfo( $file, 'file', $identifier );
		Data::addInfo( $identifier, 'identifier', $identifier );

		Views::addEditableParts( $identifier );
		return Footer::make( $file, $identifier );
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





	// FOR CUSTOM VIEWS

	public static function cplace( $file, $identifier, $in_html=false )
	{
		$in_html = Page::inhtml();
		if( $in_html ) {
			CustomCode::end();
		}

		Views::addToQueue( "Custom/Footer", $file, $identifier );

		if( $in_html ) {
			CustomCode::start();
		}
	}

	public static function cset( $file, $identifier )
	{
		// exit( json_encode( [$file, $identifier] ) );
		Views::setDefaultViewInfo( $file, $identifier, "custom/footer" );
	}

}