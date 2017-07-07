<?php 

require_once 'classes/classes.php';
$MainClasses = new MainClasses();

class CustomData {

	public static function getNetwork( $networkid )
	{
		$MainClasses = new MainClasses();

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

		$returningdict = ReusableClasses::toValueAndDBInfo( $result, $conditions, "networks" );

		return $returningdict;

	}

	public static function getNetworkInfo( $networkid )
	{
		$MainClasses = new MainClasses();
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

	public static function getPostInfo( $postid )
	{
		$MainClasses = new MainClasses();
		$query = 'SELECT posts.* FROM posts WHERE posts.id = ?';
		$values = [ $postid ];
		$type = "select";
		$result = $MainClasses->querySQL( $query, $values, $type )[1][0];

		$conditions = [ [ "key" => "id", "value" => "" ] ];
		$returningdict = ReusableClasses::toValueAndDBInfo( $result, $conditions, "posts" );
		// exit( json_encode( $returningdict ) );
		return $returningdict;
	}

	public static function getRewards( $postid )
	{
		$MainClasses = new MainClasses();
		$query = 'SELECT customtable_rewards.* FROM customtable_rewards WHERE customtable_rewards.post_id=? ORDER BY customtable_rewards.amount DESC';
		$values = [ $postid ];
		$type = "select";
		$result = $MainClasses->querySQL( $query, $values, $type )[1];
		for ($i=0; $i < sizeof($result); $i++) { 
			$result[$i]['price'] = $result[$i]['amount'];
		}

		$conditions = [ [ "key" => "id", "value" => "" ] ];
		$returningdict = ReusableClasses::toValueAndDBInfo( $result, $conditions, "customtable_rewards" );

		return $returningdict;
	}

	public static function getPostFundsDict( $postid )
	{
		$MainClasses = new MainClasses();
		$query = 'SELECT customtable_funds.*, SUM( customtable_funds.full_amount ) as funded, COUNT(DISTINCT customtable_funds.email) as funders FROM customtable_funds WHERE customtable_funds.post_id=? ';
		$values = [ $postid ];
		$type = "select";
		$result = $MainClasses->querySQL( $query, $values, $type )[1][0];

		$conditions = [ [ "key" => "id", "value" => "" ] ];
		$returningdict = ReusableClasses::toValueAndDBInfo( $result, $conditions, "customtable_funds" );
		// exit( json_encode( $returningdict ) );

		return $returningdict;
	}

	public static function getPosts( $type )
	{
		$MainClasses = new MainClasses();
		$query = 'SELECT posts.*, posts.id AS row_id FROM posts WHERE posts.id > ? AND posts.scheduled<? ORDER BY posts.date_made DESC, posts.id DESC LIMIT 20';
		$values = [ 0, time() ];
		$type = "select";
		$result = $MainClasses->querySQL( $query, $values, $type )[1];
		
		$conditions = [ ["key"=>"id", "value"=>""] ];

		$tablenames = [];
		$allkeys = array_keys($result[0]);

		foreach ($allkeys as $k) {
			$tablenames[$k] = "posts";
		}

		$returningdict = [
			"value" => $result,
			"db_info" => [
				"tablenames" => $tablenames,
				"conditions" => $conditions
			]
		];
		// exit( json_encode( $returningdict ) );

		return $returningdict;
	}

	public static function getNetworkIdFromSlug( $networkslug )
	{
		$MainClasses = new MainClasses();
		$query = 'SELECT network_info.network_id FROM network_info WHERE maininfo_key="slug" AND maininfo_value=?';
		$values = [ $networkslug ];
		$type = "select";
		$result = $MainClasses->querySQL( $query, $values, $type )[1][0]['network_id'];
		return $result;
	}

	public static function getPostIdFromSlug( $postslug )
	{
		$MainClasses = new MainClasses();
		$query = 'SELECT posts.id FROM posts WHERE posts.slug=?';
		$values = [ $postslug ];
		$type = "select";
		$result = $MainClasses->querySQL( $query, $values, $type )[1][0]['id'];
		return $result;
	}

	public static function getMainCategories( )
	{
		$MainClasses = new MainClasses();
		$query = 'SELECT main_categories.*, main_categories.id AS row_id FROM main_categories LIMIT 6';
		$values = [];
		$type = "select";
		$maincategories = $MainClasses->querySQL( $query, $values, $type )[1];
		return $maincategories;
	}

}