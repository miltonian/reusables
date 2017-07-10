<?php

namespace CustomData;

class Network {

	// protected static $allnetwork = array();

	public static function getNetwork( $networkid )
	{
		$MainClasses = new \MainClasses();

		$query = 'SELECT networks.* FROM networks WHERE networks.id=?';
		$values = [ $networkid ];
		$type = "select";

		$result = $MainClasses->querySQL( $query, $values, $type )[1][0];

		$conditions = [ ["key"=>"id", "value"=>""] ];

		// $tablenames = [];
		// $allkeys = array_keys($result);

		// foreach ($allkeys as $k) {
		// 	$tablenames[$k] = "networks";
		// }
		// $returningdict = [
		// 	"value" => $result,
		// 	"db_info" => [
		// 		"tablenames" => $tablenames,
		// 		"conditions" => $conditions
		// 	]
		// ];

		$returningdict = \ReusableClasses::toValueAndDBInfo( $result, $conditions, "networks" );

		return $returningdict;

	}

	public static function getNetworkInfo( $networkid )
	{
		$MainClasses = new \MainClasses();
		// $query = 'SELECT networks.* FROM networks WHERE networks.id=?';
		// $values = [ $networkid ];
		// $type = "select";
		// $networkname = $MainClasses->querySQL( $query, $values, $type )[1][0]['name'];

		$query = 'SELECT network_info.* FROM network_info WHERE network_info.network_id=?';
		$values = [ $networkid ];
		$type = "select";
		$result = $MainClasses->querySQL( $query, $values, $type )[1];

		// $conditions = [ "network_id", "maininfo_key" ];
		$conditions = [ ["key"=>"network_id", "value"=>""], ["key"=>"maininfo_key", "value"=>""] ];

		$networkdict = [];
		foreach ($result as $pair) {
			$networkdict[$pair['maininfo_key']] = $pair['maininfo_value'];
			// $networkdict[$pair['maininfo_key']]['row_id'] = $pair['id'];
		}
		// exit(json_encode($result[0]['network_id']));
		$networkdict['network_id'] = $result[0]['network_id'];

		$tablenames = [];
		$allkeys = array_keys($networkdict);

		foreach ($allkeys as $k) {
			$tablenames[$k] = "network_info";
		}



		// exit(json_encode($tablenames));

		$returningdict = [
			"value" => $networkdict,
			"db_info" => [
				"tablenames" => $tablenames,
				"conditions" => $conditions
			]
		];

		// // exit(json_encode($networkdict));
		// $networkdict['name']['value'] = $networkname;
		// $networkdict['name']['id'] = $networkid;

		return $returningdict;
	}

	public static function getNetworkIdFromSlug( $networkslug )
	{
		$MainClasses = new \MainClasses();
		$query = 'SELECT network_info.network_id FROM network_info WHERE maininfo_key="slug" AND maininfo_value=?';
		$values = [ $networkslug ];
		$type = "select";
		$result = $MainClasses->querySQL( $query, $values, $type )[1][0]['network_id'];
		return $result;
	}

	public static function getMainCategories( )
	{
		$MainClasses = new \MainClasses();
		$query = 'SELECT main_categories.*, main_categories.id AS row_id FROM main_categories LIMIT 6';
		$values = [];
		$type = "select";
		$maincategories = $MainClasses->querySQL( $query, $values, $type )[1];
		return $maincategories;
	}

}