<?php

namespace Reusables;


class Form {

	public static function makeInsertOnly( $tablename, $identifier, $ishtml=false )
	{
		// data needs to be from 'DESCRIBE tablename' SQL query

		Form::prepareInsertOnly( $tablename, $identifier );

		Section::place( "smartform_inmodal", $identifier, $ishtml );

	}

	public static function placeInsert( $tablename, $identifier, $ishtml=false )
	{

		Form::prepareInsertOnly( $tablename, $identifier );

		Section::place( "smartform", $identifier, $ishtml );

	}

	public static function prepareInsert( $tablename, $identifier )
	{

		Form::prepareInsertOnly( $tablename, $identifier );

	}

	public static function prepareInsertOnly( $tablename, $identifier )
	{

		$query = 'DESCRIBE ' . $tablename;
		$values = [];
		$type = 'select';
		$data = CustomData::call( "DBClasses", "querySQL", [$query, $values, $type] )[1];

		$converteddata = [];
		foreach ($data as $r) {
			if( $r['Field'] == "id" ) {
				continue;
			}
			$converteddata[$r['Field']] = "";
		}

		$conditions = [[]];
		$returningdict = ReusableClasses::toValueAndDBInfo( $converteddata, $conditions, $tablename );
		

		Data::addData( $returningdict, $identifier );
			Data::addOption( true, "ifnone_insert", $identifier );
	}

	public static function makeDynamicInsertOnly( $featured_content_id, $identifier, $user_id=0 )
	{
		// data needs to be from 'DESCRIBE tablename' SQL query

		$query = 'DESCRIBE custom_data';
		$values = [];
		$type = 'select';
		$data = CustomData::call( "DBClasses", "querySQL", [$query, $values, $type] )[1];
		$conditions = [[]];

		// exit( json_encode( $returningdict ) );


		//start new

		$query = 'SELECT * FROM customdata_params WHERE featured_content_id=? ORDER BY customdata_params.custom_param_classid ASC';
		$values = [ $featured_content_id ];
		$type = 'select';
		$customparamdict = CustomData::call( "DBClasses", "querySQL", [$query, $values, $type] )[1];

		$customparam_keyvalues = [];
		foreach ($customparamdict as $key) {
			if( !isset( $customparam_keyvalues[$key['custom_param_classid']] ) ) {
				$customparam_keyvalues[$key['custom_param_classid']] = [];
			}
			array_push( $customparam_keyvalues[$key['custom_param_classid']], $key );
		}
		$customparam_i = 0;
		$all_input_keys = [];
		$inputs = [];
		$keystrings = [];
		$customparamclassid_grouped = [];
		// exit( json_encode( $featured_content_id ) );
		foreach ($customparam_keyvalues as $input) {
			$input_keys = [];
			$inputdict = [];
			foreach ($input as $dict) {
				if( $dict['key_string'] == "name" ) {
					if( isset( $inputdict['name'] ) ) {
						if( $inputdict['name'] != $dict['value_string'] ) {
							array_push($keystrings, $dict['value_string']);
						}
					}else{
						array_push($keystrings, $dict['value_string']);
					}
				}
				$inputdict[ $dict['key_string'] ] = $dict['value_string'];
				$inputdict['type'] = $dict['type_string'];
				// exit( json_encode( $inputdict['type'] ) );
			}
			array_push( $customparamclassid_grouped, $input[0]['custom_param_classid'] );

			// exit( json_encode( $returningdict['value'] ) );
			// exit( json_encode( $input[0] ) );

			$input_keys["value_string"] = [
				"labeltext"=>Data::getValue($inputdict, "labeltext"),
				"placeholder"=>Data::getValue($inputdict, "placeholder"),
				"field_value"=>Data::getValue($inputdict, "value"),
				"type"=>Data::getValue($inputdict, "type"),
			];

			$input_keys["user_id"] = ["type"=>"hidden", "field_value"=>$user_id];
			$input_keys["featured_content_id"] = ["type"=>"hidden", "field_value"=>$featured_content_id];//;
			$input_keys["custom_param_classid"] =  ["type"=>"hidden", "field_value"=>$input[0]['custom_param_classid']];
			$input_keys["key_string"] = ["type"=>"hidden", "field_value"=>$inputdict['name']];

			array_push( $all_input_keys, $input_keys );



			

			// array_push( $inputs, $returningdict['value'] );
			$customparam_i++;

		}

		$insertvalues = [];
		$firstindex = 0;
		foreach ($keystrings as $ks) {
			foreach ($input_keys as $k=>$v) {
				if( $k == "value_string" ) {
					array_push($insertvalues, "");
				} else if( $k == "user_id" ) {
					array_push($insertvalues, strval($user_id));
				} else if( $k == "featured_content_id" ) {
					array_push($insertvalues, $featured_content_id);
				} else if( $k == "custom_param_classid" ) {
					array_push($insertvalues, $customparamclassid_grouped[$firstindex]);
				} else if( $k == "key_string" ) {
					array_push($insertvalues, $ks);
				}
			}
			$firstindex++;
		}
		
// exit( json_encode( $insertvalues ) );
		// $conditionsdict = [];
		// foreach ($conditions as $c) {
		// 	$conditionsdict[$c["key"]] = $c["value"];
		// }

		$converteddata = [];
		foreach ($data as $r) {
			if( $r['Field'] == "id" ) {
				continue;
			}
			// if( isset( $conditionsdict[ $r['Field'] ] ) ) {

				// if( $r['Field'] == "featured_content_id" ) {
				// 	$converteddata[$r['Field']] = $featured_content_id;
				// } else if( $r['Field'] == "custom_param_classid" ) {
				// 	$converteddata[$r['Field']] = $custom_param_classid;
				// } else if( $r['Field'] == "key_string" ) {
				// 	$converteddata[$r['Field']] = $inputdict['name'];
				// } else{
				// 	$converteddata[$r['Field']] = "";//$conditionsdict[ $r['Field'] ];
				// }

			// }else{
				$converteddata[$r['Field']] = "";
			// }
		}

		$returningdict = ReusableClasses::toValueAndDBInfo( $converteddata, $conditions, "custom_data" );


		// $returningdict['value'] = $inputs;
		// exit( json_encode( $returningdict ) );
		// exit( json_encode( $all_input_keys ) );
		// done new

		

		Data::addData( $returningdict, $identifier );
			Data::addOption( true, "ifnone_insert", $identifier );
			Data::addOption( true, "multiple_inserts", $identifier );
			Data::addOption( $all_input_keys, "input_keys", $identifier );
			Data::addOption( $insertvalues, "insert_values", $identifier );

	}

