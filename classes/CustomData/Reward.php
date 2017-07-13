<?php

namespace Reusables\CustomData;

class Reward {

	// protected static $allreward = array();

	public static function getRewards( $postid )
	{
		$MainClasses = new \MainClasses();
		$query = 'SELECT customtable_rewards.* FROM customtable_rewards WHERE customtable_rewards.post_id=? ORDER BY customtable_rewards.amount DESC';
		$values = [ $postid ];
		$type = "select";
		$result = $MainClasses->querySQL( $query, $values, $type )[1];
		for ($i=0; $i < sizeof($result); $i++) { 
			$result[$i]['price'] = $result[$i]['amount'];
		}

		$conditions = [ [ "key" => "id", "value" => "" ] ];
		$returningdict = \ReusableClasses::toValueAndDBInfo( $result, $conditions, "customtable_rewards" );

		return $returningdict;
	}

}