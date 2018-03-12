<?php

namespace Reusables;

/*
	some instruction:
		- Data::addData( $entry, $identifier )
			- adds data (usually from sql query) to a data_id
		- Data::retrieveDataWithID( $identifier )
			- retrieves the full array of this data_id ( $identifier holds the data_id value in this case )
		- Data::formatForDefaultData( $dataid )
			- arranges the data into the format in which the views understand
		- Data::getValue( $pair )
			- retrieves the value of a specified key from a default data set

*/

class Data {

	protected static $alldata = array();
	protected static $alloptions = array();
	protected static $allinfo = array();


	public static function formatForDefaultData( $dataid )
	{
		$defaultdata = [];
		$fetcheddata = [];
		$type = "in_dict";
		
		if( self::isAssoc( self::$alldata[$dataid]['value'] ) ){
			$fetcheddata = self::$alldata[$dataid]['value'];
		}else{
			$fetcheddata = self::$alldata[$dataid]['value'][0];
			$type = "in_array";
		}

		foreach ( $fetcheddata as $k=>$v ) {
			$defaultdata[ $k ] = [ "data_id" => $dataid, "key" => $k, "type" => $type ];
		}

		return $defaultdata;
	}

	public static function formatCellWithDefaultData( $data_id, $index )
	{
		$data = self::retrieveDataWithID( $data_id );
		if( !isset( $data['value'][$index] ) ){
			return null;
		}
		$dict = $data['value'][$index];
		$allkeys = array_keys( $dict );
		$cell = [];
		foreach ($allkeys as $k) {
			$cell[$k] = [ "data_id"=>$data_id, "key"=>$k, "index"=>$index ];
		}
		$cell['index'] = $index;
		// exit( json_encode( $cell ) );
		$cell = Data::convertKeys( $cell );
		// exit( json_encode( Data::getValue( $cell, 'slug' ) ) );
		return $cell;
	}

	public static function isAssoc(array $arr)
	{
	    if (array() === $arr) return false;
	    return array_keys($arr) !== range(0, count($arr) - 1);
	}

	public static function addData( $data, $identifier )
	{
		if( !is_array( $data ) ){
			$data = Data::retrieveDataWithID( $data );
		}
		
		// if ( !isset( self::$alldata[ $identifier ] ) ) {
			$data['data_id'] = $identifier;
			self::$alldata[ $identifier ] = $data;

		// }else{
			// exit( "Duplicate data id: '" . $identifier . "' entries. " );
		// }

		Views::addView( $identifier );

	}

	public static function overwriteData( $data, $identifier )
	{
		if( !is_array( $data ) ){
			$data = Data::retrieveDataWithID( $data );
		}
		
		// if ( !isset( self::$alldata[ $identifier ] ) ) {
			$data['data_id'] = $identifier;
			self::$alldata[ $identifier ] = $data;

		// }else{
		// 	exit( "Duplicate data id: '" . $identifier . "' entries. " );
		// }

		Views::addView( $identifier );

	}

	// public static function addInputKey( $input_key, $identifier )
	// {
	// 	$viewoptions = Data::retrieveOptionsWithID( $identifier );
		
	// 	array_merge( $viewoptions['input_keys'], $input_key );
	// }

	// public static function addInputKey( $input_key, $identifier )
	// {
	// 	$viewoptions = Data::retrieveOptionsWithID( $identifier );
	// 	array_merge( $viewoptions['input_keys'], $input_key );
	// }

	public static function setKeyValue( $pair, $identifier )
	{
		if( !isset( self::$alldata[ $identifier ] ) ) {
			return;
		}else{
			$key = array_keys( $pair )[0];
			self::$alldata[ $identifier ]['value'][ $key ] = $pair[ $key ];
		}
	}

	public static function addOption( $data, $key, $identifier )
	{
		if( !isset( self::$alloptions[ $identifier ] ) ) {
			self::$alloptions[ $identifier ] = [];
		}
		self::$alloptions[ $identifier ][ $key ] = $data;
	}

	public static function addOptions( $data, $identifier )
	{
		if( !isset( self::$alloptions[ $identifier ] ) ) {
			self::$alloptions[ $identifier ] = $data;
		}
		
	}


