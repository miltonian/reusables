<?php 

namespace Reusables;

class Cell {

	public static function place( $file, $identifier, $in_html=false )
	{
		if( $in_html ) {
			CustomCode::end();
		}

		Views::addToQueue( "Cell", $file, $identifier );
		
		if( $in_html ) {
			CustomCode::start();
		}
	}

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "cell" );
	}

	public static function make( $file, $identifier )
	{
		return Views::makeView( $file, $identifier, "cell" );
	}

	public static function setincontainer( $file, $identifier )
	{
		Data::addInfo( 'Cell', 'viewtype', $identifier );
		Data::addInfo( $file, 'file', $identifier );
		Data::addInfo( $identifier, 'identifier', $identifier );

		Views::addEditableParts( $identifier );
		return Cell::make( $file, $identifier );
	}

	public static function prepareCell( $identifier )
	{
		$data = Data::retrieveDataWithID( $identifier );
		$options = Data::retrieveOptionsWithID( $identifier );

		$info = Data::retrieveInfoWithID( $identifier );
		
		$viewpath = "";
		$viewtype = Data::getValue( $info, "viewtype" );

		$data_id = Data::getDefaultDataID( $data );
		$fullviewdict = Data::getFullArray( $data );
		if( !isset($options['type'])){ $options['type'] = ""; }
		if( !isset($options['isfeatured']) ){ $options['isfeatured']=false; }
		// if( !isset($isadmin) ){ $isadmin=false; }
		
		$linkpath = Data::getViewLinkPath( $identifier );
		$mediatype = Data::getValue( $data, 'mediatype' );
		$cellindex = Data::getValue( $data, 'index' );
		$table_identifier = str_replace("_cell_".$cellindex, "", $identifier);

		$isfulldesc = false;
		if( isset( $options['fulldesc'] ) ) {
			if( $options['fulldesc'] ) {
				$isfulldesc = true;
			}
		}

		if( !$isfulldesc ) {
			$html_text = implode(' ', array_slice( explode(' ', strip_tags(Data::getValue( $data, 'html_text' ))), 0, 10) ) . "...";
		}else{
			$html_text = Data::getValue( $data, 'html_text' );
		}
		if( $html_text == "..." ){
			$html_text = "";
		}

		$celldate = Data::getValue( $data, 'date' );

		$celltype = Data::getValue( $options, 'type' );

		$table_identifier = str_replace("_cell_" . $cellindex, "", $identifier);

		return [
			"data_id" => $data_id,
			"fullviewdict" => $fullviewdict,
			"linkpath" => $linkpath,
			"mediatype" => $mediatype,
			"cellindex" => $cellindex,
			"html_text" => $html_text,
			"celldate" => $celldate,
			"celltype" => $celltype,
			"table_identifier" => $table_identifier
		];
	}



	// FOR CUSTOM VIEWS

	public static function cplace( $file, $identifier, $in_html=false )
	{
		if( $in_html ) {
			CustomCode::end();
		}

		Views::addToQueue( "Custom/Cell", $file, $identifier );

		if( $in_html ) {
			CustomCode::start();
		}
	}

	public static function cset( $file, $identifier )
	{
		// exit( json_encode( [$file, $identifier] ) );
		Views::setDefaultViewInfo( $file, $identifier, "custom/cell" );
	}

}