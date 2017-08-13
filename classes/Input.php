<?php 

namespace Reusables;

class Input {

	public static function make( $file, $identifier )
	{
		ReusableClasses::addfile( "input", $file );
		$View = View::factory( 'reusables/views/input/' . $file );
		$data = Data::retrieveDataWithID( $identifier );
		$View->set( 'inputdict', $data );
		$View->set( 'identifier', $identifier );
		return $View->render();
	}

	public static function fill( $dict, $key, $index, $type=null, $placeholder=null, $labeltext=null )
	{

		if( !$type ){
			$type = self::getInputType( $key );
		}

		if( !$placeholder ){ $placeholder = ucfirst( $key ); }
		if( !$labeltext ){ $labeltext = ucfirst( $key ); }

		return Input::make( 
			$type, 
			[
				"placeholder"=>$placeholder,
				"labeltext"=>$labeltext,
				"background-image"=>"",
				"field_value"=>"",
				"field_index"=>$index,
				"field_table"=>Data::getDefaultTableNameWithID( $dict[$key]['data_id'] ),
				"field_colname"=>Data::getColName( $dict[$key] ),
				"field_conditions"=>Data::getConditions( $dict[$key] )
			],
			$key . "_input"
		);
	}

	public static function getInputType( $key )
	{
		if( strpos($key, "text") !== false || strpos($key, "desc") || strpos($key, "description") || strpos($key, "comment") || strpos($key, "snippet") ){
			$type = "textarea";
		}else if( strpos($key, "image") !== false ){
			$type = "file_image";
		}else if( strpos( $key, "color" ) ){
			$type = "colorpicker";
		}else{
			$type = "textfield";
		}
		return $type;
	}

}