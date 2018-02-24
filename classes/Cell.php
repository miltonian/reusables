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
<<<<<<< HEAD

=======
		$info = Data::retrieveInfoWithID( $identifier );
		
		$viewpath = "";
		$viewtype = Data::getValue( $info, "viewtype" );
//, $viewpath
>>>>>>> d75818e4a721ec8c4f591c2ce3467a63444153d2
		$data_id = Data::getDefaultDataID( $data );
		$fullviewdict = Data::getFullArray( $data );
		if( !isset($options['type'])){ $options['type'] = ""; }
		if( !isset($options['isfeatured']) ){ $options['isfeatured']=false; }
		// if( !isset($isadmin) ){ $isadmin=false; }
		
		$linkpath = Data::getViewLinkPath( $identifier );
		$mediatype = Data::getValue( $data, 'mediatype' );
		$cellindex = Data::getValue( $data, 'index' );
<<<<<<< HEAD
=======
		$table_identifier = str_replace("_cell_".$cellindex, "", $identifier);
>>>>>>> d75818e4a721ec8c4f591c2ce3467a63444153d2

		$isfulldesc = false;
		if( isset( $options['fulldesc'] ) ) {
			if( $options['fulldesc'] ) {
				$isfulldesc = true;
			}
		}

		if( !$isfulldesc ) {
<<<<<<< HEAD
			$description = implode(' ', array_slice( explode(' ', strip_tags(Data::getValue( $data, 'html_text' ))), 0, 10) ) . "...";
		}else{
			$description = Data::getValue( $data, 'html_text' );
=======
			$description = implode(' ', array_slice( explode(' ', strip_tags(Data::getValue( $data, 'html_text', $table_identifier ))), 0, 10) ) . "...";
		}else{
			$description = Data::getValue( $data, 'html_text', $table_identifier );
>>>>>>> d75818e4a721ec8c4f591c2ce3467a63444153d2
		}
		if( $description == "..." ){
			$description = "";
		}

		$celldate = Data::getValue( $data, 'date' );

		$celltype = Data::getValue( $options, 'type' );
<<<<<<< HEAD
// exit( json_encode( $celltype ) );
=======

		$table_identifier = str_replace("_cell_" . $cellindex, "", $identifier);
>>>>>>> d75818e4a721ec8c4f591c2ce3467a63444153d2

		return [
			"data_id" => $data_id,
			"fullviewdict" => $fullviewdict,
			"linkpath" => $linkpath,
			"mediatype" => $mediatype,
			"cellindex" => $cellindex,
			"description" => $description,
			"celldate" => $celldate,
<<<<<<< HEAD
			"celltype" => $celltype
=======
			"celltype" => $celltype,
			"table_identifier" => $table_identifier
>>>>>>> d75818e4a721ec8c4f591c2ce3467a63444153d2
		];
	}

}