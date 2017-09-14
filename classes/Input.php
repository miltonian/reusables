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
		// exit( json_encode( Data::getValue( $dict['value'][0], $key ) ) );
		$inputdict = [
				"placeholder"=>$placeholder,
				"labeltext"=>$labeltext,
				"background-image"=>"",
				"field_value"=>"",
				"field_index"=>$index,
				"field_table"=>Data::getDefaultTableNameWithID( $dataid ),
				"field_colname"=>Data::getColName( ["data_id"=>$dataid, "key" => $key] ),
				"field_conditions"=>Data::getConditions( ["data_id"=>$dataid, "key" => $key] )
			];
			// exit( json_encode( $inputdict ) );
$stuff = "";
if($parentclass){
	$stuff = $parentclass . "_";
}
// exit( json_encode( $stuff . $key . "_input" ) );
		$dataexists = Data::retrieveDataWithID( $stuff . $key . "_input_" . $index );
		if( $dataexists ) {
			for ($b=0; $b < 100; $b++) { 
				$index++;
				$dataexists = Data::retrieveDataWithID( $stuff . $key . "_input_" . $index );
				if( $dataexists == null ) {
					Data::addData( $inputdict, $stuff . $key . "_input_" . $index );
					$b==100;
				}
			}
		}else{
			Data::addData( $inputdict, $stuff . $key . "_input_" . $index );
		}


		// ReusableClasses::setFormInputIndex( $parentclass, $index );
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