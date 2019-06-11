<?php

namespace Reusables;

class Input {

	protected static $inputtypes = [];
	protected static $input_field_types = [];

	public static function place( $file, $identifier )
	{
		View::place( "Input", $file, $identifier );
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
		View::cplace( "Input", $file, $identifier );
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
	// 	Page::addAssetFile( "input", $file );
	// 	$View = View::factory( 'reusables/views/input/' . $file );
	// 	$data = Data::get( $identifier );
	// 	$View->set( 'inputdict', $data );
	// 	$View->set( 'identifier', $identifier );
	// 	return $View->render();
	// }

	/**
	 * @author Alexander Hamilton
	 *
	 * @param array $dict
	 * @param string $key
	 * @param int $index
	 * @param string $type
	 * @param string $placeholder
	 * @param string $labeltext
	 * @param string $size
	 * @param string $parentclass
	 * @param string $selectoptions
	 * @param string $multiple
	 * @param bool $multiple_updates
	 * @param int $multipleupdate_i
	 *
	 * @description Generates and fills the input fields with their respective data types and returns html for the input.
	 * - Constructs default inputs if none are assigned.
	 *
	 * @return array $self->make (\Reusables\Views::make())
	 */
	public static function fill( $dict, $key, $index, $type=null, $placeholder=null, $labeltext=null, $size=null, $parentclass=null, $selectoptions="", $multiple=null, $multiple_updates=false, $multipleupdate_i=-1 )
	{

		// get the type of input this is not already defined
		if( !$type ){
			$type = Input::getInputType( $key, $multiple_updates, $multipleupdate_i );
		}

		// determine which type of input is best if need be
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

		// set the inputs type from the data above
		Input::setInputType( $key, $type, $multiple_updates, $multipleupdate_i );

		// get the key without the tablename concatenated
		$raw_key_arr = explode( '.', $key );
		if( sizeof( $raw_key_arr ) != 2 ) {
			$raw_key = $key;
		} else {
			$raw_key = $raw_key_arr[1];
		}

		// exclude the data_id if it is a key, this should not be an input
		if($raw_key == "data_id"){
			return null;
		}

		// if placeholder is not defined then create it from the input key
		if( !$placeholder ){
			$placeholder = ucfirst( str_replace("_", " ", $raw_key) );
		}

		// if labeltext is not defined then create it from the input key
		if( !$labeltext ){
			$labeltext = ucfirst( str_replace("_", " ", $raw_key) );
		}

		if( isset( $dict[$key]['data_id'] ) ){
			$dataid = $dict[$key]['data_id'];
			$options = Options::get($dataid);
		}else{
			$dataid = $dict['data_id'];
			$options = Options::get($dataid);
		}

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
			// return null;
			$tablename = "";
		} else {

			$tablename = Data::getDefaultTableNameWithID( $dataid, $key );
		}


// exit( json_encode( $dict['db_info']['tablenames']['client_status'] ) );
		// $tablename = Data::getDefaultTableNameWithID( $dataid, $raw_key );

		$input_name = $key;

		$inputdict = [
			"placeholder"=>$placeholder,
			"labeltext"=>$labeltext,
			"background-image"=>"",
			"field_value"=>$field_value,
			"input_name"=>$input_name,
			"field_index"=>$index,
			"field_table"=>$tablename,
			"field_colname"=>Data::getColName( ["data_id"=>$dataid, "key" => $key] ),
			"field_conditions"=>Data::getConditions( ["data_id"=>$dataid, "key" => $key] ),
			"options"=>$selectoptions,
			"is_currency"=>$iscurrency,
			"is_hidden"=>$ishidden,
			"is_button"=>$isbutton,
			"size"=>$size,
			"multiple"=>$multiple
		];
		// exit( json_encode( $inputdict ) );

		$stuff = "";
		if($parentclass){
			$stuff = $parentclass . "_";
		}

		// exit( json_encode( $stuff . $key . "_input" ) );
		$dataexists = Data::get( $stuff . $key . "_input_" . $index );
		if( $dataexists ) {
			for ($b=0; $b < 100; $b++) {
				$index++;
				$dataexists = Data::get( $stuff . $key . "_input_" . $index );
				if( $dataexists == null ) {
					Data::add( $inputdict, $stuff . $key . "_input_" . $index );
					break;
				}
			}
		}else{
			Data::add( $inputdict, $stuff . $key . "_input_" . $index );
		}


		// echo $index . ", ";
		// ReusableClasses::setFormInputIndex( $parentclass, $index );
		if( $isbutton == "1" ) {
			$buttondata = Data::get( $stuff . $key . "_button_" . $index );
			$buttonoptions = Options::get( $stuff . $key . "_button_" . $index );
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

		if( isset( self::$inputtypes[$key] ) ){
			if( $multiple_updates ) {
				if( is_array( self::$inputtypes[$key] ) ) {
					$dict = [];
					foreach (self::$inputtypes[$key] as $key=>$value) {
						$dict[$key] = $value;
					}
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

		if( $multiple_updates ) {
			if( !isset( self::$inputtypes[$key] ) ) {
				self::$inputtypes[$key] = [];
			}
			if( $index == -1 ) {
				self::$inputtypes[$key] = $type;
			}else{
				self::$inputtypes[$key][$index] = $type;
			}
		}else{
			self::$inputtypes[$key] = $type;
		}
	}
	/**
	 * @author Alexander Hamilton
	 * @param array $identifier
	 * @return array Function Call
	 */
	public static function convertInputKeys( $identifier )
	{
		// get data using identifier
		$data = Data::get( $identifier );

		// get options using identifier
		$options = Options::get( $identifier );

		// get default tablename using identifier
		$default_tablename = Data::getDefaultTableNameWithID( $identifier );

		// get multiple inserts and multiple updates flags
		$multiple_inserts = Data::getValue( $options, "multiple_inserts" );
		$multiple_updates = Data::getValue( $options, "multiple_updates" );

		// get current step on form
		$onstep = ReusableClasses::getOnStepForm( $identifier );
		ReusableClasses::setOnStepForm( $identifier, $onstep );

		// get all steps on this form
		$steps = Data::getValue( $options, 'steps' );

		// default to step 1 if no step is specified
		if( $steps == "" ) {
			$steps = 1;
		}else{
			unset( $options[ 'steps' ] );
		}

		// get the last input index in form (each input in the smartform has a different index)
		$lastinputindex = ReusableClasses::getLastInputIndexForForm( $identifier );
		if( $lastinputindex == null ) {
			$nextinputindex = 0;
		}else{
			$nextinputindex = $lastinputindex+1;
		}

		// separate vars
		$next_inputindex=$nextinputindex;
		$s = $onstep;

		// initialize some arrays
		$input_onlykeys = [];
		$inputs = [];
		if( !isset( $options['input_keys'] ) && !isset( $options['default_input_keys'] ) ) {
			// if no input keys are specified then we will use every column in the table as input keys

			$input_keys = [];
			return Input::formatInputKeys( $input_keys, $data, $s, $next_inputindex, $steps, $identifier, $onstep, $inputs, $input_onlykeys );
		}else{
			// if input keys are specified we loop through each input key

			$input_keys = [];
			// check whether input keys are custom or default - they would usually be custom (input_keys)
			if( isset( $options['input_keys'] ) ) {
				$input_keys = $options['input_keys'];
			} else {
				$input_keys = $options['default_input_keys'];
			}

			// loop through each input key
			foreach ($input_keys as $k=>$v) {

				// check if input key is indexed or key-value pair
				if( is_numeric($k) ) {
					// is indexed

					if( is_string($v) ) {

						$v_arr = explode(".", $v);
						if( sizeof($v_arr ) == 1 ) {
							if($default_tablename != ""){
								$v = $default_tablename . "." . $v;
							}
						}

						$input_keys[$k] = $v;
					}
				} else {

					if( is_string($k) ) {
						// is key value pair

						// combine tablename and key if not already combined (e.g. "key" will turn into "tablename.key")
						$newk = "";
						$k_arr = explode(".", $k);
						if( sizeof($k_arr ) == 1 ) {
							if($default_tablename != ""){
								$newk = $default_tablename . "." . $k;
							}
						}

						// replace the old key with the new key
						if( $newk != "" ) {

							$input_keys[$newk] = $v;
							unset($input_keys[$k]);
						}
					}
				}
			}

			// if multiple inserts or multiple updates are set it has to do other logic. this probably isn't important for you right now
			if( $multiple_inserts || $multiple_updates ) {

				$returnthisdict = [];
				foreach ($input_keys as $this_inputkeys) {

					$dict = Input::formatInputKeys( $this_inputkeys, $data, $s, $next_inputindex, $steps, $identifier, $onstep, $inputs, $input_onlykeys, $multiple_updates );
					$inputs = $dict['inputs'];
					$input_onlykeys = $dict['input_onlykeys'];
					$next_inputindex = $dict['input_i'];
					$next_inputindex++;
					$returnthisdict = $dict;
				}

				return $returnthisdict;
			}else{

				// if this is normal (not multiple inserts/multiple updates)
				// send data to format input keys
				return Input::formatInputKeys( $input_keys, $data, $s, $next_inputindex, $steps, $identifier, $onstep, $inputs, $input_onlykeys );
			}

		}

	}
	/**
	 * @author Alexander Hamilton
	 * @param array $input_keys
	 * @param array $data
	 * @param mixed $s
	 * @param mixed $i
	 * @param int $steps
	 * @param string $identifier
	 * @param int $onstep
	 * @param array $inputs
	 * @param array $input_onlykeys
	 * @param boolean $multiple_updates
	 * @return array anonymous
	 */
	public static function formatInputKeys( $input_keys, $data, $s, $i, $steps, $identifier, $onstep, $inputs, $input_onlykeys, $multiple_updates=false )
	{

		// check to see if there are already input keys specified
		if( sizeof($input_keys) == 0 ){
			// if there aren't any input keys, get all the keys that have been sent in the data (this is typically column names)

			if( isset( $data['value'] ) ){
				if ( !Shortcuts::isAssoc( $data['value'] ) ) {
					$input_keys = array_keys( $data['value'][0] );
				}else{
					$input_keys = array_keys( $data['value'] );
				}
			}else{
				$input_keys = array_keys( $data );
			}
			// initialize array
			$input_keydicts = [];
		}else{

			// input_keydicts will now be used to store KEY-VALUE PAIRS about the inputs
			$input_keydicts = $input_keys;

			// input_keys will now be used to store the input KEYS only
			$input_keys = array_keys($input_keys);
		}

		// multipleupdate_i is used for multiple inserts/multiple updates
		$multipleupdate_i = $i;

		// loop through each input key
		foreach ($input_keys as $ik) {

			// if step exists in input key dicts then assign to var
			if( isset( $input_keydicts[ $ik ]['step'] ) ){ $steps = $input_keydicts[ $ik ]['step']; }

			// if placeholder exists in input key dicts then assign to var
			if( isset( $input_keydicts[ $ik ]['placeholder'] ) ){ $placeholder = $input_keydicts[ $ik ]['placeholder']; }else{ $placeholder = null; }

			// if labeltext exists in input key dicts then assign to var
			if( isset( $input_keydicts[ $ik ]['labeltext'] ) ){ $labeltext = $input_keydicts[ $ik ]['labeltext']; }else{ $labeltext = null; }

			// if type exists in input key dicts then assign to var
			if( isset( $input_keydicts[ $ik ]['type'] ) ){ $type = $input_keydicts[ $ik ]['type']; }else{ $type = null; }

			// if options exists in input key dicts then assign to var
			if( isset( $input_keydicts[ $ik ]['options'] ) ){ $selectoptions = $input_keydicts[ $ik ]['options']; }else{ $selectoptions = ""; }

			// if size exists in input key dicts then assign to var
			if( isset( $input_keydicts[ $ik ]['size'] ) ){ $size = $input_keydicts[ $ik ]['size']; }else{ $size = ""; }

			// if multiple exists in input key dicts then assign to var
			if( isset( $input_keydicts[ $ik ]['multiple'] ) ){ $multiple = $input_keydicts[ $ik ]['multiple']; }else{ $multiple = ""; }

			// assign the input key to the var $thekey
			$thekey = $ik;

			// if the input key was an index, find the key within input key dicts and assign the correct key to the var $thekey
			if( is_numeric( $ik ) ){ $thekey = $input_keydicts[$ik]; }

			// push the correct input key to the input_onlykeys array
			array_push( $input_onlykeys, $thekey );

			// $s is the current step
			// if any exist, find the input html and add it to the input_fields array
			// ** note ** - the keys you see  are relative to the step the input is on. e.g. inputs in the first step are in $input['c1']. inputs in the second step are in $input['c2']
			$input_fields = [];
			if( isset($inputs['c' . $s ] ) ){
				$input_fields = $inputs['c' . $s ];
			}

			// verify we're on the correct step
			if( $steps == $s ){

				// apply the incremental index to the input
				ReusableClasses::setFormInputIndex( $identifier, $i );

				// create the html for the input and assign to var
				$theinput = Input::fill( $data, $thekey, $i, $type, $placeholder, $labeltext, $size, $identifier, $selectoptions, $multiple, $multiple_updates, $multipleupdate_i );

				// add input html to array $input_fields

				//sizeof only runs if is_array
				if(is_array($theinput)){
					if( sizeof( $theinput ) == 2 ) {
						array_push( $input_fields, $theinput[0] );
						$theinput = $theinput[1];
					}
				}
				array_push( $input_fields, $theinput );

				// add the input fields for this current step to the inputs dictionary and its corresponding key (e.g. first step $input['c1'], second step $input['c2'])
				$inputs['c' . $s] = $input_fields;

				$i++;
			}
			$multipleupdate_i++;
		}

		Info::add($input_onlykeys, "input_onlykeys", $identifier);

		// return dictionary to extract it in returning file
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
