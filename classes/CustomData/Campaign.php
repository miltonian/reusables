<?php

namespace CustomData;

class Campaign {

	// protected static $allcampaign = array();

	public static function getPostInfo( $postid )
	{
		$MainClasses = new \MainClasses();
		$query = 'SELECT posts.* FROM posts WHERE posts.id = ?';
		$values = [ $postid ];
		$type = "select";
		$result = $MainClasses->querySQL( $query, $values, $type )[1][0];

		$conditions = [ [ "key" => "id", "value" => "" ] ];
		$returningdict = \ReusableClasses::toValueAndDBInfo( $result, $conditions, "posts" );
		// exit( json_encode( $returningdict ) );
		return $returningdict;
	}

	public static function getPostFundsDict( $postid )
	{
		$MainClasses = new \MainClasses();
		$query = 'SELECT customtable_funds.*, SUM( customtable_funds.full_amount ) as funded, COUNT(DISTINCT customtable_funds.email) as funders FROM customtable_funds WHERE customtable_funds.post_id=? ';
		$values = [ $postid ];
		$type = "select";
		$result = $MainClasses->querySQL( $query, $values, $type )[1][0];

		$conditions = [ [ "key" => "id", "value" => "" ] ];
		$returningdict = \ReusableClasses::toValueAndDBInfo( $result, $conditions, "customtable_funds" );
		// exit( json_encode( $returningdict ) );

		return $returningdict;
	}

	public static function getPosts( $type )
	{
		$MainClasses = new \MainClasses();
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

	public static function getPostIdFromSlug( $postslug )
	{
		$MainClasses = new \MainClasses();
		$query = 'SELECT posts.id FROM posts WHERE posts.slug=?';
		$values = [ $postslug ];
		$type = "select";
		$result = $MainClasses->querySQL( $query, $values, $type )[1][0]['id'];
		return $result;
	}

}