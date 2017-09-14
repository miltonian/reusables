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

	public static function fill( $dict, $key, $index, $type=null, $placeholder=null, $labeltext=null, $parentclass=null )
	{
		if( !$type ){
			$type = self::getInputType( $key );
		}
		// echo json_encode( $placeholder );
		if( !$placeholder ){ $placeholder = ucfirst( $key ); }
		// exit( json_encode( $placeholder ) );
		if( !$labeltext ){ $labeltext = ucfirst( $key ); }

		if( isset( $dict[$key]['data_id'] ) ){
			$dataid = $dict[$key]['data_id'];
		}else{
			$dataid = $dict['data_id'];
		}
		// exit( json_encode( Data::getValue( $dict, $key ) ) );
		$inputdict = [
				"placeholder"=>$placeholder,
				"labeltext"=>$labeltext,
				"background-image"=>"",
				"field_value"=>"",
				"field_index"=>$index,
				"field_table"=>Data::getDefaultTableNameWithID( $dataid ),
				"field_colname"=>Data::getColName( Data::getValue( $dict, $key ) ),
				"field_conditions"=>Data::getConditions( Data::getValue( $dict, $key ) )
			];
			// exit( json_encode( $inputdict ) );
$stuff = "";
if($parentclass){
	$stuff = $parentclass . "_";
}
// exit( json_encode( $stuff . $key . "_input" ) );
		Data::addData( $inputdict, $stuff . $key . "_input_" . $index );
		return Input::make( 
			$type, 
			$stuff . $key . "_input_" . $index
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