	public static function addInfo( $data, $key, $identifier )
	{
		if( !isset( self::$allinfo[ $identifier ] ) ) {
			self::$allinfo[ $identifier ] = [];
		}
		self::$allinfo[ $identifier ][ $key ] = $data;
	}

	public static function getAllViewsInfo()
	{
		return self::$allinfo;
	}

	public static function retrieveDataWithID( $identifier )
	{
		if( is_array( $identifier ) ){
			return null;
		}
		if ( !isset( self::$alldata[ $identifier ] ) ) {
			return null;
		}else{
			return self::$alldata[ $identifier ];
		}
	}

	public static function retrieveOptionsWithID( $identifier )
	{
		if( is_array( $identifier ) ){
			return null;
		}
		if ( !isset( self::$alloptions[ $identifier ] ) ) {
			return null;
		}else{
			return self::$alloptions[ $identifier ];
		}
	}

	public static function retrieveInfoWithID( $identifier )
	{
		if( is_array( $identifier ) ){
			return null;
		}
		if ( !isset( self::$allinfo[ $identifier ] ) ) {
			return null;
		}else{
			return self::$allinfo[ $identifier ];
		}
	}

	public static function getDefaultDataID( $viewdict )
	{
		if ( self::isAssoc($viewdict) ) {
			$dict = $viewdict;
		}else{
			$dict = $viewdict[0];
		}
		if( isset( $viewdict['data_id'] ) ){
			return $viewdict['data_id'];
		}
		$allkeys = array_keys( $dict );
		if( isset($dict[ $allkeys[0] ]['data_id']) ){
			$data_id = $dict[ $allkeys[0] ]['data_id'];
			return $data_id;
		}else{
			return "";
		}
		
	}

	public static function getDefaultConditionsWithID( $identifier )
	{
		$data = Data::retrieveDataWithID( $identifier );

		return $data['db_info']['conditions'];
	}

	public static function getDefaultTableNameWithID( $identifier )
	{
		$data = Data::retrieveDataWithID( $identifier );
		// exit( json_encode( $data ) );
		if( !isset($data['db_info']) ){
			return "";
		}
		$tablenames = $data['db_info']['tablenames'];
		$allkeys = array_keys($tablenames);
		return $tablenames[$allkeys[0]];
	}


	public static function getValue( $dict, $key=-1, $identifier="" )
	{
		if( is_string($dict) ) {
			return $dict;
		}

		if( !is_array( $dict ) ){
			$dict = Data::retrieveDataWithID( $dict );
		}

		if( $key == -1 ){
			$allkeys = array_keys($dict);
			$thevalue = [];
			foreach ($allkeys as $key) {
				$keyvalue = Data::getValue( $dict, $key );
				$thevalue[$key] = $keyvalue;
			}
			return $thevalue;
			
		}else if( isset($dict[ $key ]) ){
			$pair = $dict[ $key ];
		}else{
			if( isset( $dict['value'][ $key ] )  ){
				$pair = $dict['value'][ $key ];
				// if( $key == "logo_imagepath" ){
				// }
			}else{
				return "";
			}
		}

		$hasindex = false;
		if( !isset( $pair['data_id'] ) ){ 
			// echo "<script>console.log(JSON.stringify( 'retrieve data is missing data_id' + " . $pair . " ) );</script>"; 
			return $pair; 
		}
		if( !isset( $pair['key'] ) ){ 
			// echo "<script>console.log(JSON.stringify( 'retrieve data is missing data_id' ) );</script>"; 
			return $pair; 
		}
		if( isset( $pair['index'] ) ){ $hasindex = true; }

		if( $hasindex ){
			$thevalue = self::retrieveDataWithID( $pair['data_id'] );
			if( $thevalue ){
				$thevalue = $thevalue['value'][ $pair['index'] ][ $pair['key'] ];
			}else{
				$thevalue = "";
			}
		}else{
			$thevalue = self::retrieveDataWithID( $pair['data_id'] );
			// exit( json_encode( $thevalue['value'][0]['id'] ) );
			if( $thevalue ){
				$thevalue = $thevalue['value'][ $pair['key'] ];
			}else{
				$thevalue = "";
			}
		}

		if($thevalue == null){
			// echo "<script>console.log(JSON.stringify( ' thevalue is null' + " . json_encode( $pair ) . " ) );</script>";
			// $thevalue = $pair;
			$thevalue = "";
		}

		Data::addDefaultInputKeys( $key, $identifier );
		
		return $thevalue;
	}

