<?php 

namespace Reusables;

class Cell {

	public static function place( $file, $identifier )
	{
		Views::addToQueue( "Cell", $file, $identifier );
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
		Views::addEditableParts( $identifier );
		return Cell::make( $file, $identifier );
	}

	public static function prepareCell( $identifier )
	{
		$data = Data::retrieveDataWithID( $identifier );
		$options = Data::retrieveOptionsWithID( $identifier );

		$data_id = Data::getDefaultDataID( $data );
		$fullviewdict = Data::getFullArray( $data );
		if( !isset($options['type'])){ $options['type'] = ""; }
		if( !isset($options['isfeatured']) ){ $options['isfeatured']=false; }
		// if( !isset($isadmin) ){ $isadmin=false; }
		
		$linkpath = Data::getViewLinkPath( $identifier );
		$mediatype = Data::getValue( $data, 'mediatype' );
		$cellindex = Data::getValue( $data, 'index' );

		$isfulldesc = false;
		if( isset( $options['fulldesc'] ) ) {
			if( $options['fulldesc'] ) {
				$isfulldesc = true;
			}
		}

		if( !$isfulldesc ) {
			$description = implode(' ', array_slice( explode(' ', strip_tags(Data::getValue( $data, 'html_text' ))), 0, 10) ) . "...";
		}else{
			$description = Data::getValue( $data, 'html_text' );
		}
		if( $description == "..." ){
			$description = "";
		}

		$celldate = Data::getValue( $data, 'date' );

		$celltype = Data::getValue( $options, 'type' );
// exit( json_encode( $celltype ) );

		return [
			"data_id" => $data_id,
			"fullviewdict" => $fullviewdict,
			"linkpath" => $linkpath,
			"mediatype" => $mediatype,
			"cellindex" => $cellindex,
			"description" => $description,
			"celldate" => $celldate,
			"celltype" => $celltype
		];
	}

}