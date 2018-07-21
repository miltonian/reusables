<?php

namespace Reusables;

class Input {

	protected static $inputtypes = [];
	protected static $input_field_types = [];

	public static function place( $file, $identifier )
	{
		$in_html = Page::inhtml();
		if( $in_html ) {
			CustomCode::end();
		}

		Views::addToQueue( "Input", $file, $identifier );

		if( $in_html ) {
			CustomCode::start();
		}
	}

	public static function set( $file, $identifier )
	{
		Views::setDefaultViewInfo( $file, $identifier, "input" );
	}

	public static function make( $file, $identifier )
	{
		return Views::makeView( $file, $identifier, "input" );
	}


// FOR CUSTOM VIEWS

	public static function cplace( $file, $identifier )
	{
		$in_html = Page::inhtml();
		if( $in_html ) {
			CustomCode::end();
		}

		Views::addToQueue( "Custom/Input", $file, $identifier );

		if( $in_html ) {
			CustomCode::start();
		}
	}

	public static function cset( $file, $identifier )
	{
		// exit( json_encode( [$file, $identifier] ) );
		Views::setDefaultViewInfo( $file, $identifier, "custom/input" );
	}















	public static function setInputFieldType( $type, $identifier )
	{

		self::$input_field_types[$identifier] = $type;

	}

	public static function getInputFieldType( $identifier )
	{

		if( !isset( self::$input_field_types[$identifier] ) ) {
			return "textfield";
		}
		return self::$input_field_types[$identifier];

	}

