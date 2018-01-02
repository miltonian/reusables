<?php

namespace Reusables;


class Form {

	public static function makeInsertOnly( $tablename, $identifier )
	{
		// data needs to be from 'DESCRIBE tablename' SQL query

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

		$converteddata = [];
		foreach ($data as $r) {
			if( $r['Field'] == "id" ) {
				continue;
			}
			$converteddata[$r['Field']] = "";
		}

		$conditions = [[]];
		$returningdict = ReusableClasses::toValueAndDBInfo( $converteddata, $conditions, "custom_data" );


		// exit( json_encode( $returningdict ) );


		//start new

		$query = 'SELECT * FROM customdata_params WHERE featured_content_id=?';
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
		// exit( json_encode( $featured_content_id ) );
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
			Data::addOption( true, "ifnone_insert", $identifier );
			Data::addOption( true, "multiple_inserts", $identifier );
			Data::addOption( $all_input_keys, "input_keys", $identifier );

	}

}