	public static function addDefaultInputKeys( $key, $identifier ) {
		if( $identifier != "" ) {
			$viewoptions = Data::retrieveOptionsWithID( $identifier . "_form" );
			$defaultinputkeys = Data::getValue( $viewoptions, "default_input_keys" );
			if( $defaultinputkeys == "" ) {
				$defaultinputkeys = [];
				// exit( json_encode( $identifier."_form" ) );
			}
			$found = false;
			foreach ($defaultinputkeys as $k) {
				if( $k == $key ) {
					$found = true;
				}
			}
			if( !$found ) {
				array_push( $defaultinputkeys, $key );
			}
			if( $identifier == "featured_table" ) {
				if($key != "html_text"){

					// exit( json_encode( $identifier . "_form" ) );
				}
			}
			Data::addOption( $defaultinputkeys, "default_input_keys", $identifier . "_form" );
		}
	}

	public static function getConditions( $pair )
	{
		if( !isset( $pair['data_id'] ) ){ return ""; }
		if( !isset( $pair['key'] ) ){ return ""; }
		
		$conditions = self::retrieveDataWithID( $pair['data_id'] )['db_info'][ "conditions" ];

		return $conditions;
	}

	public static function getColName( $pair )
	{
		if( !isset( $pair['data_id'] ) ){ return ""; }
		if( !isset( $pair['key'] ) ){ return ""; }
		
		if( !isset(self::retrieveDataWithID( $pair['data_id'] )['db_info'][ "colnames" ][$pair['key']]) ) {
			return null;
		}
		$colname = self::retrieveDataWithID( $pair['data_id'] )['db_info'][ "colnames" ][$pair['key']];

		return $colname;
	}

	public static function getFullArray( $viewdict )
	{
		if( !is_array( $viewdict ) ){
			$viewdict = Data::retrieveDataWithID( $viewdict );
		}
		$allkeys = array_keys($viewdict);
		$dataidarray = array();

		// foreach ($allkeys as $k) {
		// 	$dataid = $viewdict[$k]['data_id'];
		// 	if ($dataid != null) {
		// 		if( !isset( $dataidarray[ $dataid ] ) ){ 
		// 			$dataidarray[ $dataid ] = self::retrieveDataWithID( $dataid ); 
		// 		}
		// 	}
		// }
// echo "<script>alert( JSON.stringify( " . json_encode( $viewdict ) . " ) );</script>";
		// if( $viewdict['data_id'] != "admin_insertview_view_id_button_3" ) {
			
		// }
		$dataid = false;
		if( isset( $viewdict['index'] ) ) {
			// echo " <script> alert( JSON.stringify( " . json_encode( $viewdict['index'] ) . " ) ) </script> ";
			if( isset( $viewdict['index'] ) ) {
				$dataid = $viewdict[$allkeys[0]]['data_id'];
			}else{
				if( isset( $viewdict['data_id'] ) ) {
					$dataid = $viewdict['data_id'];
				}
			}
		}else{
			if( isset( $viewdict['data_id'] ) ) {
				$dataid = $viewdict['data_id'];
			}
		}

		if( $dataid ){
			// $dataid = $viewdict['data_id'];
			

			if( $dataid ){
				if ($dataid != null) {
					if( !isset( $dataidarray[ $dataid ] ) ){ 
						$dataidarray[ $dataid ] = Data::retrieveDataWithID( $dataid ); 
					}
				}
			}

		}else{
			foreach ($allkeys as $k) {
				$dataid=null;
				if( isset( $viewdict[$k]['data_id'] ) ){
					$dataid = $viewdict[$k]['data_id'];
				}
							// echo "<script>alert( JSON.stringify( " . json_encode( $dataid ) . " ) );</script>";
				if( $dataid ){
					if ($dataid != null) {
						if( !isset( $dataidarray[ $dataid ] ) ){ 
							$dataidarray[ $dataid ] = Data::retrieveDataWithID( $dataid ); 
						}
					}
				}
			}
		}


		

		return $dataidarray;
	}