	public static function getInputTypes()
	{
		return self::$inputtypes;
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

	public static function fill( $dict, $key, $index, $type=null, $placeholder=null, $labeltext=null, $size=null, $parentclass=null, $selectoptions="", $multiple_updates=false, $multipleupdate_i=-1 )
	{
		if( !$type ){
			$type = Input::getInputType( $key, $multiple_updates, $multipleupdate_i );
		}

		$iscurrency = false;
		$isbutton = false;
		$ishidden = false;
		if( $type == "currency" ) {
			$type = "textfield";
			$iscurrency = "1";
		}else if( $type == "button" ) {
			$type = "textfield";
			$isbutton = "1";
		}else if( $type == "hidden" ) {
			$type = "textfield";
			$ishidden = "1";
		}else if( $type == "date" ) {
			$type = "datepicker";
		}else if( $type == "time" ) {
			$type = "timepicker";
		}
		Input::setInputType( $key, $type, $multiple_updates, $multipleupdate_i );
		// echo "<script> console.log( 'ASDF: '+JSON.stringify( ".json_encode( [$key, $type, $multiple_updates, $multipleupdate_i] ) ." ) ); </script>";
		// exit( json_encode( $key ) );
		$raw_key_arr = explode( '.', $key );
		if( sizeof( $raw_key_arr ) != 2 ) {
			return null;
		}

		$raw_key = $raw_key_arr[1];

		if( !$placeholder ){ $placeholder = ucfirst( str_replace("_", " ", $raw_key) ); }
		if( !$labeltext ){ $labeltext = ucfirst( str_replace("_", " ", $raw_key) ); }
		// if( !$size ){ $size = ucfirst( $key ); }
// exit( json_encode( $key ) );
		if( isset( $dict[$key]['data_id'] ) ){
			$dataid = $dict[$key]['data_id'];
			$options = Data::retrieveOptionsWithID($dataid);
		}else{
			$dataid = $dict['data_id'];
			$options = Data::retrieveOptionsWithID($dataid);
		}
		// exit( json_encode( $dataid ) );
		if( isset( $options['input_keys'] ) ) {
			$input_keys = $options['input_keys'];
			if( isset( $input_keys[$key] ) ) {
				$field_value = Data::getValue( $input_keys[$key], "field_value" );
			}
		}
		if( !isset($field_value) ) {
			$field_value = "";
		}

		// exit( json_encode( Data::getColName( ["data_id"=>$dataid, "key" => $key] ) ) );
		if( ( Data::getColName( ["data_id"=>$dataid, "key" => $key] ) ) == null ) {
			return null;
		}


// exit( json_encode( $dict['db_info']['tablenames']['client_status'] ) );
		// $tablename = Data::getDefaultTableNameWithID( $dataid, $raw_key );
		$tablename = Data::getDefaultTableNameWithID( $dataid, $key );

		$inputdict = [
			"placeholder"=>$placeholder,
			"labeltext"=>$labeltext,
			"background-image"=>"",
			"field_value"=>$field_value,
			"field_index"=>$index,
			"field_table"=>$tablename,
			"field_colname"=>Data::getColName( ["data_id"=>$dataid, "key" => $key] ),
			"field_conditions"=>Data::getConditions( ["data_id"=>$dataid, "key" => $key] ),
			"options"=>$selectoptions,
			"is_currency"=>$iscurrency,
			"is_hidden"=>$ishidden,
			"is_button"=>$isbutton,
			"size"=>$size
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

	public static function getInputType( $key, $multiple_updates=false, $field_index=-1 )
	{
		if($key == "value_string"){
			// echo " console.log( 'haha: '+JSON.stringify('".json_encode( self::$inputtypes ) . "')); ";
		}
		if( isset( self::$inputtypes[$key] ) ){
			if( $multiple_updates ) {
				if( is_array( self::$inputtypes[$key] ) ) {
					$dict = [];
					foreach (self::$inputtypes[$key] as $key=>$value) {
						$dict[$key] = $value;
					}
					// echo "console.log( JSON.stringify( ". json_encode( $dict ) . ") ); ";
					if( isset( $dict[strval($field_index)] ) ) {
						return $dict[strval($field_index)];
					}else{
						// return self::$inputtypes[$key];
					}
				}else{
					return self::$inputtypes[$key];
				}
			}else{
				return self::$inputtypes[$key];
			}
		}

		if( strpos( $key, "text") !== false || strpos($key, "desc") || strpos($key, "description") || strpos($key, "comment") || strpos($key, "snippet") ){
			if( strpos( $key, "html") !== false || strpos( $key, "html") !== false ) {
				$type = "wysi";
			} else {
				$type = "textarea";
			}
		}else if( strpos( $key, "image" ) !== false ) {
			$type = "file_image";
		}else if( strpos( $key, "color" ) ) {
			$type = "colorpicker";
		}else{
			$type = "textfield";
		}

		return $type;
	}

	public static function setInputType( $key, $type, $multiple_updates=false, $index=-1 )
	{
		// if($type == "file_image"){
// echo "<script> console.log('FOUND: '+JSON.stringify(".json_encode(self::$inputtypes).")) </script>";
		// }
		if( $multiple_updates ) {
			if( !isset( self::$inputtypes[$key] ) ) {
				self::$inputtypes[$key] = [];
			}
			if( $index == -1 ) {
				self::$inputtypes[$key] = $type;
			}else{
				self::$inputtypes[$key][$index] = $type;
				// echo "<script> console.log('FOUND: '+JSON.stringify(".json_encode([self::$inputtypes]).")) </script>";
			}
		}else{
			self::$inputtypes[$key] = $type;
		}
	}

	public static function convertInputKeys( $identifier )
	{
		$data = Data::retrieveDataWithID( $identifier );
		$options = Data::retrieveOptionsWithID( $identifier );
		$default_tablename = Data::getDefaultTableNameWithID( $identifier );

		$multiple_inserts = Data::getValue( $options, "multiple_inserts" );
		$multiple_updates = Data::getValue( $options, "multiple_updates" );


		$onstep = ReusableClasses::getOnStepForm( $identifier );
		ReusableClasses::setOnStepForm( $identifier, $onstep );

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

		$i=$nextinputindex;

		$s = $onstep;


		$input_onlykeys = [];
		$inputs = [];


		if( !isset( $options['input_keys'] ) && !isset( $options['default_input_keys'] ) ) {
			$input_keys = [];
			return Input::convertInputKeys2( $input_keys, $data, $s, $i, $steps, $identifier, $onstep, $inputs, $input_onlykeys );
		}else{
			$input_keys = [];
			if( isset( $options['input_keys'] ) ) {
				$input_keys = $options['input_keys'];
			} else {
				$input_keys = $options['default_input_keys'];
			}
			foreach ($input_keys as $k=>$v) {
				if( is_numeric($k) ) {
					if( is_string($v) ) {
						$v_arr = explode(".", $v);
						if( sizeof($v_arr ) == 1 ) {
							$v = $default_tablename . "." . $v;
						}

						$input_keys[$k] = $v;
					}
				} else {

					if( is_string($k) ) {
						$newk = "";
						$k_arr = explode(".", $k);
						if( sizeof($k_arr ) == 1 ) {
							$newk = $default_tablename . "." . $k;
						}
						if( $newk != "" ) {

							// $input_keys[$newk] = $k;
							$input_keys[$newk] = $v;
							unset($input_keys[$k]);
						}
					}
				}
			}
			// exit( json_encode( $input_keys ) );
			if( $multiple_inserts || $multiple_updates ) {
				$returnthisdict = [];
				foreach ($input_keys as $this_inputkeys) {
					$dict = Input::convertInputKeys2( $this_inputkeys, $data, $s, $i, $steps, $identifier, $onstep, $inputs, $input_onlykeys, $multiple_updates );
					$inputs = $dict['inputs'];
					$input_onlykeys = $dict['input_onlykeys'];
					$i = $dict['input_i'];
					$i++;
					$returnthisdict = $dict;

					// exit( json_encode( $this_inputkeys ) );
				}

				return $returnthisdict;
			}else{
				return Input::convertInputKeys2( $input_keys, $data, $s, $i, $steps, $identifier, $onstep, $inputs, $input_onlykeys );
			}

		}






		// if( $multiple_inserts != "" ) {
		// 	if( $multiple_inserts == true ) {
		// 		$input_i = 0;
		// 		foreach ($options['input_keys'] as $inputkey) {
		// 			# code...
		// 		}
		// 	}else{

		// 	}
		// }else{

		// }


	}

	public static function convertInputKeys2( $input_keys, $data, $s, $i, $steps, $identifier, $onstep, $inputs, $input_onlykeys, $multiple_updates=false )
	{

		// $asdf++;
// Input::setInputFieldType( $t );
		if( sizeof($input_keys) == 0 ){
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
			$input_keydicts = $input_keys;
			$input_keys = array_keys($input_keys);
		}

$asdf = 0;
		$multipleupdate_i = $i;
		foreach ($input_keys as $ik) {
// exit( json_encode( $ik ) );

			$placeholder = null; $labeltext = null; $type = null;
			if( isset( $input_keydicts[ $ik ]['step'] ) ){ $steps = $input_keydicts[ $ik ]['step']; }
			if( isset( $input_keydicts[ $ik ]['placeholder'] ) ){ $placeholder = $input_keydicts[ $ik ]['placeholder']; }else{ $placeholder = null; }
			if( isset( $input_keydicts[ $ik ]['labeltext'] ) ){ $labeltext = $input_keydicts[ $ik ]['labeltext']; }else{ $labeltext = null; }
			if( isset( $input_keydicts[ $ik ]['type'] ) ){ $type = $input_keydicts[ $ik ]['type']; }else{ $type = null; }
			if( isset( $input_keydicts[ $ik ]['options'] ) ){ $selectoptions = $input_keydicts[ $ik ]['options']; }else{ $selectoptions = ""; }
			if( isset( $input_keydicts[ $ik ]['size'] ) ){ $size = $input_keydicts[ $ik ]['size']; }else{ $size = ""; }

			$thekey = $ik;
			if( is_numeric( $ik ) ){ $thekey = $input_keydicts[$ik]; }
			array_push( $input_onlykeys, $thekey );

			$input_fields = [];
			if( isset($inputs['c' . $s ] ) ){
				$input_fields = $inputs['c' . $s ];
			}
			if( $steps == $s ){
				ReusableClasses::setFormInputIndex( $identifier, $i );

				$theinput = Input::fill( $data, $thekey, $i, $type, $placeholder, $labeltext, $size, $identifier, $selectoptions, $multiple_updates, $multipleupdate_i );

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
			$multipleupdate_i++;
		}
		return [
			"input_keys" => $input_keys,
			"input_keydicts" => $input_keydicts,
			"input_onlykeys" => $input_onlykeys,
			"inputs" => $inputs,
			"steps" => $steps,
			"onstep" => $onstep,
			"input_i" => $i,
		];
	}



}
