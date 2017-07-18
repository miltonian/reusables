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
		$dict = $data['value'][$index];
		$allkeys = array_keys( $dict );
		$cell = [];
		foreach ($allkeys as $k) {
			$cell[$k] = [ "data_id"=>$data_id, "key"=>$k, "index"=>$index ];
		}
		$cell['index'] = $index;

		return $cell;
	}

	public static function isAssoc(array $arr)
	{
	    if (array() === $arr) return false;
	    return array_keys($arr) !== range(0, count($arr) - 1);
	}

	public static function addData( $entry, $identifier )
	{
		if ( !isset( self::$alldata[ $identifier ] ) ) {
			self::$alldata[ $identifier ] = $entry;

		}else{
			exit( "Duplicate data id: '" . $identifier . "' entries. " );
		}

	}

	public static function retrieveDataWithID( $identifier )
	{
		if ( !isset( self::$alldata[ $identifier ] ) ) {
			return null;
		}else{
			return self::$alldata[ $identifier ];
		}
	}

	public static function getDefaultDataID( $viewdict )
	{
		if ( self::isAssoc($viewdict) ) {
			$dict = $viewdict;
		}else{
			$dict = $viewdict[0];
		}
		$allkeys = array_keys( $dict );
		$data_id = $dict[ $allkeys[0] ]['data_id'];
		return $data_id;
	}

	public static function getDefaultConditionsWithID( $identifier )
	{
		$data = Data::retrieveDataWithID( $identifier );

		return $data['db_info']['conditions'];
	}

	public static function getDefaultTableNameWithID( $identifier )
	{
		$data = Data::retrieveDataWithID( $identifier );
		$tablenames = $data['db_info']['tablenames'];
		$allkeys = array_keys($tablenames);
		return $tablenames[$allkeys[0]];
	}

	public static function getValue( $dict, $key )
	{
		if( isset($dict[ $key ]) ){
			$pair = $dict[ $key ];
		}else{
			return "";
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
		return $thevalue;
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
		
		$colname = self::retrieveDataWithID( $pair['data_id'] )['db_info'][ "colnames" ][$pair['key']];

		return $colname;
	}

	public static function getFullArray( $viewdict )
	{
		$allkeys = array_keys($viewdict);
		$dataidarray = array();
		// exit(json_encode($viewdict));
		foreach ($allkeys as $k) {
			$dataid = $viewdict[$k]['data_id'];
			if ($dataid != null) {
				if( !isset( $dataidarray[ $dataid ] ) ){ 
					$dataidarray[ $dataid ] = self::retrieveDataWithID( $dataid ); 
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



}