	public static function convertDataForArray( $identifier, $index )
	{

		$dict = self::retrieveDataWithID( $identifier )['value'][$index];

		$allkeys = array_keys( $dict );
		$returningdict = [];
		foreach ($allkeys as $k) {
			$returningdict[$k] = [ "data_id"=>$identifier, "key"=>$k, "index"=>$index ];
		}
		$returningdict['index'] = $index;

		return $returningdict;
	}

	public static function convertFromCustomTable( $data, $customkey, $customvalue )
	{
		$returningdict = [];
		foreach ($data as $keyvalue) {
			$returningdict[$keyvalue[$customkey]] = $keyvalue[$customvalue];
		}

		return $returningdict;
	}

	public static function convertKeys( $data, $identifier=null )
	{
		$testing=false;
		if( !$identifier ) {
			$identifier = Data::getDefaultDataID( $data );
		}else{
			$testing=true;
		}
		if( $testing ) {
			exit( json_encode( $data ) );
		}
		// exit( json_encode( $identifier ) );
		// $data = Data::retrieveDataWithID( $identifier );
		$options = Data::retrieveOptionsWithID( $identifier );
// exit( json_encode( $data ) );
		$convertkeys = Data::getValue( $options, 'convert_keys' );
		if( $convertkeys == "" ){
			return $data;
		}
		if( !isset( $convertkeys ) ){ 
			$convertkeys = false; 
		}else { 
			$convertkeys = $convertkeys; 
		}
		$convertdict = $data;
		if( isset( $data['value'] ) ){
			$convertdict = $data['value'];
		}
		
		$sectionkeys = array_keys( $convertdict );

		foreach ( $sectionkeys as $k ) {
			// if( isset( $convertkeys[$k] ) ){ $convertdict[$convertkeys[$k]] = $convertdict[$k]; }
			if( isset( $convertkeys[$k] ) ){ 
				if( is_array( $convertkeys[$k] ) ){
					foreach ($convertkeys[$k] as $ck) {
						$convertdict[$ck] = $convertdict[$k];
					}
				}else{
					$convertdict[$convertkeys[$k]] = $convertdict[$k]; 
				}
			}
		}

		if( isset( $data['value'] ) ){
			$data['value'] = $convertdict;
		}else{
			$data = $convertdict;
		}
		
		return $data;
	}

	public static function convertKeysInTable( $identifier, $post )
	{
		$data = Data::retrieveDataWithID( $identifier );
		$options = Data::retrieveOptionsWithID( $identifier );

		if( !isset($options['convert_keys'])){ 
			$convertkeys = false; 
		}else { 
			$convertkeys = $options['convert_keys']; 
		}

		$postkeys = array_keys($post);

		foreach ( $postkeys as $k ) {
			if( isset( $convertkeys[$k] ) ){ 
				if( is_array( $convertkeys[$k] ) ){
					foreach ($convertkeys[$k] as $ck) {
						$post[$ck] = $post[$k];
					}
				}else{
					$post[$convertkeys[$k]] = $post[$k]; 
				}
				// $post[$convertkeys[$k] ]['key'] = $convertkeys[$k];
			}
		}

		return $post;
	}

	public static function getViewLinkPath( $identifier )
	{
		$data = Data::retrieveDataWithID( $identifier );
		$options = Data::retrieveOptionsWithID( $identifier );
		
		$linkpath = "";
		$linkpath .= Data::getValue( $options, 'pre_slug' );
		$optionalslug = Data::getValue( $options, 'slug' );
		if( $optionalslug != "" ) {
			$linkpath .= $optionalslug;
		}else{
			$linkpath .= Data::getValue( $data, 'slug' );
		}

		return $linkpath;
	}

	public static function hasprefix( $input, $match )
	{

		if( substr( $input, 0, strlen($match) ) === $match ) {
			return true;
		}else {
			return false;
		}

	}



}