	public static function makeDynamic( $fetched_result, $featured_content_id, $identifier, $user_id=0 )
	{
		// data needs to be from 'DESCRIBE tablename' SQL query

		$returningdict = $fetched_result;
		// exit( json_encode( $returningdict ) );


		//start new

		$query = '
		SELECT customdata_params.* 
		FROM customdata_params 
			INNER JOIN custom_data 
				ON customdata_params.custom_param_classid=custom_data.custom_param_classid 
					AND customdata_params.featured_content_id=custom_data.featured_content_id 
					AND customdata_params.featured_content_id=? 
					GROUP BY customdata_params.id 
					ORDER BY customdata_params.custom_param_classid ASC';
		$values = [ $featured_content_id ];
		$type = 'select';
		$customparamdict = CustomData::call( "DBClasses", "querySQL", [$query, $values, $type] )[1];
		// exit( json_encode( $customparamdict ) );

		$customparam_keyvalues = [];
		foreach ($customparamdict as $key) {
			if( !isset( $customparam_keyvalues[$key['custom_param_classid']] ) ) {
				$customparam_keyvalues[$key['custom_param_classid']] = [];
			}
			array_push( $customparam_keyvalues[$key['custom_param_classid']], $key );
		}

		$customparam_i = 0;
		$all_input_keys = [];
		$inputs = [];
		// exit( json_encode( $customparamdict ) );
		foreach ($customparam_keyvalues as $input) {
			$input_keys = [];
			$inputdict = [];
			foreach ($input as $dict) {
				$inputdict[ $dict['key_string'] ] = $dict['value_string'];
				$inputdict['type'] = $dict['type_string'];
				// exit( json_encode( $inputdict['type'] ) );
			}
			// exit( json_encode( $returningdict['value'] ) );
			// exit( json_encode( $input[0] ) );
			$input_keys["value_string"] = [
				"labeltext"=>Data::getValue($inputdict, "labeltext"),
				"placeholder"=>Data::getValue($inputdict, "placeholder"),
				"field_value"=>Data::getValue($inputdict, "value"),
				"type"=>Data::getValue($inputdict, "type"),
				"field_index"=>$customparam_i
			];

			$input_keys["user_id"] = ["type"=>"hidden", "field_value"=>$user_id];
			$input_keys["featured_content_id"] = ["type"=>"hidden", "field_value"=>$featured_content_id];//;
			$input_keys["custom_param_classid"] =  ["type"=>"hidden", "field_value"=>$input[0]['custom_param_classid']];

			array_push( $all_input_keys, $input_keys );

			// array_push( $inputs, $returningdict['value'] );
			$customparam_i++;

		}
		// $returningdict['value'] = $inputs;
		// exit( json_encode( $returningdict ) );
		// exit( json_encode( $customparam_keyvalues ) );
		// done new

		Data::addData( $returningdict, $identifier );
			// Data::addOption( true, "ifnone_insert", $identifier );
			Data::addOption( true, "multiple_updates", $identifier );
			Data::addOption( $all_input_keys, "input_keys", $identifier );

	}


