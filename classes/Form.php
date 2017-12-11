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

}