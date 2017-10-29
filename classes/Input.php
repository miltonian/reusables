<?php 

namespace Reusables;

class Input {

	protected static $inputtypes = [];

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "input" );
	}

	public static function make( $file, $identifier )
	{
		return Views::makeView( $file, $identifier, "input" );
	}

	// public static function make( $file, $identifier )
	// {
	// 	ReusableClasses::addfile( "input", $file );
	// 	$View = View::factory( 'reusables/views/input/' . $file );
	// 	$data = Data::retrieveDataWithID( $identifier );
	// 	$View->set( 'inputdict', $data );
	// 	$View->set( 'identifier', $identifier );
	// 	return $View->render();
	// }

	public static function fill( $dict, $key, $index, $type=null, $placeholder=null, $labeltext=null, $parentclass=null )
	{
		if( !$type ){
			$type = Input::getInputType( $key );
		}
		$iscurrency = false;
		$isbutton = false;
		if( $type == "currency" ) {
			$type = "textfield";
			$iscurrency = "1";
		}else if( $type == "button" ) {
			$type = "textfield";
			$isbutton = "1";
		}
		Input::setInputType( $key, $type );
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
				"field_conditions"=>Data::getConditions( ["data_id"=>$dataid, "key" => $key] ),
				"is_currency"=>$iscurrency,
				"is_button"=>$isbutton
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
				// echo '<script>console.log(JSON.stringify('.json_encode($index) .') )</script>';
					break;
				}
			}
		}else{
			Data::addData( $inputdict, $stuff . $key . "_input_" . $index );
		}

		// echo '<script>console.log(JSON.stringify('.json_encode($index) .') )</script>';

		// echo $index . ", ";
		// ReusableClasses::setFormInputIndex( $parentclass, $index );
		if( $isbutton == "1" ) {
			$buttondata = Data::retrieveDataWithID( $stuff . $key . "_button_" . $index );
			$buttonoptions = Data::retrieveOptionsWithID( $stuff . $key . "_button_" . $index );
			if( !$buttondata || !$buttonoptions ) {
				exit( "You need to add Data and Options to identifier: \"" . $stuff . $key . "_button_" . $index . "\"" );
			}
			return [ Input::make( $type, $stuff . $key . "_input_" . $index ), Button::make( "basic", $stuff . $key . "_button_" . $index ) ];
		}
		return Input::make( 
			$type, 
			$stuff . $key . "_input_" . $index
		);
	}

	public static function getInputType( $key )
	{
			// exit( json_encode( self::$inputtypes ) );
		if( isset( self::$inputtypes[$key] ) ){
			return self::$inputtypes[$key];
		}

		if( strpos( $key, "text") !== false || strpos($key, "desc") || strpos($key, "description") || strpos($key, "comment") || strpos($key, "snippet") ){
			$type = "textarea";
		}else if( strpos( $key, "image" ) !== false ) {
			$type = "file_image";
		}else if( strpos( $key, "color" ) ) {
			$type = "colorpicker";
		}else{
			$type = "textfield";
		}
		return $type;
	}

	public static function setInputType( $key, $type )
	{
		self::$inputtypes[$key] = $type;
	}

	public static function convertInputKeys( $identifier )
	{
		$data = Data::retrieveDataWithID( $identifier );
		$options = Data::retrieveOptionsWithID( $identifier );

		$onstep = ReusableClasses::getOnStepForm( $identifier );
		ReusableClasses::setOnStepForm( $identifier, $onstep );

		$input_onlykeys = [];

		if( !isset( $options['input_keys'] ) ){ 
			if( isset( $data['value'] ) ){
				if ( !Data::isAssoc( $data['value'] ) ) {
					$input_keys = array_keys( $data['value'][0] );
				}else{
					$input_keys = array_keys( $data['value'] );
				}
			}else{
				$input_keys = array_keys( $data ); 
			}
			$input_keydicts = [];
		}else{
			$input_keydicts = $options['input_keys'];
			$input_keys = array_keys($options['input_keys']);
		}



		$steps = Data::getValue( $options, 'steps' );

		if( $steps == "" ) {
			$steps = 1;
		}else{
			unset( $options[ 'steps' ] );
		}

		// extract( CustomView::makeFormVars( $options, "options" ) );

		$lastinputindex = ReusableClasses::getLastInputIndexForForm( $identifier );
		if( $lastinputindex == null ) {
			$nextinputindex = 0;
		}else{
			$nextinputindex = $lastinputindex+1;
		}

		$inputs = array();
		$i=$nextinputindex;

		$s = $onstep;

		foreach ($input_keys as $ik) {

			$placeholder = null; $labeltext = null; $type = null;
			if( isset( $input_keydicts[ $ik ]['step'] ) ){ $steps = $input_keydicts[ $ik ]['step']; }
			if( isset( $input_keydicts[ $ik ]['placeholder'] ) ){ $placeholder = $input_keydicts[ $ik ]['placeholder']; }else{ $placeholder = null; }
			if( isset( $input_keydicts[ $ik ]['labeltext'] ) ){ $labeltext = $input_keydicts[ $ik ]['labeltext']; }else{ $labeltext = null; }
			if( isset( $input_keydicts[ $ik ]['type'] ) ){ $type = $input_keydicts[ $ik ]['type']; }else{ $type = null; }


			$thekey = $ik;

			if( is_numeric( $ik ) ){ $thekey = $input_keydicts[$ik]; }
			array_push( $input_onlykeys, $thekey );

			$input_fields = [];
			if( isset($inputs['c' . $s ] ) ){
				$input_fields = $inputs['c' . $s ];
			}
			if( $steps == $s ){
				ReusableClasses::setFormInputIndex( $identifier, $i );

				$theinput = Input::fill( $data, $thekey, $i, $type, $placeholder, $labeltext, $identifier  );
				if( sizeof( $theinput ) == 2 ) {
					array_push( 
						$input_fields, 
						$theinput[0]
					);
					$theinput = $theinput[1];
				}
				array_push( 
					$input_fields, 
					$theinput
				);
				$inputs['c' . $s] = $input_fields;

				$i++;
			}
		}
		return [
			"input_keys" => $input_keys,
			"input_keydicts" => $input_keydicts,
			"input_onlykeys" => $input_onlykeys,
			"inputs" => $inputs,
			"steps" => $steps,
			"onstep" => $onstep
		];
	}



}