	public static function addJSClassToForm( $identifier, $viewdict, $input_onlykeys, $original_data_id ) {

		ob_start();

			if( !isset( $viewoptions['ifnone_insert'] ) ){
				$ifnone_insert = false;
			}else{
				$ifnone_insert = $viewoptions['ifnone_insert'];
			}

			if( !isset( $viewoptions['multiple_inserts'] ) ){
				$multiple_inserts = false;
			}else{
				$multiple_inserts = $viewoptions['multiple_inserts'];
			}

			if( !isset( $viewoptions['multiple_updates'] ) ){
				$multiple_updates = false;
			}else{
				$multiple_updates = $viewoptions['multiple_updates'];
			}

			if( !isset( $viewoptions['formaction'] ) ){
				$formaction = '/edit_view.php';
			}else{
				$formaction = $viewoptions['formaction'];
			}

			if( isset( $viewdict['formtitle'] ) ) {
				unset( $viewdict['formtitle'] );
			}

			$steps = 1;
			$onstep = 1;
		?>

			<?php if( $steps == $onstep ) { ?>

				var viewdict = <?php echo json_encode($viewdict) ?>;
				var input_keys = <?php echo json_encode($input_onlykeys) ?>;
				var typearray = <?php echo json_encode( ReusableClasses::getTypeArray( $input_onlykeys ) ) ?>;
				var dataarray = <?php echo json_encode( Data::getFullArray( $viewdict ) ) ?>;
				var formatteddata = <?php echo json_encode( Data::retrieveDataWithID( $original_data_id ) ) ?>;
				var identifier = "<?php echo $identifier ?>";

				class <?php echo $identifier ?>Classes {
					populateview( index=null ){
					<?php $insert_values = [];
					if( isset($viewoptions['insert_values']) ) {
						$insert_values = $viewoptions["insert_values"];
					}
					?>
						var multiple_updates = "<?php echo $multiple_updates ?>";
						var multiple_inserts = "<?php echo $multiple_inserts ?>";
						var insert_values = <?php echo json_encode($insert_values) ?>;

						var viewdict = <?php echo json_encode($viewdict) ?>;
						var input_keys = <?php echo json_encode($input_onlykeys) ?>;
						var newinput_keys = [];
						var newtypearray = [];
						var newinsertvalues = [];
						var typearray = <?php echo json_encode( ReusableClasses::getTypeArray( $input_onlykeys, $multiple_updates ) ) ?>;
						if( multiple_inserts ) {
							console.log(JSON.stringify(input_keys))
							for (var i = 0; i < input_keys.length; i++) {
								if( i!=0 && input_keys[i]=="value_string" ) {
									newinput_keys.push(false)
									newtypearray.push(false)
									newinsertvalues.push(false)
								}
								newinput_keys.push(input_keys[i])
								newtypearray.push(typearray[i])
								newinsertvalues.push(insert_values[i])
							}
							input_keys = newinput_keys
							typearray = newtypearray
							insert_values = newinsertvalues
						}

						var dataarray = <?php echo json_encode( Data::getFullArray( $viewdict ) ) ?>;
						// console.log( 'INPUT KEYS: ' + JSON.stringify(input_keys) )
						var formatteddata = <?php echo json_encode( Data::retrieveDataWithID( $original_data_id ) ) ?>;
						var identifier = "<?php echo $identifier ?>";
						Reusable.setinputvalues( viewdict, input_keys, identifier, typearray, dataarray, formatteddata, index, multiple_updates, insert_values )

						<?php if( $steps > 1 ) { ?>
							$('.<?php echo $identifier ?> .main_with_hidden.next').css({'display': 'inline-block'});
							$('.<?php echo $identifier ?> .main_with_hidden.save').css({'display': 'none'});
						<?php } else { ?>
							$('.<?php echo $identifier ?> .main_with_hidden.save').css({'display': 'inline-block'});
							$('.<?php echo $identifier ?> .main_with_hidden.next').css({'display': 'none'});
						<?php } ?>
					}
				}

				

			<?php } ?>

		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

}