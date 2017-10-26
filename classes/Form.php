<?php

namespace Reusables;


class Form {

	public static function makeInsertOnly( $data, $tablename, $identifier )
	{
		// data needs to be from 'DESCRIBE tablename' SQL query

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